<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_mobile')->nullable();
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_guardians');
    }
};
