<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AssuntoTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function um_assunto_pode_ser_criado()
    {
        $assunto = Assunto::create([
            'Descricao' => 'Assunto de Teste',
        ]);

        $this->assertDatabaseHas('assuntos', [
            'Descricao' => 'Assunto de Teste'
        ]);
    }

    #[Test]
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