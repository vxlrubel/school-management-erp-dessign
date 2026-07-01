<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('employee_no')->nullable();
            $table->string('designation')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('qualification')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
