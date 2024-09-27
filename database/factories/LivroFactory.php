<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition()
    {
        return [
            'Titulo' => $this->faker->text(40),
            'Editora' => $this->faker->company,
            'Edicao' => $this->faker->numberBetween(1, 10),
            'AnoPublicacao' => $this->faker->year,
            'Valor' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
