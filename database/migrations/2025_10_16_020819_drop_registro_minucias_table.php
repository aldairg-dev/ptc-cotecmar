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
        Schema::dropIfExists('registro_minucias');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('registro_minucias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('bloque_id')->constrained('bloques')->onDelete('cascade');
            $table->foreignId('pieza_id')->constrained('piezas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('peso_real', 10, 3);
            $table->decimal('diferencia_peso', 10, 3);
            $table->timestamp('fecha_registro');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }
};
