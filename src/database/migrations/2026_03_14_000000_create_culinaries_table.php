<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('culinaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->string('location')->nullable();
            $table->string('location_url')->nullable();
            $table->text('map_iframe')->nullable();
            $table->string('category')->nullable();
            $table->decimal('rating', 3, 1)->default(0.0);
            $table->string('price_range')->nullable(); // e.g., Rp 10k - 50k
            $table->string('image_url')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('culinaries');
    }
};
