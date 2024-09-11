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
        Schema::create('entrepreneursLists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrepreneurs_id')->nullable();
            $table->foreign('entrepreneurs_id')
                  ->references('id')
                  ->on('entrepreneurs')->onDelete('cascade');
            $table->timestamps();

            $table->unsignedBigInteger('investors_id')->nullable();
            $table->foreign('investors_id')
                  ->references('id')
                  ->on('investors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneurLists');
    }
};
