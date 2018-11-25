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
                    @include('variety._cards', ['varieties' => $variety->aliases])
                </div>
            </div>
        </div>
    </div>
@endsection
