<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\AutorRequest;
use Illuminate\Database\QueryException;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $autores = Autor::when($search, function ($query, $search) {
            return $query->where('Nome', 'like', '%' . $search . '%');
        })->simplePaginate(10);
        return view('autores.index', compact('autores', 'search'));
    }

    public function create()
    {
        return view('autores.form');
    }


    public function show(Autor $autor)
    {
        $livros = $autor->livros;
        return view('autores.show', compact('autor', 'livros'));
    }

    public function store(AutorRequest $request, Autor $autor)
    {
        $autor->create($request->validated());
        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso.');
    }

    public function edit(Autor $autor)
    {
        return view('autores.form', compact('autor'));
    }
    
    public function update(AutorRequest $request, Autor $autor)
    {
        $autor->update($request->validated());
        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso.');
    }

    public function destroy(Autor $autor)
    {
        if ($autor->livros()->exists()) {
            return redirect()->route('autores.index')->with('error', 'Não é possível excluir um autor vinculado a um ou mais livros.');
        }

        $autor->delete();
        
        return redirect()->route('autores.index')
        ->with('success', 'Autor excluído com sucesso!');
    }
    
}