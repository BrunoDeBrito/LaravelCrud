@extends('layout.default', [ 'mainClass' => "parameters create-edit" ])

@section('content')

    <div class="main-title mt-4">
        <h5>Paramentros {{ $parameter->id ? ' - #' . $parameter->id : '' }}</h5>
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
                    <input type="text" class="form-control" name="name" id="name" placeholder="Tamanho"
                        value="{{ old('name', $parameter->name) }}">
                </div>

            </div>

            <div class="mb-3 col-8">

                <div>
                    <h5>Opções</h5>
                    <a class="btn btn-primary btn-sm btn-add"><i class="material-icons">add</i></a>
                </div>
                <hr />

            </div>


            <div class="table-responsive">
                <table class="option-list">
                    <thead>
                        <tr>
                            <th>Tipo do Parâmetro</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                            
                            $options = [];
                            
                            if (old('option_name')) {
                                $optionIds = old('option_id');
                            
                                //faz um loop pra pegar palavras antigas e/ou novas e salvar
                                foreach (old('option_name') as $k => $on) {
                                    array_push(
                                        $options,
                                        (object) [
                                            'id' => $optionIds[$k] ?? null,
                                            'name' => $on,
                                        ],
                                    );
                                }
                            } elseif ($parameter->options) {
                                $options = $parameter->options;
                            }
                            
                        @endphp

                        @if (count($options) == 0)

                            <tr>
                                <td>
                                    <input type="hidden" name="option_id[]" />
                                    <input type="text" name="option_name[]" class="form-control"
                                        placeholder="Parâmetro..." />
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-remove-option"><i
                                            class="material-icons">delete</i></a>
                                </td>
                            </tr>

                        @else
                            @foreach ($options as $option)
                                <tr>
                                    <td>
                                        <input type="hidden" name="option_id[]" value="{{ $option->id }}" />
                                        <input type="text" name="option_name[]" value="{{ $option->name }}"
                                            class="form-control" placeholder="Parâmetro...">
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm btn-remove-option"><i
                                                class="material-icons">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
