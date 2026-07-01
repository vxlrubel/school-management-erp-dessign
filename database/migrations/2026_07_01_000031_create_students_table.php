<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('admission_no')->nullable()->unique();
            $table->string('roll')->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
