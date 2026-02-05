@extends('layout')

@section('content')
    <a href="{{ route('series.index') }}" class="btn btn-secondary mb-3">
        ← Voltar para listagem
    </a>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cadastro de Usuário </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Digite seu nome" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Digite um e-mail" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" id="password" name="password" placeholder="Digite sua senha" class="form-control"
                                value="{{ old('password') }}">
                        </div>

                        

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
