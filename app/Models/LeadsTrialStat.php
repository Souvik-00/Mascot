<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadsTrialStat extends Model
{
    protected $table = 'leads_trial_stat_tbl';

    protected $guarded = [];

    /**
     * Relationship with Lead
     * One Trial entry belongs to one Lead
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'leads_id');
    }

    /**
     * Relationship with Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Relationship with Batch
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
