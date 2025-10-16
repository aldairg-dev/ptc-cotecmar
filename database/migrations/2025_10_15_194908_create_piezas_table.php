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
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('codigo')->unique();
            $table->string('idpieza')->unique();
            $table->string('pieza');
            $table->foreignId('bloque_id')->constrained('bloques')->onDelete('cascade');
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->decimal('peso_teorico', 10, 3);
            $table->decimal('peso_real', 10, 3)->nullable();
            $table->string('material')->nullable();
            $table->enum('estado', ['Pendiente', 'Fabricado', 'Otro'])->default('Pendiente');
            $table->timestamp('fecha_registro')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
