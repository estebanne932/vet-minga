<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('examen_fisicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('consulta_id')
                ->constrained('consultas')
                ->cascadeOnDelete();

            $table->string('punto');
            $table->text('respuesta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examen_fisicos');
    }
};
