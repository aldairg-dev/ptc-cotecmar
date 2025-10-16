<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Luis Marinero',
            'email' => 'luis@example.com',
            'password' => bcrypt('0000')
        ]);

        User::factory()->create([
            'name' => 'Gabriel Técnico',
            'email' => 'gabriel@example.com',
            'password' => bcrypt('1111')
        ]);

        User::factory()->create([
            'name' => 'Sergio Supervisor',
            'email' => 'sergio@example.com',
            'password' => bcrypt('2222')
        ]);

        $this->call([
            ProyectoSeeder::class,
            BloqueSeeder::class,
            PiezaSeeder::class,
        ]);
    }
}
