@extends('layout')


@section('content')
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-3">
        Adicionar
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif


    <div class="mb-3">
        <h1>Séries Cadastradas</h1>
    </div>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($series as $serie)
            <tr>
                <td>{{ $serie->id }}</td>
                <td> <a href="{{ route('seasons.index', $serie->id ) }}" >{{ $serie->titulo }}</a> </td>
                <td>
                    <div class="d-flex" style="gap: 16px">
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary">Editar</a>

                        <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Nenhuma série cadastrada
                </td>
            </tr>
        @endforelse
    </tbody>
</table>



@endsection
