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
        Schema::create('teacher_attendance_tbl', function (Blueprint $table) {
             $table->id();

            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');

            $table->date('attendance_date');
            $table->boolean('is_present')->default(false);
            $table->timestamps();

            // 🟢 Shorter constraint name to avoid MySQL 64-char limit
            $table->unique(['batch_id', 'teacher_id', 'attendance_date'], 'teacher_attendance_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendance_tbl');
    }
};
