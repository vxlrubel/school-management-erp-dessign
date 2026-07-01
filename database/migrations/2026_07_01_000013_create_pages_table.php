<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['school_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
