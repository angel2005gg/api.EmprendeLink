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
        Schema::create('publicar__emprendimientos', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->integer('phone_number');
            $table->string('mail');
            $table->string('description');
            $table->string('location');
            $table->string('url');
            $table->date('date_exp');
             
            $table->unsignedBigInteger('emprendedors_id')->nullable();
            $table->foreign('emprendedors_id')
            ->references('id')
            ->on('emprendedors')->onDelete('cascade');
          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicar__emprendimientos');
    }
};
