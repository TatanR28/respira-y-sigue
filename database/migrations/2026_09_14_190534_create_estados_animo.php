<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estados_animo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('valor'); // 1 = Muy mal ... 5 = Muy bien
            $table->date('fecha');
            $table->timestamps();

            $table->unique(['user_id', 'fecha']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estados_animo');
    }
};