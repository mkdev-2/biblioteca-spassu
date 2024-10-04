<?php

namespace App\Services;
use App\Models\Livro;
use App\Repositories\LivroRepository;

class LivroService
{
    public function findLivroById($CodLi)
    {
        return Livro::with(['autores', 'assuntos'])->findOrFail($CodLi);
    }

    protected $livroRepository;

    public function __construct(LivroRepository $livroRepository)
    {
        $this->livroRepository = $livroRepository;
    }

    public function getLivrosWithRelations($search = null)
    {
        return $this->livroRepository->getAllWithRelations($search);
    }

   /**
     *
     * @param array $data
     * @return Livro
     */
    public function createLivro(array $data)
    {
        $livro = Livro::create($data);

        if (isset($data['autores'])) {
            $livro->autores()->attach($data['autores']);
        }

        if (isset($data['assuntos'])) {
            $livro->assuntos()->attach($data['assuntos']);
        }

        return $livro;
    }

    /**
     *
     * @param int $CodLi
     * @param array $data
     * @return Livro
     */

    public function updateLivro(int $CodLi, array $data)
    {
        $livro = $this->findLivroById($CodLi);
        $livro->update($data);

        if (isset($data['autores'])) {
            $livro->autores()->sync($data['autores']);
        }

        if (isset($data['assuntos'])) {
            $livro->assuntos()->sync($data['assuntos']);
        }
        
        return $livro;
    }
     
    public function deleteLivro($CodLi)
    {
        $livro = Livro::with(['autores', 'assuntos'])->findOrFail($CodLi);
        
        if ($livro->autores()->exists()) {
            $livro->autores()->detach();
        }
    
        if ($livro->assuntos()->exists()) {
            $livro->assuntos()->detach();
        }
        $livro->delete();
    }


}