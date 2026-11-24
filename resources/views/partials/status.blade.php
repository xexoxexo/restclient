@if (!empty($result['stale']))
    <div class="alert alert-warning" role="status">
        Menampilkan data terakhir yang tersimpan, karena data terbaru belum bisa diambil. Angkanya mungkin sudah tidak terbaru.
    </div>
@endif

@if (!empty($result['fetched_at']))
    @php($fetched = \Illuminate\Support\Carbon::createFromTimestamp($result['fetched_at']))
    <p class="text-secondary small mb-3">
        Data diambil pukul
        <time datetime="{{ $fetched->toIso8601String() }}" data-local="time">{{ $fetched->utc()->format('H:i:s') }} UTC</time>.
        Pengunjung berbagi data yang sama, jadi data diperbarui paling cepat tiap {{ max(1, (int) round(config('bitquery.cache_ttl') / 60)) }} menit.
    </p>
@endif