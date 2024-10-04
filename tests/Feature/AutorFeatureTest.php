<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AutorFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Autor::query()->delete();
    }
    #[Test]
    public function um_autor_pode_ser_criado_via_formulario()
    {
        $data = ['Nome' => 'Autor via POST'];

        $response = $this->post('/autores', $data);

        $this->assertDatabaseHas('autores', ['Nome' => 'Autor via POST']);
        $response->assertRedirect('/autores');
    }

    #[Test]
    public function autor_nao_e_criado_com_dados_invalidos()
    {
        $data = ['Nome' => ''];

        $response = $this->post('/autores', $data);

        $response->assertSessionHasErrors(['Nome']);
    }

    #[Test]
    public function um_autor_pode_ser_atualizado_via_formulario()
    {
        $autor = Autor::factory()->create(['Nome' => 'Autor Original']);

        $data = ['Nome' => 'Autor Atualizado'];

        $response = $this->put(route('autores.update', ['autor' => $autor->CodAu]), $data);

        $this->assertDatabaseHas('autores', ['CodAu' => $autor->CodAu, 'Nome' => 'Autor Atualizado']);
        $response->assertRedirect(route('autores.index'));
    }

    #[Test]
    public function um_autor_pode_ser_visualizado()
    {
        $autor = Autor::factory()->create(['Nome' => 'Autor Visualizado']);

        $response = $this->get(route('autores.show', ['autor' => $autor->CodAu]));

        $response->assertStatus(200);
        $response->assertViewHas('autor', $autor);
    }
    #[Test]
    public function um_autor_nao_vinculado_a_livros_pode_ser_excluido()
    {
        $autor = Autor::factory()->create();
    
        $response = $this->delete(route('autores.destroy', ['autor' => $autor->CodAu]));
    
        $this->assertSoftDeleted('autores', ['CodAu' => $autor->CodAu]);
    
        $response->assertStatus(302);
        $response->assertRedirect(route('autores.index'));
    }
    
    #[Test]
    public function um_autor_vinculado_a_livros_nao_pode_ser_excluido()
    {
        $autor = Autor::factory()->create();
    
        $livro = Livro::factory()->create();
        $livro->autores()->attach($autor->CodAu);
    
        $response = $this->delete(route('autores.destroy', ['autor' => $autor->CodAu]));
    
        $response->assertStatus(302);
        $response->assertRedirect(route('autores.index'));
    
        $response->assertSessionHas('error', 'Não é possível excluir um autor vinculado a um ou mais livros.');
    
        $this->assertDatabaseHas('autores', ['CodAu' => $autor->CodAu, 'deleted_at' => null]);
    }

    #[Test]
    public function a_view_index_deve_retornar_todos_os_autores()
    {
        $autores = Autor::factory()->count(3)->create();

        $response = $this->get(route('autores.index'));

        $response->assertStatus(200);
        $response->assertViewHas('autores', function ($viewAutores) use ($autores) {
            return $viewAutores->count() === 3 && $viewAutores->contains($autores->first());
        });
    }

    #[Test]
    public function a_view_deve_tratar_autores_sem_livros()
    {
        $autor = Autor::factory()->create(['Nome' => 'Autor Sem Livro']);
        $this->assertTrue($autor->livros->isEmpty());
    }

    #[Test]
    public function a_view_create_esta_disponivel()
    {
        $response = $this->get(route('autores.create'));

        $response->assertStatus(200);
        $response->assertViewIs('autores.form');
    }

    #[Test]
    public function a_view_edit_esta_disponivel()
    {
        $autor = Autor::factory()->create();

        $response = $this->get(route('autores.edit', ['autor' => $autor->CodAu]));

        $response->assertStatus(200);
        $response->assertViewIs('autores.form');
        $response->assertViewHas('autor', $autor);
    }

}