@extends('layout.default', [ 'mainClass' => "products create-edit"])

@section('content')

    <div class="main-title mt-5">
        <h5>Produtos {{ $product->id ? ' - #' . $product->id : '' }}</h5>
        <p>Crie seu produto</p>
    </div>

    @include('partials._alert')

    <div class="row">
        <form action="{{ url('produtos') }}" method="POST" class="col-12">
            @csrf
            @method($product->id?'PUT':'POST')

            <input type="hidden" name="id" value="{{ $product->id }}" />

            @php

                $productConfigs = [];

                if (old('price') && count(old('price'))) {

                    foreach (old('price') as $k => $price) {

                        array_push($productConfigs, (object) [

                            'price' => $price,
                            'parametersOptions' => old('parameters_options_'.$k.'[]')

                        ]);
                    }

                } else if ($product->productConfigs && count($product->productConfigs)) {

                    foreach ($product->productConfigs as $k => $config) {

                        array_push($productConfigs, (object) [
                            'price' => $config->price,
                            'parametersOptions' => $config->parameterOptions
                        ]);
                    }
                }

            @endphp

            <div class="row">

                <div class="mb-3 col-5">
                    <label for="exampleFormControlInput1" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Camisa, Calça Etc..."
                        value="{{ $product->name }}">
                </div>

            </div>

            <div class="row">

                <div class="mb-3 col-5">
                    <label for="exampleFormControlTextarea1" class="form-label">Descrição do Produto</label>
                    <textarea class="form-control" placeholder="Breve descrição do produto" name="descriptions"
                        id="descriptions" rows="3">{{ $product->descriptions }}</textarea>
                </div>

            </div>

            <div class="row">

                <div class="mb-3 col-5">

                    <label class="form-label">Selecione a Categoria</label>

                    <select name="category_id" class="form-select">

                        <option value="">Selecione uma categoria</option>

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}" {!! $category->id == $product->category_id ? 'selected="selected"' : '' !!}>
                                {{ $category->name }}
                            </option>
                            
                            @endforeach
                            
                        </select>
                        <hr>

                </div>

                <div class="table-responsive">
                    <div class="mb-3 col-5">

                        <div>
                            <h5>Opções</h5>
                            <a class="btn btn-primary btn-sm btn-add-config"><i class="material-icons">add</i></a>
                        </div>
                        <hr>

                    </div>

                    <div class="table-responsive">
                        <th>Paramentros</th>

                        <table class="option-list">
                            <tbody>

                                {{-- <tr>
                                    <td>
                                        <div class="input-group mb-3">

                                            <input type="text" name="price[]" class="form-control" placeholder="Preço $$">
                                            <a class="btn btn-primary btn-sm btn-add-options"><i class="material-icons">add</i></a>
                                            <a class="btn btn-danger btn-sm btn-remove-option">
                                                <i class="material-icons">delete</i></a>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group mb-3">

                                            <input type="text" name="price[]" class="form-control" placeholder="Preço $$">
                                            <a class="btn btn-danger btn-sm btn-remove-option">
                                                <i class="material-icons">delete</i></a>

                                        </div>
                                    </td>
                                </tr> --}}

                                <div class="product-config-list">

                                    @for ($i=0; max(1, count($productConfigs)) > $i; $i++)

                                        @php    
                                            $config = $productConfigs[$i] ?? false;
                                        @endphp

                                        <div class="config-item mb-3 col-4">

                                            <div class="input-group">
                                                <input type="text" name="price[]" value="{{ $config ? $config->price : '' }}" class="form-control" placeholder="Preço $$">
                                                <a class="btn btn-primary btn-sm btn-add-parameter">
                                                    <i class="material-icons">add</i></a>
                                                <a class="btn btn-danger btn-sm btn-remove-config">
                                                    <i class="material-icons">delete</i></a>
                                            </div>


                                            <div class="config-parameters">

                                                @php

                                                    $configParameters = [];

                                                    if ($config && count($config->parametersOptions)) {

                                                        foreach ($config->parametersOptions as $optionId) {

                                                            array_push($configParameters, (object) [
                                                                'id' => $optionId->id ?? $optionId
                                                            ]);
                                                        }
                                                    }

                                                @endphp

                                                @for ($z=0; max(1, count($configParameters)) > $z; $z++)

                                                    @php
                                                        $parameterOption = $configParameters[$z] ?? false;  
                                                    @endphp

                                                    <div class="parameter-item">
                                                        <div class="input-group">

                                                            <select class="form-select" aria-label="Default select example">

                                                                <option name="parameter_option_{{ $i }}[]" selected>Selecione um Item</option>
                                                                @foreach ($paramentersOptions as $paramOpt)
                                                                    
                                                                    <option value="{{ $parameterOption ? $parameterOption->id : '' }}">
                                                                       {{ $paramOpt->name }}
                                                                    </option>

                                                                @endforeach

                                                            </select>

                                                            <a class="btn btn-danger btn-sm btn-remove-parameter">
                                                                <i class="material-icons">delete</i></a>
                                                        </div>
                                                    </div>

                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                {{-- <tr>
                                    <td>

                                        <div class="input-group mb-3">

                                            <select class="form-select btn-add-parameters">
                                                <option selected>Escolha um Paremetros</option>
                                                @foreach ($paramenters as $paramenter)
                                                    <option id="teste" value="{{ $paramenter->id }}">
                                                        {{ $paramenter->name }}</option>
                                                @endforeach
                                            </select>

                                            <select class="form-select btn-add-parametersOptions" >
                                                <option selected>Escolha uma Opções</option>
                                                @foreach ($paramentersOptions as $paramenteroption)
                                                    <option value="{{ $paramenteroption->id }}">
                                                        {{ $paramenteroption->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <input type="text" class="form-control" placeholder="Preço $$">
                                            <a class="btn btn-danger btn-sm"><i class="material-icons">delete</i></a>
                                            
                                        </div>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>

                    </div>

                    <div class="main-controls text-right mt-4">

                        <a class="btn btn-light" href="{{ url('produtos') }}">Voltar</a>
                        <button type="submit" class="btn btn-primary btn-lg">Salvar</button>

                    </div>

        </form>
    </div>
@endsection
