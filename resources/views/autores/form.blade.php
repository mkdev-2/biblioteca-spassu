@extends('layout')

@section('title', isset($autor) ? 'Editar Autor' : 'Cadastrar Novo Autor')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-person-plus-fill"></i> 
                {{ isset($autor) ? 'Editar Autor' : 'Cadastrar Novo Autor' }}
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($autor) ? route('autores.update', $autor->CodAu) : route('autores.store') }}" method="POST" novalidate>
                @csrf
                @if(isset($autor))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Autor</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="nome" 
                        name="Nome" 
                        value="{{ old('Nome', $autor->Nome ?? '') }}" 
                        required 
                        maxlength="40"
                        pattern=".{2,}" 
                        title="O nome deve ter no mínimo 2 caracteres."
                    >
                    <div class="invalid-feedback">
                        O nome do autor é obrigatório e deve ter no máximo 40 caracteres.
                    </div>
                </div>
                <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">{{ isset($autor) ? 'Atualizar' : 'Salvar' }}</button>

            </form>
        </div>
    </div>
</div>
@endsection