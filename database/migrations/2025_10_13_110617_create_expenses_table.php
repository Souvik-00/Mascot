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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('category'); // Rent, Salary, Supplies, etc.
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->string('payment_method')->nullable(); // Cash, Card, Bank, etc.
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
