@extends('layouts.pages')

@section('title')
    Login
@endsection

@section('css')
    <style>
        .paper {
            width: 100%;
            box-shadow: 0px 11px 15px -7px rgba(0,0,0,0.2), 0px 24px 38px 3px rgba(0,0,0,0.14), 0px 9px 46px 8px rgba(0,0,0,0.12);
            display: flex;
        }

        .paper-left {
            display: none;
        }

        .paper-right {
            flex-grow: 1;
            height: auto;
            display: block;
            border-left: 1px solid #ddd;
            padding: 16px 32px;
            width: 50%;
        }
        
        @media (min-width: 991px){
            .paper-left {
                display: flex;
                flex-grow: 1;
                height: auto;
                padding: 16px;
                width: 50%;
                align-items: center;
            }

            .paper-left img {
                width: 512px;
                height: 512px;
            }
        }
    </style>
@endsection

@section('content')
<div class="container" style="margin: 172px auto 80px auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="paper">
                <div class="paper-left">
                    <img src="{{ asset("img/login.png") }}" alt="Login Illustration">
                </div>
                <div class="paper-right">
                    <h3 style="border-bottom: 1px solid #ddd; padding: 8px 0">Login</h3>

                    <form action="/login" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn essence-btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn essence-btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mt-30">
                            <div class="col-md-12 text-center">
                                <span>Don't have an account?&nbsp;</span>
                                <a class="btn essence-btn-link" href="/register" style="padding: 0">
                                        {{ __('Register') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
