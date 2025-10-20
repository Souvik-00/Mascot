<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CrmPipelineStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stages = [
            [
                'crm_pipeline_stages' => 'New Lead',
                'what_it_means' => 'A new inquiry or contact has entered the CRM system.',
                'enter_when' => 'When a new lead is created manually or via integration.',
                'exit_when' => 'When initial contact is made.',
                'owner' => 'Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Connected – Initial Conversation',
                'what_it_means' => 'First successful contact has been made with the lead.',
                'enter_when' => 'When communication (call/chat) is established.',
                'exit_when' => 'After qualification or next step is defined.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Attempting Contact',
                'what_it_means' => 'Trying to reach the lead but no successful communication yet.',
                'enter_when' => 'When first outreach attempt begins.',
                'exit_when' => 'When the lead responds or is marked unresponsive.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Marketing Qualified Lead (MQL)',
                'what_it_means' => 'Lead meets the marketing team’s qualification criteria.',
                'enter_when' => 'After lead scoring or engagement meets threshold.',
                'exit_when' => 'When handed over to sales.',
                'owner' => 'Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Sales Accepted Lead (SAL)',
                'what_it_means' => 'Sales team acknowledges the MQL and starts engagement.',
                'enter_when' => 'When marketing hands over and sales accepts the lead.',
                'exit_when' => 'When qualified further as SQL or rejected.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Sales Qualified Lead (SQL)',
                'what_it_means' => 'Lead is verified as a potential customer with intent and fit.',
                'enter_when' => 'After discovery call or qualification questions.',
                'exit_when' => 'When demo or trial is scheduled.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Demo Scheduled',
                'what_it_means' => 'A product demo or trial session has been booked.',
                'enter_when' => 'After the lead confirms demo time.',
                'exit_when' => 'When the demo is completed or no-show occurs.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Demo Attended',
                'what_it_means' => 'Lead attended the scheduled demo session.',
                'enter_when' => 'After demo participation is confirmed.',
                'exit_when' => 'When moved to trial or closed.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Trial Month – Active (Demo Classes Ongoing)',
                'what_it_means' => 'Lead is currently participating in a trial or demo period.',
                'enter_when' => 'After demo classes begin.',
                'exit_when' => 'When trial completes or lead converts.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'No-Show (Demo)',
                'what_it_means' => 'Lead missed the scheduled demo session.',
                'enter_when' => 'When demo session attendance is not confirmed.',
                'exit_when' => 'When rescheduled or marked as inactive.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Nurture – Warm',
                'what_it_means' => 'Lead showed interest but is not yet ready to purchase.',
                'enter_when' => 'When engagement is positive but no immediate decision.',
                'exit_when' => 'When reactivated or disqualified.',
                'owner' => 'Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Nurture – Cold',
                'what_it_means' => 'Lead is unresponsive or lost interest temporarily.',
                'enter_when' => 'When lead becomes inactive.',
                'exit_when' => 'When reactivated or archived.',
                'owner' => 'Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Lost – Dropped During Trial',
                'what_it_means' => 'Lead stopped participating during trial phase.',
                'enter_when' => 'When lead leaves before trial completion.',
                'exit_when' => 'If revived later or archived.',
                'owner' => 'Sales Team',
            ],
            [
                'crm_pipeline_stages' => 'Lost – Price/Timing/Other',
                'what_it_means' => 'Lead did not convert due to external reasons (pricing, timing, etc.).',
                'enter_when' => 'After final communication confirms disinterest.',
                'exit_when' => 'If revived or re-qualified later.',
                'owner' => 'Sales/Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Disqualified',
                'what_it_means' => 'Lead does not meet basic qualification criteria.',
                'enter_when' => 'After assessment by marketing or sales.',
                'exit_when' => 'If revived or reclassified.',
                'owner' => 'Marketing Team',
            ],
            [
                'crm_pipeline_stages' => 'Re-Inquiry (Revived)',
                'what_it_means' => 'Previously lost/disqualified lead re-engaged with new interest.',
                'enter_when' => 'When an old lead contacts again.',
                'exit_when' => 'When moved back to MQL or active funnel.',
                'owner' => 'Sales/Marketing Team',
            ],
        ];

        DB::table('crm_pipeline_stages_tbl')->insert($stages);
    }
}
