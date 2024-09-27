<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\RelatorioRepositoryInterface;
use App\Exports\SimpleExport;

class RelatorioController extends Controller
{
    protected $relatorioRepository;

    public function __construct(RelatorioRepositoryInterface $relatorioRepository)
    {
        $this->relatorioRepository = $relatorioRepository;
    }

    public function index()
    {
        return view('relatorios.index'); 
    }

    public function visualizarRelatorio(Request $request)
    {
        $tipo = $request->input('tipo');
        $livros = $this->relatorioRepository->getLivrosByType($tipo);
        if ($livros === null || $livros->isEmpty()) {
            return redirect()->route('relatorios.index')
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
