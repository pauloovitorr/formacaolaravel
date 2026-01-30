@extends('layout')

@section('content')

<a href="{{ route('series.index') }}" class="btn btn-secondary mb-3">
    ← Voltar para listagem
</a>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Editar Série</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('series.update', $serie->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            id="titulo"
                            class="form-control"
                            placeholder="Digite o título da série"
                            value="{{ $serie->titulo }}" 
                            required
                        >
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection

