<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;
use App\Http\Requests\AssuntoRequest;
use Illuminate\Database\QueryException;

class AssuntoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $assuntos = Assunto::when($search, function ($query, $search) {
            return $query->where('Descricao', 'like', '%' . $search . '%');
        })->simplePaginate(10);
        return view('assuntos.index', compact('assuntos', 'search'));
    }

    public function create()
    {
        return view('assuntos.form');
    }

    public function show($Assunto)
    {
        $assunto = Assunto::findOrFail($Assunto['CodAs']);
        return view('assuntos.show', compact('assunto'));
    }

    public function store(AssuntoRequest $request, Assunto $assunto)
    {
        $assunto->create($request->validated());
        return redirect()->route('assuntos.index')->with('success', 'Assunto criado com sucesso.');
    }

    public function edit(Assunto $assunto)
    {
        return view('assuntos.form', compact('assunto'));
    }
    
    public function update(AssuntoRequest $request, Assunto $assunto)
    {
        $assunto->update($request->validated());
        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso.');
    }

    public function destroy(Assunto $assunto)
    {
        if ($assunto->livros()->exists()) {
            return redirect()->route('assuntos.index')->with('error', 'Não é possível excluir um assunto vinculado a um ou mais livros.');
        }
        $assunto->delete();
        
        return redirect()->route('assuntos.index')
            ->with('success', 'Assunto excluído com sucesso!');
    }

}