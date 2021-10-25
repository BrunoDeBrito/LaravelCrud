@extends('layout.default')

@section('content')

    <div class="main-title mt-4">
        <h5>Categorias {{ $category->id ? (' - #'.$category->id) : '' }}</h5>
        <p>Gerencie as categorias cadastradas</p>
    </div>

    @include('partials._alert')

    <form action="{{ url('/categorias') }}" method="POST">
        
        @csrf
        @method($category->id?'PUT':'POST')

        <input type="hidden" name="id" value="{{ $category->id }}"/>

        <div class="row">
            <div class="col-4">
                <label for="exampleFormControlInput1" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Tipo de Categoria" value="{{ old('name', $category->name) }}">
            </div>
        </div>

		<div class="main-controls text-right mt-4">
			<a class="btn btn-light" href="{{ url('categorias') }}">Voltar</a>
        	<button type="submit" class="btn btn-primary">{{ $category->id?'Cadastrar':'Alterar' }}</button>
		</div>

    </form>

@endsection
