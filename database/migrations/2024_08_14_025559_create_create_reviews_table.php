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
        Schema::create('create_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('qualification');//calificacion
            $table->string('comment');//comentario

            $table->unsignedBigInteger('entrepreneurships_id')->nullable();
            $table->foreign('entrepreneurships_id')
            ->references('id')
            ->on('entrepreneurships')->onDelete('cascade');

            $table->unsignedBigInteger('investors_id')->nullable();
            $table->foreign('investors_id')
            ->references('id')
            ->on('investors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_reviews');
    }
};
