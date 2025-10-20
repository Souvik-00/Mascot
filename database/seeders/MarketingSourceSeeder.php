<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarketingSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $sources = [
            ['lead_source' => 'Meta Ads'],
            ['lead_source' => 'Inbound Call'],
            ['lead_source' => 'Referral'],
            ['lead_source' => 'Walk-in'],
            ['lead_source' => 'Website'],
            ['lead_source' => 'SEO'],
            ['lead_source' => 'Google Ads'],
        ];

        DB::table('marketing_source_tbl')->insert($sources);
    }
}
