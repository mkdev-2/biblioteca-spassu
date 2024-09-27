<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Services\LivroService;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    protected $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $livros = $this->livroService->getLivrosWithRelations($search);

        return view('livros.index', compact('livros', 'search'));
    }

    public function create()
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();

        return view('livros.form', compact('autores', 'assuntos'));
    }

    public function store(LivroRequest $request)
    {
        $data = $request->all();
        
        $request->merge(['Valor' => $data['Valor']]);
        
        $validatedData = $request->validate($request->rules());
        
        $this->livroService->createLivro($validatedData);

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function show($CodLi)
    {
        $livro = $this->livroService->findLivroById($CodLi);
        
        return view('livros.show', compact('livro'));
    }

    public function edit($CodLi)
    {
        $livro = $this->livroService->findLivroById($CodLi);
        $autores = Autor::all();
        $assuntos = Assunto::all();

        return view('livros.form', compact('livro', 'autores', 'assuntos'));
    }

    public function update(LivroRequest $request, $CodLi)
    {
        $data = $request->all();
        
        $request->merge(['Valor' => $data['Valor']]);
        
        $validatedData = $request->validate($request->rules());
        
        $this->livroService->updateLivro($CodLi, $validatedData);

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }
    public function destroy($CodLi)
    {
        try {
            $this->livroService->deleteLivro($CodLi);
            return response()->json(['success' => true], 200); 
        } catch (\Exception $e) {
            \Log::error('Erro ao deletar livro: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Erro ao deletar livro.'], 500);
        }
    }
    
}
