<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AutorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function um_autor_pode_ser_criado()
    {
        $autor = Autor::create([
            'Nome' => 'Autor de Teste',
        ]);

        $this->assertDatabaseHas('autores', [
            'Nome' => 'Autor de Teste'
        ]);
    }

    #[Test]
    public function um_autor_pode_ser_associado_a_um_livro()
    {
        $autor = Autor::factory()->create(); 
        $livro = Livro::factory()->create(); 
    
        $livro->autores()->attach($autor->CodAu);
    
        $this->assertDatabaseHas('livro_autor', [
            'Autor_CodAu' => $autor->CodAu,
            'Livro_CodLi' => $livro->CodLi,
        ]);
    }
    
}