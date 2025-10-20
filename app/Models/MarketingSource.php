<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingSource extends Model
{
    protected $table = 'marketing_source_tbl';

    protected $guarded = [];


    public function leads()
{
    return $this->hasMany(Lead::class, 'marketing_source_id');
}
}
