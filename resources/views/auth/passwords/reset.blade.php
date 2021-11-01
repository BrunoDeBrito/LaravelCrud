@extends('layout.default')

@section('login')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5 class="card-title">ProdutosCleans LTDA</h5>
                    <p class="card-text">Cadastre sua nova senha</p>
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/img.png') }}" style="width: 120px" class="rounded" alt="...">
                    </div>

                </div>

            </div>
            <div class="card">

                <div class="card-header text-white bg-primary">{{ __('Esqueci minha senha') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row mt-1">
                            <label for="email"
                                class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <label for="password"
                                class="col-md-3 col-form-label text-md-right">{{ __('Nova Senha') }}</label>

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
                                class="col-md-3 col-form-label text-md-right">{{ __('Repita a senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mt-2 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar senha') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
