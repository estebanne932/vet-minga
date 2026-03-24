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
        Schema::create('quimica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_id')->constrained()->cascadeOnDelete();

            $table->string('paciente');
            $table->string('especie');
            $table->string('veterinario');
            $table->date('fecha');

            $table->string('parametro');
            $table->string('resultado')->nullable();
            $table->string('referencia_perro')->nullable();
            $table->string('referencia_gato')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quimica');
    }
};
