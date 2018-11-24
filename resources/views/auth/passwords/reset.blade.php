@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-tablet">
                    <h1 class="title">{{ __('Reset Password') }}</h1>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="field">
                            <label for="email" class="input">{{ __('e-mail address') }}</label>

                            <div class="control">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help is-danger" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="password" class="input">{{ __('password') }}</label>

                            <div class="control">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help is-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="password-confirm" class="input">{{ __('confirm password') }}</label>

                            <div class="control">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="field is-grouped is-grouped-centered">
                            <div class="field">
                                <button type="submit" class="button is-primary">
                                    {{ __('reset password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
