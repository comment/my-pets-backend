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
        Schema::create('pets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identifier')->unique();
            $table->string('nickname');
            $table->timestamp('date_of_birth')->nullable();
            $table->text('about');
            $table->timestamps();

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('type_id')->references('id')->on('pet_types');
            $table->foreignUuid('sub_type_id')->references('id')->on('pet_sub_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
