<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('user_type', 50)->default('super_admin')->after('school_id');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('photo')->nullable()->after('phone');
            $table->string('status', 20)->default('active')->after('photo');
            $table->timestamp('last_login_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('school_id');
            $table->dropColumn(['user_type', 'phone', 'photo', 'status', 'last_login_at']);
        });
    }
};
