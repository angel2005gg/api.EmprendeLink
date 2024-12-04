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

            // Clave foránea a la tabla 'entrepreneurs'
            $table->foreignId('entrepreneur_id') // Singular y más limpio
                ->nullable()
                ->constrained('entrepreneurs') // Hace referencia a la tabla 'entrepreneurs'
                ->onDelete('cascade');

            // Clave foránea a la tabla 'investors'
            $table->foreignId('investor_id')
                ->nullable()
                ->constrained('investors') // Hace referencia a la tabla 'investors'
                ->onDelete('cascade');

            // Clave foránea a la tabla 'publish_entrepreneurships'
            $table->foreignId('publish_entrepreneurship_id') // Singular y limpio
                ->nullable()
                ->constrained('publish_entrepreneurships') // Hace referencia a la tabla
                ->onDelete('cascade');

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
