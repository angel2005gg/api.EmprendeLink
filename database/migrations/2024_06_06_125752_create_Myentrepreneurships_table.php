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
        Schema::create('Myentrepreneurships', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('entrepreneur_id')->nullable();
            $table->foreign('entrepreneur_id')
                  ->references('id')
                  ->on('entrepreneurs')->onDelete('cascade');

            $table->unsignedBigInteger('publishEntrepreneurships_id')->nullable();
            $table->foreign('publishEntrepreneurships_id')
                  ->references('id')
                  ->on('publishEntrepreneurships')->onDelete('cascade');

            $table->unsignedBigInteger('investor_id')->nullable();
            $table->foreign('investor_id')
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
        Schema::dropIfExists('Myentrepreneurships');
    }
};
