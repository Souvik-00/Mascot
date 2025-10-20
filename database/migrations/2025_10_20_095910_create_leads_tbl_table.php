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
        Schema::create('leads_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('location');
            $table->string('phone_number', 16);
            $table->string('sex', 20);
            $table->date('date_of_contact');
            $table->decimal('budget_range', 10, 2); // e.g. 50000.00
            $table->string('authority', 20); // Self, Parent, Others - Specify
            $table->text('need');
            $table->string('timeline', 25);

            // Foreign key to marketing_source_tbl
            $table->unsignedBigInteger('marketing_source_id');
            $table->foreign('marketing_source_id')
                  ->references('id')
                  ->on('marketing_source_tbl')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads_tbl');
    }
};
