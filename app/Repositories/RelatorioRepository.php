<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RelatorioRepository implements RelatorioRepositoryInterface
{
    public function createViews()
    {
        $this->dropViews();
        $this->createLivrosPorAutorView();
        $this->createLivrosPorAssuntoView();
        $this->createLivrosPorEditoraView();
        $this->createLivrosPorAnoView();
        $this->createLivrosMaisRecentesView();
        $this->createValorTotalPorAutorView();
        $this->createLivrosPorFaixaDePrecoView();
        $this->createLivrosComMultiplosAutoresView();
        $this->createAutoresComMaisPublicacoesView();
        $this->createAssuntosComMaisLivrosView();
    }

    public function dropViews()
    {
        $views = [
            'livros_por_autor', 'livros_por_assunto', 'livros_por_editora', 
            'livros_por_ano', 'livros_mais_recentes', 'valor_total_por_autor',
            'livros_por_faixa_preco', 'livros_multiplos_autores', 
            'autores_mais_publicacoes', 'assuntos_mais_livros'
        ];

        foreach ($views as $view) {
            DB::statement("DROP VIEW IF EXISTS $view");
        }
    }

    public function getLivrosByType(string $tipo)
    {
        $this->createViews(); // Cria ou recria as views do banco de dados
    
        switch ($tipo) {
            case 'livros_por_autor':
                return DB::table('livros_por_autor')
                    ->select(
                        'autor as Nome', 
                        'titulo as Titulo',
                        'editora as Editora',
                        'edicao as Edicao',
                        'ano_publicacao as AnoPublicacao',
                        'valor as Valor',
                        'assuntos as Assuntos'
                    )
                    ->get();
    
            case 'livros_por_assunto':
                return DB::table('livros_por_assunto')
                    ->select(
                        'assuntos as Assuntos', 
                        'titulo as Titulo',
                        'editora as Editora',
                        'edicao as Edicao',
                        'ano_publicacao as AnoPublicacao',
                        'valor as Valor',
                        'autor as Nome'
                    )
                    ->get(); 
    
            case 'livros_por_editora':
                return DB::table('livros_por_editora')
                    ->select(
                        'Editora', 
                        'quantidade as Quantidade',
                        'titulos as Titulos'
                    )
                    ->get();
    
            case 'livros_por_ano':
                return DB::table('livros_por_ano')
                    ->select(
                        'ano_publicacao as AnoPublicacao',
                        'quantidade as Quantidade',
                        'titulos as Titulos'
                    )
                    ->get();
    
            case 'livros_mais_recentes':
                return DB::table('livros_mais_recentes')
                    ->select(
                        'titulo as Titulo',
                        'editora as Editora',
                        'ano_publicacao as AnoPublicacao',
                        'valor as Valor',
                        'autores as Autores'
                    )
                    ->get();
    
            case 'valor_total_por_autor':
                return DB::table('valor_total_por_autor')
                ->select(
                    'Nome as Nome', 
                    'ValorTotal as ValorTotal',
                    'ValorMedio as ValorMedio',
                    'Quantidade as Quantidade'
                )
                ->get();
            
    
            case 'livros_por_faixa_preco':
                return DB::table('livros_por_faixa_preco')
                    ->select(
                        'faixa_preco as FaixaDePreco',
                        'quantidade as Quantidade',
                        'titulos as Titulos'
                    )
                    ->get();
    
            case 'livros_multiplos_autores':
                return DB::table('livros_multiplos_autores')
                    ->select(
                        'titulo as Titulo',
                        'editora as Editora',
                        'ano_publicacao as AnoPublicacao',
                        'autor as Nome'
                    )
                    ->get();
    
            case 'autores_mais_publicacoes':
                return DB::table('autores_mais_publicacoes')
                    ->select(
                        'autor as Nome',
                        'quantidade as Quantidade',
                        'titulos as Titulos'
                    )
                    ->get();
    
            case 'assuntos_mais_livros':
                return DB::table('assuntos_mais_livros')
                    ->select(
                        'assuntos as Assuntos',
                        'quantidade as Quantidade',
                        'titulos as Titulos'
                    )
                    ->get();
            default:
                return null;
        }
    }
    

    private function createLivrosPorAutorView()
    {
        DB::statement("
            CREATE VIEW livros_por_autor AS
            SELECT 
                a.Nome AS autor,
                l.Titulo AS titulo,
                l.Editora AS editora,
                l.Edicao AS edicao,
                l.AnoPublicacao AS ano_publicacao,
                l.Valor AS valor,
                GROUP_CONCAT(s.Descricao) AS assuntos
            FROM 
                autores a
            JOIN 
                livro_autor la ON a.CodAu = la.Autor_CodAu
            JOIN 
                livros l ON la.Livro_CodLi = l.CodLi
            JOIN 
                livro_assunto las ON l.CodLi = las.Livro_CodLi
            JOIN 
                assuntos s ON las.Assunto_CodAs = s.CodAs
            GROUP BY 
                a.Nome, l.Titulo, l.Editora, l.Edicao, l.AnoPublicacao, l.Valor
        ");
    }

    private function createLivrosPorAssuntoView()
    {
        DB::statement("
            CREATE VIEW livros_por_assunto AS
            SELECT 
                s.Descricao AS assuntos,
                l.Titulo AS titulo,
                l.Editora AS editora,
                l.Edicao AS edicao,
                l.AnoPublicacao AS ano_publicacao,
                l.Valor AS valor,
                GROUP_CONCAT(a.Nome) AS autor
            FROM 
                assuntos s
            JOIN 
                livro_assunto la ON s.CodAs = la.Assunto_CodAs
            JOIN 
                livros l ON la.Livro_CodLi = l.CodLi
            JOIN 
                livro_autor la2 ON l.CodLi = la2.Livro_CodLi
            JOIN 
                autores a ON la2.Autor_CodAu = a.CodAu
            GROUP BY 
                s.Descricao, l.Titulo, l.Editora, l.Edicao, l.AnoPublicacao, l.Valor
        ");
    }

    private function createLivrosPorEditoraView()
    {
        DB::statement("
            CREATE VIEW livros_por_editora AS
            SELECT 
                l.Editora,
                COUNT(l.CodLi) AS quantidade,
                GROUP_CONCAT(l.Titulo) AS titulos
            FROM 
                livros l
            GROUP BY 
                l.Editora
        ");
    }

    private function createLivrosPorAnoView()
    {
        DB::statement("
            CREATE VIEW livros_por_ano AS
            SELECT 
                l.AnoPublicacao AS ano_publicacao,
                COUNT(l.CodLi) AS quantidade,
                GROUP_CONCAT(l.Titulo) AS titulos
            FROM 
                livros l
            GROUP BY 
                l.AnoPublicacao
        ");
    }

    private function createLivrosMaisRecentesView()
    {
        DB::statement("
            CREATE VIEW livros_mais_recentes AS
            SELECT 
                l.Titulo AS titulo,
                l.Editora AS editora,
                l.AnoPublicacao AS ano_publicacao,
                l.Valor AS valor,
                GROUP_CONCAT(DISTINCT a.Nome) AS autores
            FROM 
                livros l
            LEFT JOIN 
                livro_autor la ON l.CodLi = la.Livro_CodLi
            LEFT JOIN 
                autores a ON la.Autor_CodAu = a.CodAu
            GROUP BY 
                l.CodLi, l.Titulo, l.Editora, l.AnoPublicacao, l.Valor
            ORDER BY 
                l.AnoPublicacao DESC
        ");
    }
    
    private function createValorTotalPorAutorView()
    {
        DB::statement("
            CREATE VIEW valor_total_por_autor AS
            SELECT 
                a.Nome AS Nome,
                SUM(l.Valor) AS ValorTotal,
                AVG(l.Valor) AS ValorMedio,
                COUNT(l.CodLi) AS Quantidade
            FROM 
                autores a
            JOIN 
                livro_autor la ON a.CodAu = la.Autor_CodAu
            JOIN 
                livros l ON la.Livro_CodLi = l.CodLi
            GROUP BY 
                a.Nome
        ");
    }

    private function createLivrosPorFaixaDePrecoView()
    {
        DB::statement("
            CREATE VIEW livros_por_faixa_preco AS
            SELECT 
                CASE
                    WHEN COALESCE(l.Valor, 0) < 20 THEN '0-19,99'
                    WHEN COALESCE(l.Valor, 0) >= 20 AND COALESCE(l.Valor, 0) < 50 THEN '20-49,99'
                    WHEN COALESCE(l.Valor, 0) >= 50 AND COALESCE(l.Valor, 0) < 100 THEN '50-99,99'
                    ELSE '100+'
                END AS faixa_preco,
                COUNT(l.CodLi) AS quantidade,
                GROUP_CONCAT(l.Titulo) AS titulos
            FROM 
                livros l
            WHERE 
                l.deleted_at IS NULL
            GROUP BY 
                faixa_preco
        ");

    }

    private function createLivrosComMultiplosAutoresView()
    {
        DB::statement("
            CREATE VIEW livros_multiplos_autores AS
            SELECT 
                l.Titulo AS titulo,
                l.Editora AS editora,
                l.AnoPublicacao AS ano_publicacao,
                GROUP_CONCAT(a.Nome) AS autor
            FROM 
                livros l
            JOIN 
                livro_autor la ON l.CodLi = la.Livro_CodLi
            JOIN 
                autores a ON la.Autor_CodAu = a.CodAu
            GROUP BY 
                l.Titulo, l.Editora, l.AnoPublicacao
            HAVING 
                COUNT(a.CodAu) > 1
        ");
    }
    
    private function createAutoresComMaisPublicacoesView()
    {
        DB::statement("
            CREATE VIEW autores_mais_publicacoes AS
            SELECT 
                a.Nome AS autor,
                COUNT(l.CodLi) AS quantidade,
                GROUP_CONCAT(l.Titulo) AS titulos
            FROM 
                autores a
            JOIN 
                livro_autor la ON a.CodAu = la.Autor_CodAu
            JOIN 
                livros l ON la.Livro_CodLi = l.CodLi
            GROUP BY 
                a.Nome
            ORDER BY 
                quantidade DESC
        ");
    }

    private function createAssuntosComMaisLivrosView()
    {
        DB::statement("
            CREATE VIEW assuntos_mais_livros AS
            SELECT 
                s.Descricao AS assuntos,
                COUNT(l.CodLi) AS quantidade,
                GROUP_CONCAT(l.Titulo) AS titulos
            FROM 
                assuntos s
            JOIN 
                livro_assunto la ON s.CodAs = la.Assunto_CodAs
            JOIN 
                livros l ON la.Livro_CodLi = l.CodLi
            GROUP BY 
                s.Descricao
            ORDER BY 
                quantidade DESC
        ");
    }

}
