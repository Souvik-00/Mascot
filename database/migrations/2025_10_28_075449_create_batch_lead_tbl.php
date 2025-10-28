<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batch_lead_tbl', function (Blueprint $table) {
             $table->id();

            // Foreign key to batches table
            $table->foreignId('batch_id')
                ->constrained('batches')
                ->onDelete('cascade');

            // Foreign key to leads_tbl
            $table->foreignId('lead_id')
                ->constrained('leads_tbl')
                ->onDelete('cascade');

            $table->timestamps();

            // Prevent duplicates
            $table->unique(['batch_id', 'lead_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_lead_tbl');
    }
};
