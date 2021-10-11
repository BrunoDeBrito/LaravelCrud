@extends('layout.default')

@section('content')

<div class="main-title mt-4">
    <h5>Paramentros</h5>
    <p>Gerencie os Parametros cadastrados</p>
</div>

@include('partials._alert')

<form class="form-filters mb-4">
    <input type="text" name="search" class="form-control" value="{{ Request::get('search') }}" placeholder="Pesquise por algo..."/>
</form>

<div class="table-responsive">

    <h3 class="center">Lista de Paramentros</h3>
    <table class="table table-striped">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Detalhes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($parameters as $parameter)

            <tr>                    
                <td>{{ $parameter->id }}</td>
                <td>{{ $parameter->name }}</td>
                <td>P | M | G</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ url('parametros/'.$parameter->id.'/editar') }}" ><i class="material-icons">edit</i></a>
                    <button type="button" class="btn btn-danger btn-sm btn-remove" data-id="{{ $parameter->id }}"><i class="material-icons">delete</i></button>
                </td>                
            </tr>

            @endforeach

        </tbody>

    </table>

</div>

<div class="main-controls text-right mt-2">
    <a class="btn btn-primary" href="{{ url('parametros/criar') }}">Novo Parametro</a>
</div>

@endsection
