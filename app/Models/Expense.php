<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $guarded = [];


    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

        public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }   

        public function subcategory()
    {   
        return $this->belongsTo(ExpenseSubCategory::class, 'subcategory_id');
    }
}
