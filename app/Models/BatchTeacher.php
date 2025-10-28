<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchTeacher extends Model
{
    use HasFactory;

    protected $table = 'batch_teacher_tbl';

    protected $guarded = [];

    /**
     * Relationship: BatchTeacher belongs to one Batch.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batches_id');
    }

    /**
     * Relationship: BatchTeacher belongs to one Teacher (User model).
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
