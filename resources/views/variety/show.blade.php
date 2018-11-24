@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-desktop">
                    @auth
                        <div class="level">
                            <a href="{{ route('varieties.edit', [$variety]) }}" class="button is-primary">Edit</a>
                        </div>
                    @endauth
                    <h1 class="title has-text-centered">
                        {{ $variety->name }}
                    </h1>
                    <h2 class="title">Aliases</h2>
                    <ul>
                        @foreach( $variety->aliases as $alias)
                            <li>{{ $alias->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
