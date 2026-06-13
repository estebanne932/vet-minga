<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfil_tiroides', function (Blueprint $table) {
            $table->dropColumn(['color', 'aspecto']);
        });
    }

    public function down(): void
    {
        Schema::table('perfil_tiroides', function (Blueprint $table) {
            $table->string('color')->nullable();
            $table->string('aspecto')->nullable();
        });
    }
};