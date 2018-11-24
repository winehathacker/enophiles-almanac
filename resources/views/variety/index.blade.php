@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            @auth
                <div class="level">
                    <a class="button is-primary" href="{{ route('varieties.create') }}">New</a>
                </div>
            @endauth
            <div class="columns is-multiline">
                @foreach($varieties as $variety)
                    <div class="column is-one-quarter">
                        <div class="card card-clickable">
                            <div class="card-header has-text-centered">
                                <div class="card-header-title is-centered">
                                    {{ $variety->name }}
                                </div>
                            </div>
                            <a class="card-link" href="{{ route('varieties.show', ['variety' => $variety]) }}"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
