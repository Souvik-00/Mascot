<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchLead extends Model
{
    use HasFactory;

    protected $table = 'batch_lead_tbl';

    protected $guarded = [];

    /**
     * Each BatchLead belongs to a Batch.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    /**
     * Each BatchLead belongs to a Lead.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
