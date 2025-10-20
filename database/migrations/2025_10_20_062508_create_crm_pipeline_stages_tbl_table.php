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
        Schema::create('crm_pipeline_stages_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('crm_pipeline_stages', 64);
            $table->text('what_it_means');
            $table->text('enter_when');
            $table->text('exit_when');
            $table->text('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_pipeline_stages_tbl');
    }
};
