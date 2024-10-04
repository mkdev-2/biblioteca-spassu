<?php

namespace Tests\Unit;

use App\Models\Livro;
use App\Repositories\LivroRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $livroRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->livroRepository = new LivroRepository();
    }

    #[Test]
    public function retorna_todos_os_livros_com_relacoes()
    {
        Livro::factory()->count(3)->create();

        $livros = $this->livroRepository->getAllWithRelations();

        $livrosCount = Livro::count();

        $this->assertCount($livrosCount, $livros);
    }

    #[Test]
    public function encontra_um_livro_pelo_id()
    {
        $livro = Livro::factory()->create();

        $livroEncontrado = $this->livroRepository->findById($livro->CodLi);

        $this->assertEquals($livro->CodLi, $livroEncontrado->CodLi);
    }
}
