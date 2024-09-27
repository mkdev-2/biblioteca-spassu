@extends('layout') 

@section('title', 'Bem-vindo à Biblioteca Digital')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center">
            <h1 class="display-4 mb-4 text-primary">
                <i class="bi bi-book-half"></i> Bem-vindo à Biblioteca Digital
            </h1>
            <p class="lead mb-4">
                <i class="bi bi-pencil"></i> Gerencie seus livros, autores e assuntos de maneira simples e eficiente. Selecione uma das opções abaixo para começar:
            </p>

            <div class="row g-4 justify-content-center">
                <!-- Card para Livros -->
                <div class="col-md-4">
                    <div class="card card-body p-4 text-center shadow" style="border: 1px solid #F48221;">
                        <div class="icon mb-3">
                            <i class="bi bi-book" style="font-size: 3rem; color: #F48221;"></i>
                        </div>
                        <h5 class="card-title">Livros</h5>
                        <p class="card-text">Visualize, adicione ou edite seus livros facilmente.</p>
                        <a href="{{ route('livros.index') }}" class="btn btn-block mt-3 d-flex align-items-center justify-content-center" style="background-color: #0054A6; color: white;">
                            <i class="bi bi-arrow-right-circle me-2"></i> <span>Acessar Livros</span>
                        </a>
                    </div>
                </div>

                <!-- Card para Autores -->
                <div class="col-md-4">
                    <div class="card card-body p-4 text-center shadow" style="border: 1px solid #F48221;">
                        <div class="icon mb-3">
                            <i class="bi bi-person-fill" style="font-size: 3rem; color: #F48221;"></i>
                        </div>
                        <h5 class="card-title">Autores</h5>
                        <p class="card-text">Gerencie informações de autores aqui.</p>
                        <a href="{{ route('autores.index') }}" class="btn btn-block mt-3 d-flex align-items-center justify-content-center" style="background-color: #0054A6; color: white;">
                            <i class="bi bi-arrow-right-circle me-2"></i> <span>Acessar Autores</span>
                        </a>
                    </div>
                </div>

                <!-- Card para Assuntos -->
                <div class="col-md-4">
                    <div class="card card-body p-4 text-center shadow" style="border: 1px solid #F48221;">
                        <div class="icon mb-3">
                            <i class="bi bi-tags-fill" style="font-size: 3rem; color: #F48221;"></i>
                        </div>
                        <h5 class="card-title">Assuntos</h5>
                        <p class="card-text">Organize os assuntos de seus livros.</p>
                        <a href="{{ route('assuntos.index') }}" class="btn btn-block mt-3 d-flex align-items-center justify-content-center" style="background-color: #0054A6; color: white;">
                            <i class="bi bi-arrow-right-circle me-2"></i> <span>Acessar Assuntos</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
