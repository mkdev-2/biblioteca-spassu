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
        $this->createLivrosDisponiveisView();
        $this->createLivrosPorAnoView();
    }

    public function dropViews()
    {
        DB::statement('DROP VIEW IF EXISTS livros_por_autor');
        DB::statement('DROP VIEW IF EXISTS livros_por_assunto');
        DB::statement('DROP VIEW IF EXISTS livros_disponiveis');
        DB::statement('DROP VIEW IF EXISTS livros_por_ano');
    }

    public function getLivrosByType(string $tipo)
    {
        $this->createViews();
        switch ($tipo) {
            case 'livros_por_autor':
                return DB::table('livros_por_autor')->get();
            case 'livros_por_assunto':
                return DB::table('livros_por_assunto')->get(); 
            case 'livros_disponiveis':
                return DB::table('livros_disponiveis')->get();
            case 'livros_por_ano':
                return DB::table('livros_por_ano')->get();
            default:
                return null;
        }
    }

    private function dropExistingViews()
    {
        DB::statement('DROP VIEW IF EXISTS livros_por_autor');
        DB::statement('DROP VIEW IF EXISTS livros_por_assunto');
        DB::statement('DROP VIEW IF EXISTS livros_disponiveis');
        DB::statement('DROP VIEW IF EXISTS livros_por_ano');
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

    private function createLivrosDisponiveisView()
    {
        DB::statement("
        CREATE VIEW livros_disponiveis AS
        SELECT 
            l.Titulo AS titulo,
            l.Editora AS editora,
            l.Edicao AS edicao,
            l.AnoPublicacao AS ano_publicacao,
            l.Valor AS valor,
            GROUP_CONCAT(DISTINCT a.Nome SEPARATOR ',') AS autor,
            GROUP_CONCAT(DISTINCT s.Descricao SEPARATOR ',') AS assuntos
        FROM
            livros l
        LEFT JOIN livro_autor la ON l.CodLi = la.Livro_CodLi
        LEFT JOIN autores a ON la.Autor_CodAu = a.CodAu
        LEFT JOIN livro_assunto las ON l.CodLi = las.Livro_CodLi
        LEFT JOIN assuntos s ON las.Assunto_CodAs = s.CodAs
        WHERE 
            l.deleted_at IS NULL 
        GROUP BY 
            l.CodLi, l.Titulo, l.Editora, l.Edicao, l.AnoPublicacao, l.Valor;
    ");
    
    
    }

    private function createLivrosPorAnoView()
    {
        DB::statement("
            CREATE VIEW livros_por_ano AS
            SELECT 
                l.AnoPublicacao AS ano_publicacao,
                l.Titulo AS titulo,
                l.Editora AS editora,
                l.Edicao AS edicao,
                l.Valor AS valor,
                GROUP_CONCAT(DISTINCT a.Nome SEPARATOR ',') AS autor,
                GROUP_CONCAT(DISTINCT s.Descricao SEPARATOR ',') AS assuntos
            FROM 
                livros l
            LEFT JOIN 
                livro_autor la ON l.CodLi = la.Livro_CodLi
            LEFT JOIN 
                autores a ON la.Autor_CodAu = a.CodAu
            LEFT JOIN 
                livro_assunto las ON l.CodLi = las.Livro_CodLi
            LEFT JOIN 
                assuntos s ON las.Assunto_CodAs = s.CodAs
            WHERE 
                l.deleted_at IS NULL 
            GROUP BY 
                l.AnoPublicacao, l.Titulo, l.Editora, l.Edicao, l.Valor
        ");
    }

}
