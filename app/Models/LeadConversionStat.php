<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadConversionStat extends Model
{
    protected $table = 'leads_conversion_stat_tbl';

    protected $guarded = [];

    // Each record belongs to a Lead
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'leads_id');
    }

    // Each record belongs to a Pipeline Stage
    public function pipelineStage()
    {
        return $this->belongsTo(CrmPipelineStage::class, 'crm_pipeline_stages_id');
    }
}
