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
        Schema::create('reviews', function (Blueprint $table)  {
            $table->id();
            $table->string('qualification'); // Rating
            $table->string('comment'); // Comment
            
            $table->unsignedBigInteger('publish_Entrepreneurships_id')->nullable();
            $table->foreign('publish_Entrepreneurships_id')
                ->references('id')
                ->on('publish_Entrepreneurships')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
