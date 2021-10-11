@extends('layout.default')

@section('content')

    <div class="main-title mt-4">
        <h5>Produtos {{ $product->id ? (' - #'.$product->id) : '' }}</h5>
        <p>Crie seu produto</p>
    </div>

	@include('partials._alert')

    <div class="row">
        <form action="{{ url('produtos') }}" method="POST" class="col-12">            
            @csrf            
            @method($product->id?'PUT':'POST')

            <input type="hidden" name="id" value="{{ $product->id }}"/>

            <div class="row">

                <div class="mb-3 col-4">
                    <label for="exampleFormControlInput1" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Computador" value="{{ $product->name }}">
                </div>

                <div class="mb-3 col-4">
                    <label for="exampleFormControlInput1" class="form-label">Preço do Produto</label>
                    <input type="number" class="form-control" name="price" id="price" step="0.01" placeholder="12.99 R$" value="{{ $product->price }}">
                </div>

            </div>

            <div class="row">

                <div class="mb-3 col-8">
                    <label for="exampleFormControlTextarea1" class="form-label">Descrição do Produto</label>
                    <textarea class="form-control" name="descriptions" id="descriptions" rows="3">{{ $product->descriptions }}</textarea>
                </div>

            </div>

            <div class="row">

                <div class="mb-3 col-4">
                    <label class="form-label">Selecione a Categoria</label>

                    <select name="category_id"class="form-select">

                        <option value="">Selecione uma categoria</option>

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}" {!! $category->id == $product->category_id ? 'selected="selected"' : '' !!}>{{ $category->name }}</option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="main-controls text-right mt-4">

                <a class="btn btn-light" href="{{ url('produtos') }}">Voltar</a>
                <button type="submit" class="btn btn-primary btn-lg">Enviar</button>

            </div>
            
        </form>
    </div>
@endsection
