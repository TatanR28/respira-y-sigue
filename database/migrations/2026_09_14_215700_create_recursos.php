<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // articulo, lectura, video, audio
            $table->string('icono')->default('📄');
            $table->string('titulo');
            $table->string('descripcion');
            $table->text('contenido')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};