<div class="columns is-multiline">
    @foreach($regions as $region)
        <div class="column is-one-quarter">
            <div class="card card-clickable">
                <div class="card-header has-text-centered">
                    <div class="card-header-title is-centered">
                        {{ $region->name }}
                    </div>
                </div>
                <a class="card-link" href="{{ route('regions.show', ['region' => $region]) }}"></a>
            </div>
        </div>
    @endforeach
</div>
