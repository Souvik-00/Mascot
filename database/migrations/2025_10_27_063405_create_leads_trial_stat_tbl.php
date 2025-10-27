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
        Schema::create('leads_trial_stat_tbl', function (Blueprint $table) {
            $table->id();
             // Foreign key to leads_tbl
            $table->unsignedBigInteger('leads_id');
            $table->foreign('leads_id')
                  ->references('id')
                  ->on('leads_tbl')
                  ->onDelete('cascade');

            // Trial period
            $table->date('trl_start_dt');
            $table->date('trl_end_dt'); // Will be set in controller: start_dt + 1 month

            // Foreign key to courses
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');

            // Foreign key to batches
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')
                  ->references('id')
                  ->on('batches')
                  ->onDelete('cascade');

            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_trial_stat_tbl');
    }
};
