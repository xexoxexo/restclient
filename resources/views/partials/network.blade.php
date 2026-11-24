<select name="network" id="network" class="form-select">
    @foreach (config('bitquery.networks') as $key => $net)
        <option value="{{ $key }}" @selected($key === $network)>{{ $net['name'] }}</option>
    @endforeach
</select>