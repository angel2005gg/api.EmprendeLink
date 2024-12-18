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
        Schema::create('publish_Entrepreneurships', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slogan');
            $table->string('category');
            $table->text('general_description');
            $table->string('logo_path');
            $table->string('background');
            $table->string('name_products');
            $table->json('product_images')->nullable();
            $table->text('product_descriptions');
            
            $table->unsignedBigInteger('entrepreneurs_id')->nullable();
            $table->foreign('entrepreneurs_id')
                ->references('id')
                ->on('entrepreneurs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publish_Entrepreneurships');
    }
};
