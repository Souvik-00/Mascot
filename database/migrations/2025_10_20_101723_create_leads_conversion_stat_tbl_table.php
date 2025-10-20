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
        Schema::create('leads_conversion_stat_tbl', function (Blueprint $table) {
            $table->id();
            // Foreign key to leads_tbl
            $table->unsignedBigInteger('leads_id');
            $table->foreign('leads_id')
                  ->references('id')
                  ->on('leads_tbl')
                  ->onDelete('cascade');

            $table->date('date'); // Conversion or status change date

            // Foreign key to crm_pipeline_stages_tbl
            $table->unsignedBigInteger('crm_pipeline_stages_id');
            $table->foreign('crm_pipeline_stages_id')
                  ->references('id')
                  ->on('crm_pipeline_stages_tbl')
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
        Schema::dropIfExists('leads_conversion_stat_tbl');
    }
};
