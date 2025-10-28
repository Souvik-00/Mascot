<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAttendance extends Model
{
        protected $table = 'lead_attendance_tbl';

    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
