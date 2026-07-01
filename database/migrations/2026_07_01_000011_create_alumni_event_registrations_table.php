<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('alumni_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_event_registrations');
    }
};
