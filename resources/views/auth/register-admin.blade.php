@extends('layouts.pages')

@section('title')
    Register
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
                    <img src="{{ asset("img/register.png") }}" alt="Register Illustration">
                </div>
                <div class="paper-right">
                    <h3 style="border-bottom: 1px solid #ddd; padding: 8px 0">Register</h3>

                    <form action="/register/admin" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="profile-image" class="col-md-12 col-form-label">{{ __('Profile Image') }}</label>

                            <div class="col-md-12">
                                <label for="profile-image-input" id="profile-image" class="add-image-box">
                                    <i class="fa fa-plus"></i>

                                    <img id="image" style="display: none; height: 150px; width: 150px;">
                                </label>
                                <input type="file" accept="image/*" name="profile_image" id="profile-image-input" style="display: none">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-12 col-form-label">{{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-12 col-form-label">{{ __('Phone Number') }}</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn essence-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mt-30">
                            <div class="col-md-12 text-center">
                                <span>Already have an account?&nbsp;</span>
                                <a class="btn essence-btn-link" href="/login/admin" style="padding: 0">
                                        {{ __('Login') }}
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

@section('script')
    <script>
        $('#profile-image-input').change(function(e){
            const files = e.target.files;

            if(files.length > 0){
                $("#profile-image").css({
                    "background-color": "white"
                });

                $("#profile-image .fa").eq(0).css({
                    "display": "none"
                });

                $("#image").attr("src", window.URL.createObjectURL(files[0]));

                $("#image").css({
                    "display": "block"
                });
            } else {
                $("#profile-image").css({
                    "background-color": "gainsboro"
                });

                $("#profile-image .fa").eq(0).css({
                    "display": "block"
                });

                $("#image").css({
                    "display": "none"
                });
            }
        });

        $("#phone").keydown(function(e){
            let key = e.keyCode;

            if((key < 48 || key > 57) && (key < 96 || key > 105) && (key < 37 || key > 40) && (key !== 8 && key !== 13 && key !== 9 && key !== 116)){
                e.preventDefault();
            }
        });
    </script>
@endsection
