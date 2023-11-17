@foreach ($history as $h)
    <li>
        <time>{{ \Carbon\Carbon::parse($h['waktu_terima'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y') }}
            <br />
            {{ \Carbon\Carbon::parse($h['waktu_terima'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('H:m') }}</time>
        <span> <strong>{{ $h['nama_pegawai_from'] }}
                {{ $h['nama_pegawai_to'] ? 'to' : '' }}
                {{ $h['nama_pegawai_to'] }}</strong>
            {{ $h['keterangan'] }}</span>
    </li>
@endforeach
