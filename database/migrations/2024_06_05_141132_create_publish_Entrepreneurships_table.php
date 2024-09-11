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
            $table->integer('phone_number');
            $table->string('email');
            $table->string('description');
            $table->string('location');
            $table->string('url');
            $table->date('expiration_date');
             
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
