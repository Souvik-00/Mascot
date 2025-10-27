<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadsAttendance extends Model
{
     protected $table = 'leads_attendance_tbl';

     protected $guarded = [];

      public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
