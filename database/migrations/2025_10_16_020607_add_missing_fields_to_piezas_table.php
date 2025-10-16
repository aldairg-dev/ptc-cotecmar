<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('piezas', function (Blueprint $table) {
            $table->decimal('peso_real', 10, 3)->nullable()->after('peso_teorico');
            $table->timestamp('fecha_registro')->nullable()->after('peso_real');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('fecha_registro');
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->cascadeOnDelete()->after('bloque_id');

            $table->string('idpieza')->nullable()->after('codigo');
            $table->string('pieza')->nullable()->after('idpieza');
        });

        DB::statement('UPDATE piezas SET proyecto_id = (SELECT proyecto_id FROM bloques WHERE bloques.id = piezas.bloque_id)');

        DB::statement('UPDATE piezas SET idpieza = CAST(id AS TEXT), pieza = "P" || CAST(id AS TEXT) WHERE idpieza IS NULL');

        Schema::table('piezas', function (Blueprint $table) {
            $table->string('idpieza')->nullable(false)->unique()->change();
            $table->string('pieza')->nullable(false)->change();
            $table->foreignId('proyecto_id')->nullable(false)->change();
        });

        Schema::table('piezas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('piezas', function (Blueprint $table) {
            $table->enum('estado', ['Pendiente', 'Fabricado', 'Otro'])->default('Pendiente')->after('pieza');
        });

        DB::statement("UPDATE piezas SET estado = 'Pendiente' WHERE estado IS NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('piezas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['proyecto_id']);
            $table->dropColumn([
                'peso_real',
                'fecha_registro',
                'user_id',
                'proyecto_id',
                'idpieza',
                'pieza'
            ]);

            $table->dropColumn('estado');
        });

        Schema::table('piezas', function (Blueprint $table) {
            $table->enum('estado', ['pendiente', 'fabricada', 'rechazada'])->default('pendiente');
        });
    }
};
