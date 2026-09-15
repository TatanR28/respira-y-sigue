<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->string('categoria'); // respiracion, relajacion, mindfulness, meditacion
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('instrucciones');
            $table->unsignedSmallInteger('duracion_minutos')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};