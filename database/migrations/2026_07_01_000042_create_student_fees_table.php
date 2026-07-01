<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('month');
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('fine', 10, 2)->default(0);
            $table->decimal('paid', 10, 2)->default(0);
            $table->string('status');
            $table->timestamps();

            $table->unique(['student_id', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
