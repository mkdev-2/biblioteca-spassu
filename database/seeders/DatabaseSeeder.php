<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AutorSeeder::class,
            LivroSeeder::class,
            AssuntoSeeder::class,
            LivroAutorSeeder::class,
            LivroAssuntoSeeder::class,
        ]);
    }
}
