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
        Schema::create('entrepreneurships', function (Blueprint $table) {
            $table->id();
            $table->string('entrepreneurship_name');
            $table->string('description');
            $table->string('specifications');
            $table->string('category');

            $table->unsignedBigInteger('entrepreneur_id')->nullable();
            $table->foreign('entrepreneur_id')
                  ->references('id')
                  ->on('entrepreneurs')->onDelete('cascade');

            $table->unsignedBigInteger('publish_entrepreneurships_id')->nullable();
            $table->foreign('publish_entrepreneurships_id')
                  ->references('id')
                  ->on('publish_entrepreneurships')->onDelete('cascade');

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
        Schema::dropIfExists('entrepreneurships');
    }
};
