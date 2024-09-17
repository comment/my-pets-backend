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
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('image_type'); // тип фото(user,pet,todo)
            $table->string('filename');
            $table->string('mime_type');
            $table->integer('size');
            $table->string('path');
            $table->timestamps();

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
