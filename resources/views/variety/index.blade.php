@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            @auth
                <div class="level">
                    <a class="button is-primary" href="{{ route('varieties.create') }}">New</a>
                </div>
            @endauth
            @include('variety._cards', ['varieties' => $varieties])
        </div>
    </div>
@endsection
