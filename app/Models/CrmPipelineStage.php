<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmPipelineStage extends Model
{
    protected $table = 'crm_pipeline_stages_tbl';

    protected $guarded = [];

    public function conversionStats()
    {
    return $this->hasMany(LeadConversionStat::class, 'crm_pipeline_stages_id');
    }   
}
