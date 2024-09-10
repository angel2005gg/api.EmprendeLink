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
        Schema::create('EntrepreneurLists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrepreneur_id')->nullable();
            $table->foreign('entrepreneur_id')
                  ->references('id')
                  ->on('entrepreneurs')->onDelete('cascade');
            $table->timestamps();

            $table->unsignedBigInteger('investor_id')->nullable();
            $table->foreign('investor_id')
                  ->references('id')
                  ->on('investors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('EntrepreneurLists');
    }
};
