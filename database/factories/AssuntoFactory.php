<?php

namespace Database\Factories;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssuntoFactory extends Factory
{
    protected $model = Assunto::class;

    public function definition()
    {
        return [
            'Descricao' => $this->faker->word, 
        ];
    }
}
