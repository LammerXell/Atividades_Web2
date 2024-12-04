@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Autores</h1>

    <a href="{{ route('authors.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus"></i> Adicionar Autor
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authors as $authors)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $authors->name }}</td>
                    <td>
                        <!-- Botão de Visualizar -->
                        <a href="{{ route('authors.show', $authors) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>

                        <!-- Botão de Editar -->
                        <a href="{{ route('authors.edit', $authors) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                        <!-- Botão de Excluir -->
                        <form action="{{ route('authors.destroy', $authors) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta categoria?')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhuma categoria encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

