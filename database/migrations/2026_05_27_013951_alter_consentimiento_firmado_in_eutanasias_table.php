<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('eutanasias', function (Blueprint $table) {
            $table->string('consentimiento_firmado')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('eutanasias', function (Blueprint $table) {
            $table->integer('consentimiento_firmado')->nullable()->change();
        });
    }
};