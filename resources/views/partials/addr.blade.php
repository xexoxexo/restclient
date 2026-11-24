@php
    $v = (string) $value;
    $path = $type === 'tx' ? 'tx' : ($type === 'token' ? 'token' : 'address');
    $label = ['tx' => 'kode transaksi', 'token' => 'alamat token', 'address' => 'alamat'][$type] ?? 'teks';
@endphp
@if ($v === '0x')
    <span class="text-secondary">Koin utama</span>
@elseif (preg_match('/^0x[0-9a-fA-F]{8,}$/', $v))
    <a href="{{ $explorer }}/{{ $path }}/{{ $v }}" target="_blank" rel="noopener" class="mono" title="Buka di penjelajah blockchain: {{ $v }}">{{ \Illuminate\Support\Str::limit($v, 14, '...') }}</a>
    <button type="button" class="copy" data-copy="{{ $v }}" aria-label="Salin {{ $label }}">Salin</button>
@else
    <span class="text-secondary">-</span>
@endif