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
            $table->string('link_clicks')->nullable();
            $table->string('cost_per_link_clicks')->nullable();
            $table->string('views')->nullable();
            $table->string('viewers')->nullable();
            $table->string('post_engagements')->nullable();
            $table->string('three_second_video_plays')->nullable();
            $table->string('post_reactions')->nullable();
            $table->string('estimated_call_confirmation_clicks')->nullable();
            $table->string('twenty_second_phone_calls')->nullable();
            $table->string('post_comments')->nullable();
            $table->string('post_shares')->nullable();
            $table->string('actual_call')->nullable();
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
