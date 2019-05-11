<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>Prihlasovanie hraca </title>


    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

    <link rel="stylesheet" href="{{ asset('css/login_css/style.css') }}" />


</head>
<body>
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">{{ __('message.loginplayer') }}</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <form method="POST" action="{{ route('player.login.submit') }}">
                @csrf
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="email" class="label">Email</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">{{ __('message.password') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> {{ __('message.keepsigned') }}</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="{{ __('message.login') }}">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Zabudol si heslo?') }}
                            </a>
                        @endif
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>



</body>
