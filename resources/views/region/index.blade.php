@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="level">
                <form action="{{ route('regions.index') }}">
                    <div class="field has-addons">
                        <div class="control">
                            <input name="search" class="input" type="text" placeholder="Search" value="{{ request()->get('search') ?: null }}">
                        </div>
                        <div class="control">
                            <button type="submit" class="button is-info">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                @auth
                    <a class="button is-primary" href="{{ route('regions.create') }}">New</a>
                @endauth
            </div>
            @if (!request()->get('search'))
                <h2 class="subtitle">Wine Producing Countries</h2>
            @endif
            @include('region._cards', ['regions' => $regions])
        </div>
    </div>
@endsection
