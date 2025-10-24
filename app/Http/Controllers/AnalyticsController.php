<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index() {


        // Contactiblity Benchmark
        $result = DB::select("
        SELECT ROUND(
            (
                SELECT COUNT(*)
                FROM leads_conversion_stat_tbl AS lcs
                WHERE lcs.date = CURRENT_DATE
                AND lcs.crm_pipeline_stages_id IN (
                    SELECT id
                    FROM crm_pipeline_stages_tbl
                    WHERE crm_pipeline_stages <> 'Disqualified'
                )
            )
            / NULLIF(
                (
                    SELECT COUNT(*)
                    FROM leads_tbl
                    WHERE created_at >= CURRENT_DATE
                    AND created_at < CURRENT_DATE + INTERVAL 1 DAY
                ), 1
            ) * 100, 2
        ) AS pct");

    $conversionPercentage = $result[0]->pct ?? 0;

        
    
        // MQL
        $mql= DB::select("
        SELECT ROUND(
            (
                SELECT COUNT(*)
                FROM leads_conversion_stat_tbl AS lcs
                WHERE lcs.date = CURRENT_DATE
                AND lcs.crm_pipeline_stages_id IN (
                    SELECT id
                    FROM crm_pipeline_stages_tbl
                    WHERE crm_pipeline_stages <> 'Marked Qualified Lead (MQL)'
                )
            )
            / NULLIF(
                (
                    SELECT COUNT(*)
                    FROM leads_tbl
                    WHERE created_at >= CURRENT_DATE
                    AND created_at < CURRENT_DATE + INTERVAL 1 DAY
                ), 1
            ) * 100, 2
        ) AS pct");

    $mqlCount = $mql[0]->total ?? 0;

    return view('analytics.funnel_conversion', compact('conversionPercentage', 'mqlCount'));
    }
}
