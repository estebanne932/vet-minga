<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('propietario_id')
                ->constrained('propietarios')
                ->cascadeOnDelete();

            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->cascadeOnDelete();

            $table->text('motivo')->nullable();
            $table->date('fecha')->nullable();
            $table->string('veterinario')->nullable();

            $table->text('diagnosticos_diferenciales')->nullable();
            $table->text('diagnostico_definitivo')->nullable();

            $table->string('firma')->nullable();

            $table->string('estatus')->default('abierta');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};