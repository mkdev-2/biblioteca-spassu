@extends('layout')

@section('title', 'Visualizar Assunto')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-eye"></i> Visualizar Assunto
            </h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Descricao" class="form-label">Descrição do Assunto</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="Descricao" 
                    name="Descricao" 
                    value="{{ $assunto->Descricao }}" 
                    disabled 
                >
            </div>
            <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('assuntos.edit', $assunto->CodAs) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection
