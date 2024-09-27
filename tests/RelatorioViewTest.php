<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RelatorioViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_view_livros_por_autor_retorna_dados_corretamente()
    {
        $autor = Autor::factory()->create(); 
        $livro = Livro::factory()->create(); 
        $livro->autores()->attach($autor->CodAu); 
        $response = $this->get(route('nome.da.sua.rota', ['autor' => $autor->CodAu]));
    
        $response->assertViewHas('livros'); 
        $this->assertNotNull($response->viewData['livros']); 
    }
    

    /** @test */
    public function a_view_manipula_varios_autores_para_um_unico_livro()
    {
        $livro = Livro::factory()->create(); 
        $autor1 = Autor::factory()->create(); 
        $autor2 = Autor::factory()->create(); 
    
        $livro->autores()->attach([$autor1->CodAu, $autor2->CodAu]);
    
        $response = $this->get(route('nome.da.sua.rota', ['livro' => $livro->CodLi]));
    
        $response->assertViewHas('autores', function ($autores) use ($autor1, $autor2) {
            return $autores->contains('CodAu', $autor1->CodAu) && $autores->contains('CodAu', $autor2->CodAu);
        });
    
        $this->assertCount(2, $response->viewData['autores']);
    }

    /** @test */
    public function a_view_handles_books_without_authors()
    {
        $livro = Livro::factory()->create(['Titulo' => 'Livro Sem Autor']);

        $result = \DB::table('livros_por_autor')
                    ->where('Titulo', 'Livro Sem Autor')
                    ->first();

        $this->assertNull($result);
    }

    /** @test */
    public function a_view_handles_authors_without_books()
    {
        $autor = Autor::factory()->create(['Nome' => 'Autor Sem Livro']);

        $result = \DB::table('livros_por_autor')
                    ->where('Autor', 'Autor Sem Livro')
                    ->first();

        $this->assertNull($result);
    }

}