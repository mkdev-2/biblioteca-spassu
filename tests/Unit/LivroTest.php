<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class LivroTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function um_livro_pode_ser_criado()
    {
        $livro = Livro::create([
            'Titulo' => 'Livro de Teste',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => 2023,
            'Valor' => 49.99
        ]);

        $this->assertDatabaseHas('livros', [
            'Titulo' => 'Livro de Teste'
        ]);
    }

    #[Test]
    public function um_livro_pode_ter_autores_e_assuntos_associados()
    {
        $autor = Autor::factory()->create(); 
        $assunto = Assunto::factory()->create(); 
        $livro = Livro::factory()->create(); 
    
        $livro->autores()->attach($autor->CodAu);
        $livro->assuntos()->attach($assunto->CodAs);
    
        $this->assertDatabaseHas('livro_autor', [
            'Autor_CodAu' => $autor->CodAu,
            'Livro_CodLi' => $livro->CodLi,
        ]);
        $this->assertDatabaseHas('livro_assunto', [
            'Assunto_CodAs' => $assunto->CodAs,
            'Livro_CodLi' => $livro->CodLi,
        ]);
    }
    
}