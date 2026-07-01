<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->foreignId('session_id')->constrained('academic_sessions')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'title', 'session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
