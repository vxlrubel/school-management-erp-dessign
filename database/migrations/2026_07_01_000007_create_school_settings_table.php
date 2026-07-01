<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('timezone', 100)->default('UTC');
            $table->string('currency', 10)->default('USD');
            $table->string('language', 10)->default('en');
            $table->string('attendance_type', 50)->default('manual');
            $table->boolean('sms_enabled')->default(false);
            $table->boolean('email_enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
