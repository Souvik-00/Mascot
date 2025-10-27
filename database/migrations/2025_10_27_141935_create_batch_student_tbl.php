<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_student_tbl', function (Blueprint $table) {
            $table->id();

            // Batch ID (FK to batches table)
            $table->unsignedBigInteger('batches_id');
            $table->foreign('batches_id')
                ->references('id')->on('batches')
                ->onDelete('cascade');

            // Student ID (FK to users or students table)
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')->on('users')   // if your students are stored in users table
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_student_tbl');
    }
};
