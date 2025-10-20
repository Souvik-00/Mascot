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
        Schema::create('meta_results', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Report date');
            // Using decimal for numeric reporting metrics
            $table->decimal('link_clicks', 10, 2)->nullable();
            $table->decimal('cost_per_link_clicks', 10, 2)->nullable();
            $table->decimal('views', 10, 2)->nullable();
            $table->decimal('viewers', 10, 2)->nullable();
            $table->decimal('post_engagements', 10, 2)->nullable();
            $table->decimal('three_second_video_plays', 10, 2)->nullable();
            $table->decimal('post_reactions', 10, 2)->nullable();
            $table->decimal('estimated_call_confirmation_clicks', 10, 2)->nullable();
            $table->decimal('twenty_second_phone_calls', 10, 2)->nullable();
            $table->decimal('post_comments', 10, 2)->nullable();
            $table->decimal('post_shares', 10, 2)->nullable();
            $table->decimal('actual_call', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_results');
    }
};
