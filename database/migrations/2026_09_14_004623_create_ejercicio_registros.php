<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ejercicio_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ejercicio_id')->constrained('ejercicios')->cascadeOnDelete();
            $table->timestamp('completado_en')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicio_registros');
    }
};