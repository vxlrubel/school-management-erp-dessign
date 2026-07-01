<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->date('attendance_date');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'attendance_date', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
