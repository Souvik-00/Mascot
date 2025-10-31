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
        Schema::create('net_income_tbl', function (Blueprint $table) {
            $table->id();

            // 🏫 Department reference
            $table->foreignId('department_id')
                  ->constrained('department')
                  ->onDelete('cascade');

            // 📅 Date of record
            $table->date('record_date');

            // 💰 Department-wise totals
            $table->decimal('total_payment', 12, 2)->default(0);
            $table->decimal('total_expense', 12, 2)->default(0);

            $table->timestamps();

            // ✅ One record per department per date
            $table->unique(['department_id', 'record_date'], 'dept_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('net_income_tbl');
    }
};
