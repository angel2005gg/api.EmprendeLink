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
        Schema::create('usuarios_invercionistas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('emprendedors_id')->nullable();
            $table->foreign('emprendedors_id')
            ->references('id')
            ->on('emprendedors')->onDelete('cascade');

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
        Schema::dropIfExists('usuarios_invercionistas');
    }
};
