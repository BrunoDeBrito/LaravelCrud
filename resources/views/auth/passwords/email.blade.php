@extends('layout.default')

@section('login')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">ProdutosCleans LTDA</h5>
                    <p class="card-text">Redefinição de senha</p>
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/img.png') }}" style="width: 120px" class="rounded" alt="...">
                    </div>

                </div>

            </div>


            <div class="card">

                <div class="card-header text-white bg-primary">{{ __('Esqueci minha senha') }}</div>

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">

                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">

                                <input id="email" type="email" placeholder="mail@exemple.com"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">

                                <a href="{{ route('login') }}" class="btn btn-light">
                                    {{ __('Voltar') }}
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar') }}
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
