<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulkMail;
use PhpOffice\PhpSpreadsheet\IOFactory;


class BulkEmailController extends Controller
{
    public function sendBulkEmail(Request $request)
    {
        $request->validate([
            'email_file' => 'nullable|file|mimes:csv,txt,xlsx',
            'manual_emails' => 'nullable|string',
            'reply_to' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $emails = [];

        // Process uploaded file
        if ($request->hasFile('email_file')) {
            $file = $request->file('email_file');
            $ext = $file->getClientOriginalExtension();

            if ($ext === 'csv' || $ext === 'txt') {
                $emails = array_filter(explode("\n", file_get_contents($file->getPathname())));
            } elseif ($ext === 'xlsx') {
                $spreadsheet = IOFactory::load($file->getPathname());
                $worksheet = $spreadsheet->getActiveSheet();
                foreach ($worksheet->getRowIterator() as $row) {
                    $cell = $row->getCellIterator()->current();
                    if ($cell) {
                        $emails[] = trim($cell->getValue());
                    }
                }
            }
        }

        // Process manually entered emails
        if (!empty($request->manual_emails)) {
            $manualEmails = array_map('trim', explode(',', $request->manual_emails));
            $emails = array_merge($emails, $manualEmails);
        }

        // Remove duplicates
        $emails = array_unique(array_filter($emails, function ($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        }));
        

        if (empty($emails)) {
            return back()->with('error', 'No valid email addresses found.');
        }

        // Send email to each recipient
        foreach ($emails as $email) {
            Mail::to($email)->send(new BulkMail($request->subject, $request->message, $request->reply_to));
        }

        return back()->with('success', 'Bulk emails sent successfully.');
    }
}
