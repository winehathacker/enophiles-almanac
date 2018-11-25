@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-desktop">
                    @auth
                        <div class="level">
                            <a href="{{ route('regions.edit', [$region]) }}" class="button is-primary">Edit</a>
                        </div>
                    @endauth
                    <h1 class="title has-text-centered">
                        {{ $region->name }}@if( $region->country ), {{ $region->country->name }}@endif
                    </h1>
                    <h2 class="title">Outer Regions</h2>
                    <ul>
                        @foreach( $region->outerRegions as $outerRegion)
                            <li>{{ $outerRegion->name }}</li>
                        @endforeach
                    </ul>
                    <h2 class="title">Subregions</h2>
                    <ul>
                        @foreach( $region->subregions as $subregion)
                            <li>{{ $subregion->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
