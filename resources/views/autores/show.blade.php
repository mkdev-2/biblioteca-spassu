@extends('layout')

@section('title', 'Detalhes do Autor')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-person"></i> 
                Detalhes do Autor: {{ $autor->Nome }}
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Autor</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="nome" 
                    name="Nome" 
                    value="{{ $autor->Nome }}" 
                    readonly
                >
            </div>
            
            @if(isset($livros) && $livros->isNotEmpty())
                <div class="mb-3">
                    <label for="livros" class="form-label">Livros Associados</label>
                    <ul class="list-group">
                        @foreach($livros as $livro)
                            <li class="list-group-item">{{ $livro->Titulo }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>Este autor ainda não possui livros associados.</p>
            @endif
            
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('autores.edit', $autor->CodAu) }}" class="btn btn-primary">Editar Autor</a>
        </div>
    </div>
</div>
@endsection
