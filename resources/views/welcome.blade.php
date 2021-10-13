@extends('layout.default')

@section('content')

    <div class="main-title mt-4">
        <h5>Seja bem-vindo!</h5>
        <p>Utilize o menu acima para acessar.</p>
    </div>

    <div class="btn-group" role="group" aria-label="Basic outlined example">

        <div class="main-controls text-right mt-2">
            <a class="btn btn-outline-primary" href="{{ url('produto/criar') }}">Crie Novo Produtos</a>
        </div>

        <div class="main-controls text-right mt-2">
            <a class="btn btn-outline-primary" href="{{ url('categorias/criar') }}">Crie Nova Categoria</a>
        </div>

        <div class="main-controls text-right mt-2">
            <a class="btn btn-outline-primary" href="{{ url('parametros/criar') }}">Crie Novo Parâmetro</a>
        </div>
        
    </div>

@endsection
