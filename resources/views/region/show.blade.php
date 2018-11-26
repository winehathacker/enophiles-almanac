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

                    <div class="section">
                        <h2 class="subtitle">This region is within</h2>
                        @include('region._cards', ['regions' => $region->outerRegions])
                    </div>

                    <div class="section">
                        <h2 class="subtitle">This region includes the subregions</h2>
                        @include('region._cards', ['regions' => $region->subregions])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
