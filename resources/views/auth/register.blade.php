@extends('layout.default')

@section('login')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">ProdutosCleans LTDA</h5>
                    <p class="card-text">Crie seu acesso, e veja nossas lojas</p>
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/img.png') }}" style="width: 120px" class="rounded" alt="...">
                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header text-white bg-primary ">{{ __('Registrar') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mt-1">

                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text" placeholder="Seu Nome"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mt-1">

                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">

                                <input id="email" type="email" placeholder="mail@exemple.com"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mt-1">

                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mt-1">

                            <label for="password-confirm"
                                class="col-md-3 col-form-label text-md-right">{{ __('Confirme sua senha') }}</label>

                            <div class="col-md-6">

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">

                                <a href="{{ route('login') }}" class="btn btn-light">
                                    {{ __('Voltar') }}
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
