<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('file');
            $table->foreignId('class_id')->nullable()->constrained('classes')->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_contents');
    }
};
