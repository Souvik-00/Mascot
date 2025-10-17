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
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        // $table->foreignId('organisation_id')->constrained()->onDelete('cascade');
        
        $table->string('student_code')->unique();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->date('dob')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->string('father_name')->nullable();
        $table->string('mother_name')->nullable();
        $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed', 'separated'])->nullable();
        $table->string('spouse_name')->nullable();
        $table->text('current_address')->nullable();
        $table->text('permanent_address')->nullable();
        $table->string('voter_id_card_no')->nullable();
        $table->string('pan_card_no')->nullable();
        $table->string('aadhar_no')->nullable();
        $table->enum('highest_qualification', ['matriculation', 'higher_secondary', 'graduation', 'masters', 'phd'])->nullable();
        $table->date('joined_on')->nullable();
        $table->enum('status', ['active', 'inactive', 'lead', 'alumni', 'withdrawn'])->default('active');
           
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
