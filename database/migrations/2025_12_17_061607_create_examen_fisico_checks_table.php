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
        Schema::create('examen_fisico_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('punto');
            $table->boolean('respuesta'); // true = sí, false = no
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_fisico_checks');
    }
};
