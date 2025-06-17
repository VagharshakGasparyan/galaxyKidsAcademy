<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('enabled')->default(true);
            $table->string('type')->default('page');
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('name');
            $table->json('big_title')->nullable();
            $table->json('medium_title')->nullable();
            $table->json('small_title')->nullable();
            $table->json('content')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
