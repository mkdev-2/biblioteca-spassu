<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\AutorRequest;
use Illuminate\Database\QueryException;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::simplePaginate(10);
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.form');
    }

    public function store(AutorRequest $request)
    {
        $this->validateAutor($request);

        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso.');
    }

    public function edit(Autor $autor)
    {
        return view('autores.form', compact('autor'));
    }
    
    public function update(AutorRequest $request, Autor $autor)
    {
        $this->validateAutor($request);

        $autor->update($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso.');
    }

    public function destroy(Autor $autor)
    {
        try {
            $autor->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    private function validateAutor(Request $request)
    {
        $request->validate([
            'Nome' => 'required|max:40'
        ]);
    }
}