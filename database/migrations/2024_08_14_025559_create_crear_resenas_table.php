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
        Schema::create('crear_resenas', function (Blueprint $table) {
            $table->id();
            $table->string('qualification');//calificacion
            $table->string('comment');//comentario

            $table->unsignedBigInteger('emprendimientos_id')->nullable();
            $table->foreign('emprendimientos_id')
            ->references('id')
            ->on('emprendimientos')->onDelete('cascade');

            $table->unsignedBigInteger('inversionistas_id')->nullable();
            $table->foreign('inversionistas_id')
            ->references('id')
            ->on('inversionistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crear_resenas');
    }
};
