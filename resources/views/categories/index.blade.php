@extends('layout.default')

@section('content')

    <div class="main-title mt-4">
        <h5>Categorias</h5>
        <p>Gerencie as categorias cadastradas</p>
    </div>

    @include('partials._alert')    

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome das Categorias</th>
                    <th scope="col">Criação</th>
                    <th scope="col">Alteração</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td> {{ $category->id }} </td>
                        <td> {{ $category->name }} </td>
                        <td> {{ $category->created_at->format('d/m/Y H:i:s') }} </td>
                        <td> {{ $category->updated_at->format('d/m/Y H:i:s') }} </td>
                        <td>
                            <a class="btn btn-success" href="{{ url('categorias/'.$category->id.'/editar') }}"><i class="material-icons">edit</i></a>
                            <button type="button" class="btn btn-danger btn-remove" data-id="{{ $category->id }}"><i class="material-icons">delete</i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="main-controls text-right mt-2">
        <a class="btn btn-primary" href="{{ url('categorias/criar') }}">Nova Categoria</a>
    </div>

@endsection
