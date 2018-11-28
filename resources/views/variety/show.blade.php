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

                    <div class="section">
                        <h2 class="subtitle">This variety is cloned from</h2>
                        @include('variety._cards', ['varieties' => $variety->cloneSource ? [$variety->cloneSource] : []])
                    </div>

                    <div class="section">
                        <h2 class="subtitle">This variety was cloned to create</h2>
                        @include('variety._cards', ['varieties' => $variety->clones])
                    </div>

                    <div class="section">
                        <h2 class="subtitle">This variety is also commonly known as</h2>
                        @include('variety._cards', ['varieties' => $variety->aliases])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
