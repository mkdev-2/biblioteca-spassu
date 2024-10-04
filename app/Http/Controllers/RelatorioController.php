<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\RelatorioRepositoryInterface;
use App\Exports\SimpleExport;
use App\Services\LivroService;

class RelatorioController extends Controller
{
    protected $relatorioRepository;
    protected $livroService;

    public function __construct(RelatorioRepositoryInterface $relatorioRepository, LivroService $livroService)
    {
        $this->relatorioRepository = $relatorioRepository;
        $this->livroService = $livroService;
    }

    public function index()
    {

        $livros = $this->livroService->getLivrosWithRelations();
        return view('relatorios.index', compact('livros')); 
    }

    public function visualizarRelatorio(Request $request)
    {
        $tipo = $request->input('tipo');
        $livros = $this->relatorioRepository->getLivrosByType($tipo);  
        if ($livros === null || $livros->isEmpty()) {
            return view('relatorios.visualizar', compact('livros', 'tipo'))
                ->with('error', 'Não há dados disponíveis para este tipo de relatório. Por favor, cadastre mais informações.');
        }
    
        return view('relatorios.visualizar', compact('livros', 'tipo'));
    }  

    public function gerarRelatorio(Request $request)
    {
        $tipo = $request->input('tipo');
        $livros = $this->relatorioRepository->getLivrosByType($tipo);
        if ($livros === null || $livros->isEmpty()) {
            return redirect()->route('relatorios.index')
                             ->with('error', 'Não há dados suficientes para gerar este relatório. Por favor, cadastre mais informações.');
        }

        return Excel::download(new SimpleExport($livros), $tipo . '.xlsx');
    }
}
