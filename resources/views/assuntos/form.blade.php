@extends('layout')

@section('title', isset($assunto) ? 'Editar Assunto' : 'Cadastrar Novo Assunto')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-plus-circle"></i> 
                {{ isset($assunto) ? 'Editar Assunto' : 'Cadastrar Novo Assunto' }}
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($assunto) ? route('assuntos.update', $assunto->CodAs) : route('assuntos.store') }}" 
                  method="POST" novalidate>
                @csrf
                @if(isset($assunto))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="Descricao" class="form-label">Descrição do Assunto</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="Descricao" 
                        name="Descricao" 
                        value="{{ old('Descricao', $assunto->Descricao ?? '') }}" 
                        required 
                        maxlength="20"
                        pattern=".{2,}" 
                        title="O nome deve ter no mínimo 2 caracteres."
                    >
                    <div class="invalid-feedback">
                        O Assunto é obrigatório e deve ter no máximo 20 caracteres.
                    </div>
                </div>
                <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">{{ isset($assunto) ? 'Atualizar' : 'Salvar' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection