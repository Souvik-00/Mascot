<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = [];

    // public function organisation() {
    //     return $this->belongsTo(Organisation::class);
    // }


    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
