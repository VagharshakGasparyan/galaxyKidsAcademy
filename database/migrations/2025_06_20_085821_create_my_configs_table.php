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
        Schema::create('my_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('group_key')->default('default');
            $table->json('json_value')->nullable();
            $table->text('value1')->nullable();
            $table->text('value2')->nullable();
            $table->text('value3')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_configs');
    }
};
