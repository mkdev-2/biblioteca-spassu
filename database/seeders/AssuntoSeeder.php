<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assunto;

class AssuntoSeeder extends Seeder
{
    public function run()
    {
        Assunto::factory()->count(10)->create(); 
    }
}
