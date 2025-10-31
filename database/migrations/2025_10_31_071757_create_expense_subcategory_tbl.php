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
        Schema::create('expense_subcategory_tbl', function (Blueprint $table) {
            $table->id();
            // Foreign key from expense_category_tbl
            $table->foreignId('category_id')->constrained('expense_category_tbl')->onDelete('cascade'); // if a category is deleted, its subcategories also delete
            $table->string('sub_category_name');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_subcategory_tbl');
    }
};
