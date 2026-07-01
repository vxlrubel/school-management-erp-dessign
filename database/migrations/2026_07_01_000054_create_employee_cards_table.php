<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained('id_card_templates')->cascadeOnDelete();
            $table->date('issue_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_cards');
    }
};
