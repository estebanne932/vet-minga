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
        Schema::create('mascotas', function (Blueprint $table) {

            $table->id();

            $table->string('nombre');

            $table->string('especie');

            $table->string('raza')
                ->nullable();

            $table->integer('edad')
                ->nullable();

            $table->decimal('peso', 5, 2)
                ->nullable();

            $table->boolean('esterilizado')
                ->default(false);

            $table->foreignId('propietario_id')
                ->constrained('propietarios')
                ->cascadeOnDelete();

            $table->string('qr_code')
                ->nullable();

            $table->string('imagen')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
