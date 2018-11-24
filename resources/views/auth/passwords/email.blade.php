@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-tablet">
                        <h1 class="title">{{ __('Reset Password') }}</h1>

                            @if (session('status'))
                                <div class="notification is-success">
                                    <button class="delete"></button>
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="field">
                                    <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                                    <div class="control">
                                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <p class="help is-danger" role="alert">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="field is-grouped is-grouped-centered">
                                        <button type="submit" class="button is-primary">
                                            {{ __('Send Password Reset Link') }}
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
