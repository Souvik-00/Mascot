<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads_tbl';

    protected $guarded = [];

    
    public function marketingSource()
    {
        return $this->belongsTo(MarketingSource::class, 'marketing_source_id');
    }


    public function conversionStats()
    {
    return $this->hasMany(LeadConversionStat::class, 'leads_id');
    }
}
