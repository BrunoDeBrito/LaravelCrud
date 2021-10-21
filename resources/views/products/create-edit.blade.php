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
                
                //NOTE pegar do input as informações do preço caso perca, ou q venha da atualização
                if (old('price') && count(old('price'))) {
                    foreach (old('price') as $k => $price) {
                        array_push(
                            $productConfigs,
                            (object) [
                                'price' => $price,
                                'parametersOptions' => old('parameters_options_' . $k),
                            ],
                        );
                    }
                } elseif ($product->productConfigs && count($product->productConfigs)) {

                    foreach ($product->productConfigs as $k => $config) {
                        
                        array_push(
                            $productConfigs,
                            (object) [
                                'price' => $config->price,
                                'parametersOptions' => $config->parametersOptions,
                            ],
                        );
                    }
                }
                
            @endphp

            <div class="row">

                <div class="mb-3 col-5">
                    <label for="exampleFormControlInput1" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Camisa, Calça Etc..."
                        value="{{ old('name', $product->name) }}">
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
                        <div class="product-config-list">

                            {{-- NOTE Contador para buscar qnts Preços terão --}}
                            @for ($i = 0; max(1, count($productConfigs)) > $i; $i++)

                                @php
                                    $config = $productConfigs[$i] ?? false;
                                @endphp

                                {{-- REVIEW Coluna --}}
                                <div class="config-item mb-3 col-4" data-pos="{{ $i }}"> {{--FIXME COLUNA  --}}

                                    <div class="input-group">
                                        <input type="text" name="price[]" value="50"
                                            class="form-control" placeholder="Preço $$">
                                        <a class="btn btn-outline-success btn-sm btn-add-opt">
                                            <i class="material-icons">add</i></a>
                                        <a class="btn btn-danger btn-sm btn-remove-config">
                                            <i class="material-icons">delete</i></a>
                                    </div>

                                    <div class="config-parameters">

                                        @php
                                            
                                            $configParameters = [];
                                            
                                            //NOTE  Pega as Opções do parametro ->
                                            //comparação com o produto, e retorna as opçoões
                                            if ($config && $config->parametersOptions) {
                                                // dd($config);
                                            
                                                foreach ($config->parametersOptions as $optionId) {
                                                    array_push(
                                                        $configParameters,
                                                        (object) [
                                                            'id' => $optionId->id ?? $optionId,
                                                        ],
                                                    );
                                                }
                                            }
                                            
                                        @endphp
                                        {{-- NOTE Contador qnts config dos param terão para cada preço --}}
                                        @for ($z = 0; max(1, count($configParameters)) > $z; $z++)

                                            @php
                                                $parameterOption = $configParameters[$z] ?? false;
                                            @endphp

                                            {{-- REVIEW Linha das optons --}}
                                            <div class="parameter-item">{{--FIXME LINHAS--}}
                                                <div class="input-group">

                                                    {{-- @dd($parameterOption->id); --}}
                                                    <select name="parameters_options_{{ $i }}[]"
                                                        class="form-select">

                                                        <option value="">Selecione uma Opção</option>

                                                        @foreach ($paramentersOptions as $k => $paramOpt)

                                                            <option {!! $k == 0 ? 'selected="selected"': '' !!} value="{{ $paramOpt->id }}" {!! $parameterOption && $parameterOption->id == $paramOpt->id ? 'selected="selected"' : '' !!}>
                                                                {{ $paramOpt->name }}
                                                            </option>

                                                        @endforeach

                                                    </select>

                                                    <a class="btn btn-outline-warning btn-sm btn-remove-parameter">
                                                        <i class="material-icons">delete</i></a>
                                                </div>
                                            </div>

                                        @endfor
                                    </div>
                                    
                                </div>

                            @endfor
                        </div>

                    </div>

                    <div class="main-controls text-right mt-3">

                        <a class="btn btn-light" href="{{ url('produtos') }}">Voltar</a>
                        <button type="submit" class="btn btn-primary btn-lg">Salvar</button>

                    </div>

        </form>
    </div>

@endsection
