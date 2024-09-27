<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Autor;

class LivroAutorSeeder extends Seeder
{
    public function run()
    {
        $livros = Livro::all();
        $autores = Autor::all();

        foreach ($livros as $livro) {
            $livro->autores()->attach(
                $autores->random(rand(1, 3))->pluck('CodAu')->toArray()
            );
        }
    }
}
