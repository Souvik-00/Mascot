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
        Schema::create('student_attendance_tbl', function (Blueprint $table) {
             $table->id();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained('users') // students come from users table
                ->onDelete('cascade');

            $table->date('attendance_date');
            $table->boolean('is_present')->default(false);

            $table->timestamps();

            $table->unique(['batch_id', 'student_id', 'attendance_date']); // 1 record per day per student
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendance_tbl');
    }
};
