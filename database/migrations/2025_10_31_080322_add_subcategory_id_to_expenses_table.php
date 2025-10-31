<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // ✅ Add subcategory_id column (foreign key to expense_subcategory_tbl)
            if (!Schema::hasColumn('expenses', 'subcategory_id')) {
                $table->foreignId('subcategory_id')
                      ->nullable()
                      ->after('category_id')
                      ->constrained('expense_subcategory_tbl')
                      ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // ✅ Rollback support
            if (Schema::hasColumn('expenses', 'subcategory_id')) {
                $table->dropForeign(['subcategory_id']);
                $table->dropColumn('subcategory_id');
            }
        });
    }
};
