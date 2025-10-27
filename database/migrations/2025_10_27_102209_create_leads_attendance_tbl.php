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
        Schema::create('leads_attendance_tbl', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads_tbl')->onDelete('cascade');

            $table->date('attn_date')->index();
            $table->enum('status', ['present', 'absent']);

            $table->timestamps();

            $table->unique(['lead_id', 'attn_date'], 'uniq_lead_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_attendance_tbl');
    }
};
