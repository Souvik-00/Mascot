<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetIncome extends Model
{
     protected $table = 'net_income_tbl';
    protected $guarded = [];

    /**
     * 🔗 Relationship: belongs to a Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
