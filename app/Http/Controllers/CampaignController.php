<?php

namespace App\Http\Controllers;

use App\Imports\CampaignEmailsImport;
use App\Models\Campaign;
use App\Models\CampaignRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard.campaigns', compact('campaigns'));
    }

    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        return view('user.dashboard.create-campaign');
    }

    /**
     * Store a newly created campaign in storage.
     */
    private function extractEmailsFromFile($file)
{
    $emails = [];

    if ($file->getClientOriginalExtension() === 'csv') {
        $handle = fopen($file->getPathname(), "r");
        while (($row = fgetcsv($handle)) !== false) {
            $emails[] = filter_var(trim($row[0]), FILTER_VALIDATE_EMAIL);
        }
        fclose($handle);
    } elseif ($file->getClientOriginalExtension() === 'xlsx') {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getRowIterator() as $row) {
            $cell = $row->getCellIterator()->current();
            $email = filter_var(trim($cell->getValue()), FILTER_VALIDATE_EMAIL);
            if ($email) {
                $emails[] = $email;
            }
        }
    }

    return array_filter($emails); // Remove invalid emails
}
    public function store(Request $request)
    {
        if ($request->filled('emails')) {
            $emails = explode(',', $request->input('emails')); // Split by commas
            $emails = array_map('trim', $emails); // Trim spaces
        } else {
            $emails = []; // Ensure it's always an array
        }
    
        // Merge modified emails array into request data
        $request->merge(['emails' => $emails]);
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required',
            'template' => 'nullable|string',
            'status' => 'required|in:draft,scheduled,sent',
            'scheduled_at' => 'nullable|date',
            'emails' => 'nullable|array',
            'emails.*' => 'email',
            'email_file' => 'nullable|file|mimes:csv,xlsx|max:2048',
        ]);
        if ($request->hasFile('email_file')) {
            $emails = array_merge($emails, $this->extractEmailsFromFile($request->file('email_file')));
        }
        $campaign = Campaign::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content,
            'template' => $request->template,
            'status' => $request->status,
            'scheduled_at' => $request->scheduled_at,
            'user_id' => auth()->id(),
        ]);
    
        // Add emails manually if provided
        if ($request->has('emails')) {
            foreach ($request->emails as $email) {
                CampaignRecipient::create([
                    'campaign_id' => $campaign->id,
                    'email' => $email,
                ]);
            }
        }
    
        // Handle file upload
        if ($request->hasFile('email_file')) {
            Excel::import(new CampaignEmailsImport($campaign->id), $request->file('email_file'));
        }
    
        return redirect()->route('campaigns.index')->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        $this->authorize('view', $campaign);
        return view('user.dashboard.show-campaign', compact('campaign'));
    }

    /**
     * Show the form for editing the campaign.
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('update', $campaign);
        return view('user.dashboard.edit-campaign', compact('campaign'));
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required',
            'template' => 'nullable|string',
            'status' => 'required|in:draft,scheduled,sent',
            'scheduled_at' => 'nullable|date',
        ]);

        $campaign->update($request->all());

        return redirect()->route('campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);
        $campaign->delete();

        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted successfully.');
    }
}
