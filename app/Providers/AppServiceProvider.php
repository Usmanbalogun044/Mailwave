<?php

namespace App\Providers;
use App\Jobs\SendCampaignEmails;
use App\Models\Campaign;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schedule::call(function () {
            // Get campaigns that need to be sent
            $campaigns = Campaign::where('status', 'scheduled')
                ->where('scheduled_at', '<=', now())
                ->get();
    
            foreach ($campaigns as $campaign) {
                SendCampaignEmails::dispatch($campaign);
            }
        })->everyMinute();
    }
}
