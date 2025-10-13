<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];


    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function classSession()
    {
        return $this->belongsTo(ClassSession::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
