@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-three-fifths-desktop">
                    @if( session()->get('created') )
                        <div class="section">
                            <div class="notification is-success">
                                {{ __('Created') }} {{ session()->get('created')->name }}
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('varieties.store') }}">
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
                            <label for="alias" class="label">{{ __('Alias') }}</label>

                            <div class="control">
                                <variety-alias-select v-bind:selected="null" :varieties="{{ json_encode($varieties) }}">
                                </variety-alias-select>

                                @if ($errors->has('alias'))
                                    <span class="help is-danger">
                                        {{ $errors->first('alias') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label class="checkbox">
                                <input name="createAnother" type="checkbox" {{ request()->get('createAnother') ? 'checked' : '' }}>
                                {{ __('Create another?') }}
                            </label>
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
