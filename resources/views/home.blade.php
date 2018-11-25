@extends('layouts.app')

@section('content')
<div class="hero is-fullheight-with-navbar is-black">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered is-vcentered">
                <div class="column is-two-thirds-tablet">
                    <h1 class="title">
                        Vinopedia
                    </h1>
                    <h2 class="subtitle">
                        An almanac for viticultural knowledge maintained by wine professionals
                    </h2>
                    <div class="buttons is-centered">
                        <a href="{{ route('varieties.index') }}" class="button is-black is-inverted is-outlined subtitle">Varieties</a>
                        <a href="{{ route('regions.index') }}" class="button is-black is-inverted is-outlined subtitle">Regions</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
