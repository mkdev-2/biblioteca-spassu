<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivroFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_livro_pode_ser_criado_via_formulario()
    {
        $assunto = \App\Models\Assunto::factory()->create();
        $autor = \App\Models\Autor::factory()->create();
        
        $data = [
            'Titulo' => 'Livro via POST',
            'Editora' => 'Editora Exemplo',
            'Edicao' => 2,
            'AnoPublicacao' => 2022,
            'Valor' => 39.99,
            'autores' => [$autor->CodAu], 
            'assuntos' => [$assunto->CodAs], 
        ];

        $response = $this->post('/livros', $data);
        $response->assertStatus(302); 

        $this->assertDatabaseHas('livros', [
            'Titulo' => 'Livro via POST',
            'Editora' => 'Editora Exemplo',
            'Edicao' => 2,
            'AnoPublicacao' => 2022,
            'Valor' => 39.99,
        ]);

        $this->assertDatabaseHas('livro_autor', [
            'Autor_CodAu' => $autor->CodAu, 
            'Livro_CodLi' => Livro::where('Titulo', 'Livro via POST')->first()->CodLi, 
        ]);

        $this->assertDatabaseHas('livro_assunto', [
            'Assunto_CodAs' => $assunto->CodAs, 
            'Livro_CodLi' => Livro::where('Titulo', 'Livro via POST')->first()->CodLi,
        ]);
    }

    
    
    /** @test */
    public function livro_nao_e_criado_com_dados_invalidos()
    {
        $data = [
            'Editora' => 'Editora Exemplo',
            'Edicao' => 2,
            'AnoPublicacao' => 2022,
            'Valor' => 39.99,
            'autores' => [], 
            'assuntos' => [] 
        ];

        $response = $this->post('/livros', $data);

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['Titulo']);
        
        $response->assertSessionHasErrors(['autores', 'assuntos']);
    }

}