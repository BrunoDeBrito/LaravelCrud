@extends('layout.default')

@section('content')

    <div class="main-title mt-4">
        <h5>Produtos</h5>
        <p>Gerencie os Produtos cadastrados</p>
    </div>

    @include('partials._alert')

    <form class="form-filters mb-4">
        <input type="text" name="search" class="form-control" value="{{ Request::get('search') }}" placeholder="Pesquise por algo..."/>
    </form>

    <div class="table-responsive">

        <h3 class="center"> Lista de produtos </h3>
        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Nome do Produto </th>
                    <th scope="col">Valor </th>
                    <th scope="col">Descrição </th>
                    <th scope="col">Ações </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($products as $product)
                
                    <tr>
                        <td> {{ $product->id }} </td>
                        <td> {{ $product->category_name }} </td>
                        <td> {{ $product->name }} </td>
                        <td> {{ $product->price }}R$ </td>
                        <td> {{ $product->descriptions }} </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ url('produtos/'.$product->id.'/editar') }}"><i class="material-icons">edit</i></a>
                            <button type="button" class="btn btn-danger btn-sm btn-remove" data-id="{{ $product->id }}"><i class="material-icons">delete</i></button>
                        </td>
                    </tr>

                @endforeach
                
            </tbody>
            
        </table>
        
    </div>

	<div class="main-controls text-right mt-2">
        <a class="btn btn-primary" href="{{ url('produto/criar') }}">Novo Produtos</a>
    </div>

@endsection
