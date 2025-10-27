<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchStudent extends Model
{
      protected $table = 'batch_student_tbl';

      protected $guarded = [];

       /**
     * Relationship: BatchStudent belongs to a Batch
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batches_id');
    }

    /**
     * Relationship: BatchStudent belongs to a Student (User)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
