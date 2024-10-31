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
        Schema::create('entrepreneurs', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->date('birth_date');
            $table->string('password');
            $table->integer('phone');
            $table->string('image');
            $table->string('email');
            $table->string('location');
            $table->integer('number');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneurs');
    }
};
