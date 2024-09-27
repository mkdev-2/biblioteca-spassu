<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;
use App\Http\Requests\AssuntoRequest;
use Illuminate\Database\QueryException;

class AssuntoController extends Controller
{
    public function index()
    {
        $assuntos = Assunto::simplePaginate(10);
        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.form');
    }

    public function store(AssuntoRequest $request)
    {
        $this->validateAssunto($request);

        Assunto::create($request->all());
        return redirect()->route('assuntos.index')->with('success', 'Assunto criado com sucesso.');
    }

    public function edit(Assunto $assunto)
    {
        return view('assuntos.form', compact('assunto'));
    }
    
    public function update(AssuntoRequest $request, Assunto $assunto)
    {
        $this->validateAssunto($request);

        $assunto->update($request->all());
        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso.');
    }

    public function destroy(Assunto $assunto)
    {
        try {
            $assunto->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    private function validateAssunto(Request $request)
    {
        $request->validate([
            'Descricao' => 'required|max:20'
        ]);
    }
}