<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class RelatorioViewTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function o_metodo_index_deve_retornar_a_view_relatorios_index_com_dados_de_livros()
    {
        $livro = Livro::factory()->create();

        $response = $this->get(route('relatorios.index'));
        $response->assertViewIs('relatorios.index');

        $response->assertViewHas('livros');
    }

    #[Test]
    public function a_view_deve_retornar_livros_por_autor()
    {
        $autor = Autor::factory()->create(); 
        $livro = Livro::factory()->create(['Titulo' => 'Livro com Múltiplos Autores e Assuntos']); 
        $livro->autores()->attach($autor->CodAu);

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_por_autor']));

        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains(function ($value) use ($livro) {
                return $value->Titulo === $livro->Titulo;
            });
        });
    }
    #[Test]
    public function a_view_deve_retornar_livros_por_assunto()
    {
        $assunto = Assunto::factory()->create();
        $livro = Livro::factory()->create(['Titulo' => 'Livro com Múltiplos Autores e Assuntos']);
        $livro->assuntos()->attach($assunto->CodAs);

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_por_assunto']));

        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains(function ($value) use ($livro) {
                return $value->Titulo === $livro->Titulo;
            });
        });
    }
    
    #[Test]
    public function a_view_deve_retornar_livros_por_editora()
    {
        $livro = Livro::factory()->create();

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_por_editora']));

        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains('Editora', $livro->Editora);
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_livros_por_ano_de_publicacao()
    {
        $ano = '2023';
        $livro = Livro::factory()->create(['AnoPublicacao' => $ano]);
    
        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_por_ano']));
    
        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains('AnoPublicacao', $livro->AnoPublicacao);
        });
    
        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_livros_mais_recentes()
    {
        $livro = Livro::factory()->create();

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_mais_recentes']));

        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains('Titulo', $livro->Titulo);
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_valor_total_por_autor()
    {
        $autor = Autor::factory()->create();
        $livro = Livro::factory()->create(['Valor' => 100]);
        $livro->autores()->attach($autor->CodAu);

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'valor_total_por_autor']));

        $response->assertViewHas('livros', function ($livros) use ($autor) {
            return $livros->contains('Nome', $autor->Nome);
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_livros_por_faixa_de_preco()
    {
        $livro = Livro::factory()->create(['Valor' => 30]);

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_por_faixa_preco']));

        $response->assertViewHas('livros', function ($livros) {
            return $livros->contains('FaixaDePreco', '20-49,99');
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_livros_com_multiplos_autores()
    {
        $autor1 = Autor::factory()->create();
        $autor2 = Autor::factory()->create();
        $livro = Livro::factory()->create();

        $livro->autores()->attach([$autor1->CodAu, $autor2->CodAu]);

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'livros_multiplos_autores']));

        $response->assertViewHas('livros', function ($livros) use ($livro) {
            return $livros->contains('Titulo', $livro->Titulo);
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_autores_com_mais_publicacoes()
    {
        $autor = Autor::factory()->create();
        Livro::factory(3)->create()->each(function ($livro) use ($autor) {
            $livro->autores()->attach($autor->CodAu);
        });

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'autores_mais_publicacoes']));

        $response->assertViewHas('livros', function ($livros) use ($autor) {
            return $livros->contains('Nome', $autor->Nome);
        });

        $this->assertNotNull($response->viewData('livros'));
    }

    #[Test]
    public function a_view_deve_retornar_assuntos_com_mais_livros()
    {
        $assunto = Assunto::factory()->create();
        Livro::factory(3)->create()->each(function ($livro) use ($assunto) {
            $livro->assuntos()->attach($assunto->CodAs);
        });

        $response = $this->get(route('relatorios.visualizar', ['tipo' => 'assuntos_mais_livros']));

        $response->assertViewHas('livros', function ($livros) use ($assunto) {
            return $livros->contains('Assuntos', $assunto->Descricao);
        });

        $this->assertNotNull($response->viewData('livros'));
    }
}
