<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class LivroFeatureTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        Livro::query()->delete();
    }
    #[Test]
    public function um_livro_pode_ser_criado_via_formulario()
    {
        $assunto = Assunto::factory()->create();
        $autor = Autor::factory()->create();
        
        $data = [
            'Titulo' => 'Livro via POST',
            'Editora' => 'Editora Exemplo',
            'Edicao' => 2,
            'AnoPublicacao' => '2022',
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
            'AnoPublicacao' => '2022',
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

    #[Test]
    public function um_livro_pode_ser_visualizado()
    {
        $livro = Livro::factory()->create();

        $response = $this->get(route('livros.show', ['livro' => $livro->CodLi]));

        $response->assertStatus(200);
        $response->assertViewHas('livro', $livro);
    }

    #[Test]
    public function um_livro_pode_ser_atualizado_via_formulario()
    {
        $autor = Autor::factory()->create();
        $assunto = Assunto::factory()->create();
        
        $livro = Livro::factory()->create();
    
        $data = [
            'Titulo' => 'Livro Atualizado',
            'Editora' => 'Editora Atualizada',
            'Edicao' => 3,
            'AnoPublicacao' => '2023',
            'Valor' => '49.99',
            'autores' => [$autor->CodAu], 
            'assuntos' => [$assunto->CodAs],
        ];
    
        $response = $this->put(route('livros.update', ['livro' => $livro->CodLi]), $data);
        $this->assertDatabaseHas('livros', [
            'CodLi' => $livro->CodLi,
            'Titulo' => 'Livro Atualizado',
            'Editora' => 'Editora Atualizada',
            'Edicao' => 3,
            'AnoPublicacao' => '2023',
            'Valor' => 49.99,
        ]);
    
        $this->assertDatabaseHas('livro_autor', [
            'Livro_CodLi' => $livro->CodLi,
            'Autor_CodAu' => $autor->CodAu,
        ]);
    
        $this->assertDatabaseHas('livro_assunto', [
            'Livro_CodLi' => $livro->CodLi,
            'Assunto_CodAs' => $assunto->CodAs,
        ]);
    
        $response->assertRedirect(route('livros.index'));
    }
    
    #[Test]
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

    #[Test]
    public function a_view_deve_tratar_livros_sem_autores()
    {
        $livro = Livro::factory()->create(['Titulo' => 'Livro Sem Autor']);

        $this->assertTrue($livro->autores->isEmpty());
    }

    #[Test]
    public function a_view_deve_manipular_varios_autores_para_um_livro()
    {
        $livro = Livro::factory()->create(); 
        $autor1 = Autor::factory()->create(); 
        $autor2 = Autor::factory()->create(); 
    
        $livro->autores()->attach([$autor1->CodAu, $autor2->CodAu]);
    
        $response = $this->get(route('livros.show', ['livro' => $livro->CodLi]));
    
        $response->assertViewHas('livro', function ($livro) use ($autor1, $autor2) {
            return $livro->autores->contains('CodAu', $autor1->CodAu) && $livro->autores->contains('CodAu', $autor2->CodAu);
        });
    
        $this->assertCount(2, $response->viewData('livro')->autores);
    }

    #[Test]
    public function a_view_index_deve_retornar_todos_os_livros()
    {
        $livros = Livro::factory()->count(3)->create();

        $response = $this->get(route('livros.index'));

        $response->assertStatus(200);
        $response->assertViewHas('livros', function ($viewLivros) use ($livros) {
            return $viewLivros->count() === 3 && $viewLivros->contains($livros->first());
        });
    }

    #[Test]
    public function um_livro_pode_ser_criado_com_multiplos_autores_e_assuntos()
    {
        $autor1 = Autor::factory()->create();
        $autor2 = Autor::factory()->create();
        $assunto1 = Assunto::factory()->create();
        $assunto2 = Assunto::factory()->create();

        $data = [
            'Titulo' => 'Livro com Múltiplos Autores e Assuntos',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => '2022',
            'Valor' => 59.99,
            'autores' => [$autor1->CodAu, $autor2->CodAu],
            'assuntos' => [$assunto1->CodAs, $assunto2->CodAs],
        ];

        $response = $this->post('/livros', $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('livros', [
            'Titulo' => 'Livro com Múltiplos Autores e Assuntos',
            'Editora' => 'Editora Teste',
            'Edicao' => 1,
            'AnoPublicacao' => 2022,
            'Valor' => 59.99,
        ]);

        $livro = Livro::where('Titulo', 'Livro com Múltiplos Autores e Assuntos')->first();

        $this->assertDatabaseHas('livro_autor', [
            'Autor_CodAu' => $autor1->CodAu,
            'Livro_CodLi' => $livro->CodLi,
        ]);

        $this->assertDatabaseHas('livro_autor', [
            'Autor_CodAu' => $autor2->CodAu,
            'Livro_CodLi' => $livro->CodLi,
        ]);

        $this->assertDatabaseHas('livro_assunto', [
            'Assunto_CodAs' => $assunto1->CodAs,
            'Livro_CodLi' => $livro->CodLi,
        ]);

        $this->assertDatabaseHas('livro_assunto', [
            'Assunto_CodAs' => $assunto2->CodAs,
            'Livro_CodLi' => $livro->CodLi,
        ]);
    }

    #[Test]
    public function um_livro_vinculado_a_autores_ou_assuntos_nao_deve_ser_excluido()
    {
        $autor = Autor::factory()->create();
        $assunto = Assunto::factory()->create();
    
        $livro = Livro::factory()->create();
        $livro->autores()->attach($autor->CodAu);
        $livro->assuntos()->attach($assunto->CodAs);
    
        $response = $this->delete(route('livros.destroy', ['livro' => $livro->CodLi]));
    
        $response->assertRedirect(route('livros.index'));
    
        $response->assertSessionHas('success', 'Livro excluído com sucesso e todos os vínculos removidos.');
    
        $this->assertSoftDeleted('livros', ['CodLi' => $livro->CodLi]);
    
        $this->assertDatabaseMissing('livro_autor', ['Livro_CodLi' => $livro->CodLi]);
        $this->assertDatabaseMissing('livro_assunto', ['Livro_CodLi' => $livro->CodLi]);
    }
    

    #[Test]
    public function a_view_create_esta_disponivel()
    {
        $response = $this->get(route('livros.create'));

        $response->assertStatus(200);
        $response->assertViewIs('livros.form');
    }

    #[Test]
    public function a_view_edit_esta_disponivel()
    {
        $livro = Livro::factory()->create();

        $response = $this->get(route('livros.edit', ['livro' => $livro->CodLi]));

        $response->assertStatus(200);
        $response->assertViewIs('livros.form');
        $response->assertViewHas('livro', $livro);
    }
}
