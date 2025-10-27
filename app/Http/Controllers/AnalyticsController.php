<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index() {


        // ------------------ TODAY'S CONVERSION % ------------------
    $result = DB::select("
        SELECT ROUND(
            (
                SELECT COUNT(*)
                FROM leads_conversion_stat_tbl AS lcs
                WHERE lcs.date = CURDATE()
                AND lcs.crm_pipeline_stages_id IN (
                    SELECT id
                    FROM crm_pipeline_stages_tbl
                    WHERE crm_pipeline_stages <> 'Disqualified'
                )
            )
            /
            NULLIF(
                (
                    SELECT COUNT(*)
                    FROM leads_tbl
                    WHERE created_at >= CURDATE()
                    AND created_at < CURDATE() + INTERVAL 1 DAY
                ), 0
            ) * 100, 2
        ) AS pct
    ");

    $conversionPercentage = $result[0]->pct ?? 0;



    // ------------------ TODAY'S MQL % ------------------
    $mql = DB::select("
        SELECT ROUND(
            (
                SELECT COUNT(*)
                FROM leads_conversion_stat_tbl AS lcs
                WHERE lcs.date = CURDATE()
                AND lcs.crm_pipeline_stages_id IN (
                    SELECT id
                    FROM crm_pipeline_stages_tbl
                    WHERE crm_pipeline_stages = 'Marketing Qualified Lead (MQL)'
                )
            )
            /
            NULLIF(
                (
                    SELECT COUNT(*)
                    FROM leads_tbl
                    WHERE created_at >= CURDATE()
                    AND created_at < CURDATE() + INTERVAL 1 DAY
                ), 0
            ) * 100, 2
        ) AS pct
    ");

    $mqlCount = $mql[0]->pct ?? 0;



    return view('analytics.funnel_conversion', compact('conversionPercentage', 'mqlCount'));
    }
}
