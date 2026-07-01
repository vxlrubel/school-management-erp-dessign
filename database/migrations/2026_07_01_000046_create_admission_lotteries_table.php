<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_lotteries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->unique()->constrained('admission_applications')->cascadeOnDelete();
            $table->string('result')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_lotteries');
    }
};
