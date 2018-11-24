@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="column is-three-fifths-desktop">
            <div class="message is-success">
                <div class="message-header">
                    <h1 class="title">{{ __('Verify Your Email Address') }}</h1>
                </div>
            </div>
            <div class="message-body">
                @if (session('resent'))
                    {{ __('A fresh verification link has been sent to your email address.') }}
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
            </div>
        </div>
    </div>
</div>
@endsection
