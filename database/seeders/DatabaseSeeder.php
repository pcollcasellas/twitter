<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Twit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'Pau',
            'username' => 'PColl',
            'email' => 'pcoll@exemple.com',
            'password' => '$2y$10$6dv0BZpT.jljCz9/xePvEuyLJiE4sLSiKxiuZK/8ov3nq/FVu56UO'
        ]);

        User::factory(20)->create();

    $users = User::all();

    foreach ($users as $user) {
        // Crear 5 twits per cada usuari
        Twit::factory(5)->create([
            'user_id' => $user->id
        ]);

        // Crear 5 seguidors aleatoris per cada usuari
        $followers = $users->filter(function ($value) use ($user) {
            return $value->id != $user->id; // Evitar que un usuari es segueixi a si mateix
        })->shuffle()->take(5);

        foreach ($followers as $follower) {
            $user->followers()->attach($follower);
        }
    }
    }
}
