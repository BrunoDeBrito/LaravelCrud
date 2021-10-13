@extends('layout.default', [ 'mainClass' => "parameters create-edit"])

@section('content')

    <div class="main-title mt-4">
        <h5>Paramentros {{ $parameter->id ? (' - #'.$parameter->id) : '' }}</h5>
        <p>Crie seu Parametros</p>
    </div>

    @include('partials._alert')

    <div class="row">
        <form action="{{ url('/parametros') }}" method="POST" class="col-12">
            @csrf
            @method($parameter->id?'PUT':'POST')

            <input type="hidden" name="id" value=" {{ $parameter->id }} " />

            <div class="row">

                <div class="mb-5 col-4">
                    <label class="form-label">Nome do Parametro</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Tamanho" value="{{ $parameter->name }}">
                </div>

            </div>

            <div>
                <h5>Opções</h5>
                <a class="btn btn-primary btn-sm btn-add"><i class="material-icons">add</i></a>
            </div>

            <hr/>

            <div class="table-responsive">
                <table class="option-list">
                    <thead>
                        <tr>
                            <th>Tipo do Parâmetro</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($parametersOptions) && count($parametersOptions) === 0)

                        <tr>
                            <td>
                                <input type="text" name="option[]" class="form-control" placeholder="Parâmetro...">
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm btn-remove-option"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        
                        @endif
                        @foreach ($parametersOptions as $parameterOption)
                        <tr>
                            <td>
                                <input type="text" name="option[]" value="{{ $parameterOption->name }}" class="form-control" placeholder="Parâmetro...">
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm btn-remove-option"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            
            <div class="main-controls text-right mt-4">

                <a class="btn btn-light" href="{{ url('parametros') }}">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>

            </div>

        </form>
    </div>
@endsection
