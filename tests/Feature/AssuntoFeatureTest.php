<?php 

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AssuntoFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Assunto::query()->delete();
    }
    
    #[Test]
    public function um_assunto_pode_ser_criado_via_formulario()
    {
        $data = ['Descricao' => 'Assunto via POST'];

        $response = $this->post('/assuntos', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/assuntos');
        $this->assertDatabaseHas('assuntos', ['Descricao' => 'Assunto via POST']);
    }

    #[Test]
    public function assunto_nao_e_criado_com_dados_invalidos()
    {
        $data = ['Descricao' => ''];

        $response = $this->post('/assuntos', $data);

        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['Descricao']);
    }

    #[Test]
    public function um_assunto_pode_ser_visualizado()
    {
        $assunto = Assunto::factory()->create();

        $response = $this->get(route('assuntos.show', ['assunto' => $assunto->CodAs]));

        $response->assertStatus(200);
        $response->assertViewHas('assunto', $assunto);
    }

    #[Test]
    public function um_assunto_pode_ser_atualizado_via_formulario()
    {
        $assunto = Assunto::factory()->create(['Descricao' => 'Descricao Original']);

        $data = ['Descricao' => 'Descricao Atualizada'];

        $response = $this->put(route('assuntos.update', ['assunto' => $assunto->CodAs]), $data);

        $response->assertStatus(302);
        $response->assertRedirect('/assuntos');

        $this->assertDatabaseHas('assuntos', [
            'CodAs' => $assunto->CodAs,
            'Descricao' => 'Descricao Atualizada',
        ]);
    }
    
    #[Test]
    public function um_assunto_nao_vinculado_a_livros_pode_ser_excluido()
    {
        $assunto = Assunto::factory()->create();
    
        $response = $this->delete(route('assuntos.destroy', ['assunto' => $assunto->CodAs]));
    
        $this->assertSoftDeleted('assuntos', ['CodAs' => $assunto->CodAs]);
    
        $response->assertStatus(302); // Confirma que houve redirecionamento
        $response->assertRedirect(route('assuntos.index'));
    }
    
    #[Test]
    public function um_assunto_vinculado_a_livros_nao_pode_ser_excluido()
    {
        $assunto = Assunto::factory()->create();
    
        $livro = Livro::factory()->create();
        $livro->assuntos()->attach($assunto->CodAs);
    
        $response = $this->delete(route('assuntos.destroy', ['assunto' => $assunto->CodAs]));
    
        $response->assertStatus(302); // Confirma que houve redirecionamento
    
        $response->assertRedirect(route('assuntos.index'));
    
        $response->assertSessionHas('error', 'Não é possível excluir um assunto vinculado a um ou mais livros.');
    
        $this->assertDatabaseHas('assuntos', ['CodAs' => $assunto->CodAs, 'deleted_at' => null]);
    }
    

    #[Test]
    public function a_view_index_deve_retornar_todos_os_assuntos()
    {
        $assuntos = Assunto::factory()->count(3)->create();

        $response = $this->get(route('assuntos.index'));

        $response->assertStatus(200);

        $response->assertViewHas('assuntos', function ($viewAssuntos) use ($assuntos) {
            return $viewAssuntos->count() === $assuntos->count() &&
                $viewAssuntos->pluck('CodAs')->sort()->values()->all() ===
                $assuntos->pluck('CodAs')->sort()->values()->all();
        });
    }


    #[Test]
    public function a_view_create_esta_disponivel()
    {
        $response = $this->get(route('assuntos.create'));

        $response->assertStatus(200);
        $response->assertViewIs('assuntos.form');
    }

    #[Test]
    public function a_view_edit_esta_disponivel()
    {
        $assunto = Assunto::factory()->create();

        $response = $this->get(route('assuntos.edit', ['assunto' => $assunto->CodAs]));

        $response->assertStatus(200);
        $response->assertViewIs('assuntos.form');
        $response->assertViewHas('assunto', $assunto);
    }
}
