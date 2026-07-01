<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('day');
            $table->foreignId('period_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['class_id', 'section_id', 'day', 'period_id'], 'class_routines_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_routines');
    }
};
