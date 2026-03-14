<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->text('address')->after('location')->nullable();
            $table->string('phone')->after('address')->nullable();
            $table->string('opening_hours')->after('phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('culinaries', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone', 'opening_hours']);
        });
    }
};
