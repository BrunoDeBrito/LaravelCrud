@extends('layout.default')

@section('login')

    <div class="row justify-content-center">

        <div class="col-md-8 mt-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">ProdutosCleans LTDA</h5>
                    <p class="card-text">Acesse sua conta para mais detalhes</p>
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/img.png') }}" style="width: 120px" class="rounded" alt="...">
                    </div>

                </div>

            </div>

            <div class="card">
                <div class="card-header text-white bg-primary">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mt-2">

                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-8 offset-md-4">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Esqueci minha senha') }}
                                    </a>

                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-2 mb-3">

                <a class="btn btn-outline-primary" href="{{ route('register') }}">
                    {{ __('Criar Conta') }}
                </a>

            </div>

        </div>

    @endsection
