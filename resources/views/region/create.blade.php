@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-tablet">
                    <form method="POST" action="{{ route('regions.store') }}">
                        @csrf

                        <div class="field">
                            <label for="name" class="label">{{ __('Name') }}</label>

                            <div class="control">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help is-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="country" class="label">{{ __('Country') }}</label>

                            <div class="control">
                                <country-select v-bind:selected="null" :countries="{{ json_encode($countries) }}" name="country">
                                </country-select>

                                @if ($errors->has('country'))
                                    <span class="help is-danger">
                                        {{ $errors->first('country') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="outerRegions" class="label">{{ __('Outer Regions') }}</label>

                            <div class="control">
                                <region-select v-bind:selected="null" :regions="{{ json_encode($regions) }}" name="outerRegions">
                                </region-select>

                                @if ($errors->has('outerRegions'))
                                    <span class="help is-danger">
                                        {{ $errors->first('outerRegions') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="subregions" class="label">{{ __('Subregions') }}</label>

                            <div class="control">
                                <region-select v-bind:selected="null" :regions="{{ json_encode($regions) }}" name="subregions">
                                </region-select>

                                @if ($errors->has('subregions'))
                                    <span class="help is-danger">
                                        {{ $errors->first('subregions') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
