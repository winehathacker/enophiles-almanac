@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Varieties</div>
                    <div class="card-body">
                        @auth
                            <a href="{{ route('varieties.create') }}" class="btn btn-primary">New</a>
                        @endauth
                        <div class="card-columns">
                            @foreach($varieties as $variety)
                                <div class="card">
                                    <div class="card-header">{{ $variety->name }}</div>
                                </div>
                            @endforeach
                        </div>
                        {{ $varieties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
