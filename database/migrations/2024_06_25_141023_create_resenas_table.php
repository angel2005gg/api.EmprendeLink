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

        Schema::create('resenas', function (Blueprint $table)  {
            $table->id();
            $table->string('qualification');//calificacion
            $table->string('comment');//comentario
            
            $table->unsignedBigInteger('publicar__emprendimientos_id')->nullable();
            $table->foreign('publicar__emprendimientos_id')
            ->references('id')
            ->on('publicar__emprendimientos')->onDelete('cascade');
            $table->timestamps();
            
         

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
