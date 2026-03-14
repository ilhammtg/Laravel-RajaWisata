<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('location_url')->nullable()->after('location');
            $table->text('map_iframe')->nullable()->after('location_url');
            $table->text('details')->nullable()->after('description');
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->string('location_url')->nullable()->after('location');
            $table->text('map_iframe')->nullable()->after('location_url');
            $table->text('details')->nullable()->after('description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('location_url')->nullable()->after('location');
            $table->text('map_iframe')->nullable()->after('location_url');
            $table->text('details')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['location_url', 'map_iframe', 'details']);
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['location_url', 'map_iframe', 'details']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['location_url', 'map_iframe', 'details']);
        });
    }
};
