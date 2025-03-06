<?php

namespace App\Imports;

use App\Models\CampaignRecipient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampaignEmailsImport implements ToModel, WithHeadingRow
{
    protected $campaignId;

    public function __construct($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function model(array $row)
    {
        return new CampaignRecipient([
            'campaign_id' => $this->campaignId,
            'email' => $row['email'], // Ensure the column name in the file is 'email'
        ]);
    }
}
