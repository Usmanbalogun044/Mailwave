<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\CampaignRecipient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignMail;

class SendCampaignEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;

    /**
     * Create a new job instance.
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $recipients = CampaignRecipient::where('campaign_id', $this->campaign->id)
            ->where('status', 'pending')
            ->get();

        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient->email)->send(new CampaignMail($this->campaign));
                $recipient->update(['status' => 'sent']);
            } catch (\Exception $e) {
                $recipient->update(['status' => 'failed']);
            }
        }

        $this->campaign->update(['status' => 'sent']);
    }
}
