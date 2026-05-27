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
        Schema::create('eutanacias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mascota_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('propietario_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('fecha');

            $table->string('veterinario');

            $table->decimal('peso', 5, 2)->nullable();

            $table->text('observaciones')->nullable();

            $table->boolean('consentimiento_firmado')->default(false);
            

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eutanacias');
    }
};
