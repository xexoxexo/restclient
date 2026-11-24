@extends('layouts.app')

@section('title', 'Token teratas')
@section('heading', 'Token teratas')
@section('lead', 'Token yang paling banyak diperdagangkan di '.$networkName.' dalam '.$hours.' jam terakhir.')

@section('filters')
    <form method="GET" class="row g-2 mb-3" data-loading>
        <div class="col-auto">
            <label for="network" class="form-label small text-secondary mb-1">Jaringan blockchain</label>
            @include('partials.network')
        </div>
        <div class="col-auto">
            <label for="hours" class="form-label small text-secondary mb-1">Rentang waktu</label>
            <select name="hours" id="hours" class="form-select">
                @foreach ([1 => '1 jam terakhir', 6 => '6 jam terakhir', 24 => '24 jam terakhir'] as $h => $label)
                    <option value="{{ $h }}" @selected($h === $hours)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto d-flex align-items-end"><button class="btn btn-accent">Tampilkan</button></div>
    </form>

    <details class="panel help p-3 mb-3">
        <summary>Apa arti halaman ini?</summary>
        <ul class="small mt-2 mb-0">
            <li><strong>Volume</strong> adalah total nilai (dalam dolar AS) semua penukaran token itu pada rentang waktu yang dipilih.</li>
            <li>Stablecoin dan token besar seperti ETH sering ada di atas karena dipakai sebagai pasangan di banyak penukaran.</li>
            <li>Ini peringkat keramaian saja, bukan penilaian kualitas atau rekomendasi membeli.</li>
            <li><strong>Kontrak</strong> adalah alamat token di blockchain. <em>Koin utama</em> berarti koin bawaan jaringan itu, misalnya ETH.</li>
        </ul>
    </details>
@endsection

@section('content')
    @if (!empty($result['summary']))
        @include('partials.cards', ['cards' => [
            ['label' => 'Token teratas', 'value' => $result['summary']['top'], 'hint' => 'volume terbesar'],
            ['label' => 'Total volume', 'value' => '$'.$result['summary']['volume'], 'hint' => 'jumlah dari token di daftar ini'],
            ['label' => 'Jumlah transaksi', 'value' => $result['summary']['trades'], 'hint' => 'dari token di daftar ini'],
        ]])
    @endif

    @if (!empty($result['chart']['labels']))
        <div class="panel p-3 mb-3">
            <h2 class="h6">Volume per token (USD)</h2>
            <div class="chart-box"><canvas id="chart" role="img" aria-label="Grafik volume per token dalam dolar AS"></canvas></div>
        </div>
        @push('scripts')
            <script>drawChart('chart', 'bar', @json($result['chart']['labels']), @json($result['chart']['values']), 'Volume (USD)');</script>
        @endpush
    @endif

    @if (!empty($result['rows']))
        <input type="search" class="form-control mb-2" placeholder="Cari token di tabel, misalnya ETH atau USDT" aria-label="Cari token di tabel" data-filter="#tabel">
    @endif

    <div class="panel table-responsive">
        <table class="table table-hover align-middle mb-0" id="tabel">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Token</th>
                    <th>Kontrak</th>
                    <th class="text-end">Volume (USD)</th>
                    <th class="text-end">Jumlah transaksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($result['rows'] as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><strong>{{ $r['symbol'] }}</strong> <span class="text-secondary">{{ $r['name'] }}</span></td>
                        <td class="text-nowrap">@include('partials.addr', ['value' => $r['contract'], 'type' => 'token'])</td>
                        <td class="text-end">{{ $r['volume'] }}</td>
                        <td class="text-end">{{ $r['trades'] }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-secondary py-4">Belum ada data untuk ditampilkan. Pilih jaringan dan rentang waktu, lalu klik Tampilkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection