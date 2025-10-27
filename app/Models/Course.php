<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    
    // public function organisation()
    // {
    //     return $this->belongsTo(Organisation::class);
    // }

     public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
