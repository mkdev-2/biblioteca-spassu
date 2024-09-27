<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Assunto;

class LivroAssuntoSeeder extends Seeder
{
    public function run()
    {
        $livros = Livro::all();
        $assuntos = Assunto::all();

        foreach ($livros as $livro) {
            $livro->assuntos()->attach(
                $assuntos->random(rand(1, 3))->pluck('CodAs')->toArray()
            );
        }
    }
}
