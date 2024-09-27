@extends('layout')

@section('title', isset($livro) ? 'Editar Livro' : 'Cadastrar Novo Livro')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">
                <i class="bi bi-book"></i> 
                {{ isset($livro) ? 'Editar Livro' : 'Cadastrar Novo Livro' }}
            </h4>
        </div>
        <div class="card-body">
            <form id="livroForm" action="{{ isset($livro) ? route('livros.update', $livro->CodLi) : route('livros.store') }}" method="POST" novalidate>
                @csrf
                @if(isset($livro))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            id="titulo"
                            name="Titulo"
                            value="{{ old('Titulo', $livro->Titulo ?? '') }}"
                            maxlength="40"
                            minlength="2"
                            required
                        >
                        <div class="invalid-feedback">
                            O título é obrigatório e deve ter entre 2 e 40 caracteres.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="editora" class="form-label">Editora</label>
                        <input
                            type="text"
                            class="form-control"
                            id="editora"
                            name="Editora"
                            value="{{ old('Editora', $livro->Editora ?? '') }}"
                            maxlength="40"
                            required
                        >
                        <div class="invalid-feedback">
                            A editora é obrigatória e deve ter no máximo 40 caracteres.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="edicao" class="form-label">Edição</label>
                        <input
                            type="number"
                            class="form-control"
                            id="edicao"
                            name="Edicao"
                            value="{{ old('Edicao', $livro->Edicao ?? '') }}"
                            min="1"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                        >
                        <div class="invalid-feedback">
                            A edição é obrigatória e deve ser um número inteiro positivo.
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="anoPublicacao" class="form-label">Ano de Publicação</label>
                        <input
                            type="text"
                            class="form-control"
                            id="anoPublicacao"
                            name="AnoPublicacao"
                            value="{{ old('AnoPublicacao', $livro->AnoPublicacao ?? '') }}"
                            maxlength="4"
                            pattern="\d{4}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                        >
                        <div class="invalid-feedback">
                            O ano de publicação deve ser um número de 4 dígitos.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input
                                type="text"
                                class="form-control"
                                id="valor"
                                name="Valor"
                                value="{{ old('Valor', isset($livro) ? number_format($livro->Valor, 2, ',', '.') : '') }}"
                                minlength="4"
                                maxlength="10"
                                oninput="formatCurrency(this)"
                                required
                            >
                            <div class="invalid-feedback">
                                O valor deve ser um número positivo com no máximo 6 dígitos inteiros e 2 casas decimais.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="autores" class="form-label">Autores</label>
                        <select class="form-control" id="autores" name="autores[]" multiple="multiple" required>
                            @foreach ($autores as $autor)
                                <option value="{{ $autor->CodAu }}" {{ (isset($livro) && $livro->autores->contains($autor->CodAu)) ? 'selected' : '' }}>
                                    {{ $autor->Nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Você deve selecionar pelo menos um autor.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="assuntos" class="form-label">Assuntos</label>
                        <select class="form-control" id="assuntos" name="assuntos[]" multiple="multiple" required>
                            @foreach ($assuntos as $assunto)
                                <option value="{{ $assunto->CodAs }}" {{ (isset($livro) && $livro->assuntos->contains($assunto->CodAs)) ? 'selected' : '' }}>
                                    {{ $assunto->Descricao }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Você deve selecionar pelo menos um assunto.
                        </div>
                    </div>
                </div>
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">{{ isset($livro) ? 'Atualizar' : 'Salvar' }}</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#autores').select2({
            placeholder: 'Selecione um ou mais autores',
            allowClear: true
        });

        $('#assuntos').select2({
            placeholder: 'Selecione um ou mais assuntos',
            allowClear: true
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const valorInput = document.getElementById('valor');
        if (valorInput && valorInput.value) {
            formatCurrency(valorInput);
        }
    });

    let valorFormatadoOriginal;

    document.getElementById('livroForm').addEventListener('submit', function(event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            // Caso a validação falhe, restaura o valor formatado original
            if (valorFormatadoOriginal) {
                valorInput.value = valorFormatadoOriginal;
            }
        } else {
            // Armazena o valor formatado original
            let valorInput = this.querySelector('input[name="Valor"]');
            valorFormatadoOriginal = valorInput.value;
            
            // Remove a formatação para envio
            let valorFormatado = valorInput.value.replace(/\./g, '');
            valorFormatado = valorFormatado.replace(',', '.');
            valorInput.value = valorFormatado;
        }

        this.classList.add('was-validated');
    }, false);

    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, '');

        value = (value / 100).toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });

        input.value = value;
    }
</script>

@endsection
