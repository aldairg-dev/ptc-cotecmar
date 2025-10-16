<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de prueba según las especificaciones
        \App\Models\User::factory()->create([
            'name' => 'Luis Marinero',
            'email' => 'luis@example.com',
            'password' => bcrypt('0000')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Gabriel Técnico',
            'email' => 'gabriel@example.com',
            'password' => bcrypt('1111')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sergio Supervisor',
            'email' => 'sergio@example.com',
            'password' => bcrypt('2222')
        ]);

        // Ejecutar los seeders en orden
        $this->call([
            ProyectoSeeder::class,
            BloqueSeeder::class,
            PiezaSeeder::class,
        ]);
    }
}
