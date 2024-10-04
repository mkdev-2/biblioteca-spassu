<?php

namespace App\Repositories;

use App\Models\Livro;

class LivroRepository
{
    public function getAllWithRelations($search = null)
    {
        return Livro::with(['autores:CodAu,Nome', 'assuntos:CodAs,Descricao'])
                    ->when($search, function ($query, $search) {
                        return $query->where('Titulo', 'like', '%' . $search . '%');
                    })
                    ->simplePaginate(10);
    }

    public function findById($id)
    {
        return Livro::with(['autores:CodAu,Nome', 'assuntos:CodAs,Descricao'])->findOrFail($id);
    }
}
