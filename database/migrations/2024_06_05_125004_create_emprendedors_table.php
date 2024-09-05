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
        Schema::create('emprendedors', function (Blueprint $table) {
           
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->date('fecha_nacimiento');
            $table->string('password');
            $table->integer('telefono');
            $table->string('imagen');
            $table->string('correo');
            $table->string('ubicacion');
            $table->integer('numero');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprendedors');
    }
};
