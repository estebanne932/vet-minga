<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medicamentos_aplicados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('consulta_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('medicamento');
            $table->string('dosis')->nullable();
            $table->string('frecuencia')->nullable();
            $table->string('periodo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamentos_aplicados');
    }
};
