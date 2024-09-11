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
        Schema::create('connections', function (Blueprint $table) {
            $table->id('id_connection');
            $table->integer("chat");
            
            
            $table->unsignedBigInteger('entrepreneurs_id')->nullable();
            $table->foreign('entrepreneurs_id')
            ->references('id')
            ->on('entrepreneurs')->onDelete('cascade');

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
        Schema::dropIfExists('connections');
    }
};
