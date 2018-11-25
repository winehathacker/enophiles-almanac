@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            @auth
                <div class="level">
                    <a class="button is-primary" href="{{ route('regions.create') }}">New</a>
                </div>
            @endauth
            @include('region._cards', ['regions' => $regions])
        </div>
    </div>
@endsection
