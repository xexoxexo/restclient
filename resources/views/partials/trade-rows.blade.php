@forelse ($rows as $r)
    <tr>
        <td class="text-nowrap"><time datetime="{{ $r['iso'] }}" data-local="datetime">{{ $r['time'] }} UTC</time></td>
        <td>{{ $r['dex'] }}</td>
        <td>{{ $r['buy'] }}</td>
        <td>{{ $r['sell'] }}</td>
        <td class="text-end">{{ $r['usd'] }}</td>
        <td class="text-nowrap">@include('partials.addr', ['value' => $r['tx'], 'type' => 'tx'])</td>
    </tr>
@empty
    <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data untuk ditampilkan. Pilih jaringan lalu klik Tampilkan.</td></tr>
@endforelse