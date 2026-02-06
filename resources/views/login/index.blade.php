@extends('layout')

@section('content')
    

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Login</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

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

                        

                        <div class="d-flex" style="gap: 16px">
                            <button type="submit" class="btn btn-primary">
                                Entrar
                            </button>
                            <a href="{{ route('users.create') }}" class="btn btn-secondary">
                                Cadastrar
                            </a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
