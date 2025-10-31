<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseSubCategory extends Model
{
    protected $table = 'expense_subcategory_tbl';

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
