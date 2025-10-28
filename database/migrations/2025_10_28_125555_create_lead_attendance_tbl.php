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
        Schema::create('lead_attendance_tbl', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                ->constrained('batches')
                ->onDelete('cascade');

            $table->foreignId('lead_id')
                ->constrained('leads_tbl')
                ->onDelete('cascade');

            $table->date('attendance_date');
            $table->boolean('is_present')->default(false);

            $table->timestamps();

            $table->unique(['batch_id', 'lead_id', 'attendance_date']); // one record per day per lead
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_attendance_tbl');
    }
};
