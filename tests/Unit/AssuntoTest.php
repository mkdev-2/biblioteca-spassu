<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_assunto_pode_ser_criado()
    {
        $assunto = Assunto::create([
            'Descricao' => 'Assunto de Teste',
        ]);

        $this->assertDatabaseHas('assuntos', [
            'Descricao' => 'Assunto de Teste'
        ]);
    }

    /** @test */
    public function um_assunto_pode_ser_associado_a_um_livro()
    {
        $assunto = Assunto::factory()->create();
        $livro = Livro::factory()->create(); 
    
        $livro->assuntos()->attach($assunto->CodAs);
    
        $this->assertDatabaseHas('livro_assunto', [
            'Assunto_CodAs' => $assunto->CodAs,
            'Livro_CodLi' => $livro->CodLi,
        ]);
    }
    
}