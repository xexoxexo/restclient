<div class="row g-3 mb-3">
    @foreach ($cards as $card)
        <div class="col-12 col-md-4">
            <div class="panel p-3 h-100">
                <div class="text-secondary small">{{ $card['label'] }}</div>
                <div class="stat-value">{{ $card['value'] }}</div>
                <div class="text-secondary small">{{ $card['hint'] }}</div>
            </div>
        </div>
    @endforeach
</div>