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
            if (!empty($firstItem->Nome)) $headings[] = 'Autor';
            if (!empty($firstItem->Titulo)) $headings[] = 'Título';
            if (!empty($firstItem->Editora)) $headings[] = 'Editora';
            if (!empty($firstItem->Edicao)) $headings[] = 'Edição';
            if (!empty($firstItem->AnoPublicacao)) $headings[] = 'Ano de Publicação';
            if (!empty($firstItem->Valor)) $headings[] = 'Valor';
            if (!empty($firstItem->Assuntos)) $headings[] = 'Assunto';
        }

        return $headings;
    }

    public function map($livro): array
    {
        $row = [];
        
        if (!empty($livro->Nome)) $row[] = $livro->Nome;
        if (!empty($livro->Titulo)) $row[] = $livro->Titulo;
        if (!empty($livro->Editora)) $row[] = $livro->Editora;
        if (!empty($livro->Edicao)) $row[] = $livro->Edicao;
        if (!empty($livro->AnoPublicacao)) $row[] = $livro->AnoPublicacao;
        if (!empty($livro->Valor)) $row[] = 'R$ ' . number_format($livro->Valor, 2, ',', '.');
        if (!empty($livro->Assuntos)) $row[] = $livro->Assuntos;

        return $row;
    }
}
