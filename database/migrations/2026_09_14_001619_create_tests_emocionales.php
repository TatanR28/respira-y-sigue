<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests_emocionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('puntaje_estres');
            $table->unsignedTinyInteger('puntaje_ansiedad');
            $table->string('nivel_estres');
            $table->string('nivel_ansiedad');
            $table->string('categoria_recomendada');
            $table->json('respuestas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests_emocionales');
    }
};