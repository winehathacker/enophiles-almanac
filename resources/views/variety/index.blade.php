@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="level">
                <form action="{{ route('varieties.index') }}">
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
                    <a class="button is-primary" href="{{ route('varieties.create') }}">New</a>
                @endauth
            </div>
            @include('variety._cards', ['varieties' => $varieties])
        </div>
    </div>
@endsection
