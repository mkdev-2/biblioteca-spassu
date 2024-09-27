<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SimpleExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        $headings = [];
        
        if ($this->data->isNotEmpty()) {
            $firstItem = $this->data->first();
            if (!empty($firstItem->autor)) $headings[] = 'Autor';
            if (!empty($firstItem->titulo)) $headings[] = 'Título';
            if (!empty($firstItem->editora)) $headings[] = 'Editora';
            if (!empty($firstItem->edicao)) $headings[] = 'Edição';
            if (!empty($firstItem->ano_publicacao)) $headings[] = 'Ano de Publicação';
            if (!empty($firstItem->valor)) $headings[] = 'Valor';
            if (!empty($firstItem->assuntos)) $headings[] = 'Assunto';
        }

        return $headings;
    }

    public function map($livro): array
    {
        $row = [];
        
        if (!empty($livro->autor)) $row[] = $livro->autor;
        if (!empty($livro->titulo)) $row[] = $livro->titulo;
        if (!empty($livro->editora)) $row[] = $livro->editora;
        if (!empty($livro->edicao)) $row[] = $livro->edicao;
        if (!empty($livro->ano_publicacao)) $row[] = $livro->ano_publicacao;
        if (!empty($livro->valor)) $row[] = 'R$ ' . number_format($livro->valor, 2, ',', '.');
        if (!empty($livro->assuntos)) $row[] = $livro->assuntos;

        return $row;
    }
}
