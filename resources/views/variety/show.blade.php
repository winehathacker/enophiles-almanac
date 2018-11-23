@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @auth
                        <a href="{{ route('varieties.edit', [$variety]) }}" class="btn btn-primary">Edit</a>
                    @endauth
                    <div class="card-header">{{ $variety->name }}</div>
                    <div class="card-body">
                        <h2>Aliases</h2>
                        <ul>
                            @foreach( $variety->aliases as $alias)
                                <li>{{ $alias->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
