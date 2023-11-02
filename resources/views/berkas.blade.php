<table class="table" id="daftar-berkas">
    @isset($files)
        @foreach ($files as $file)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="History"><a data-bs-toggle="modal"
                        data-bs-target="#historyModal{{ $file['id_surat'] }}" class="text-muted icon-hover"><i
                            class="fa fa-clock"></i></a>
                </td>
                <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Disposisi"><a data-bs-toggle="modal"
                        data-bs-target="#disposisiModal{{ $file['tiket_id'] }}" class="text-muted icon-hover"><i
                            class="fa fa-share"></i></a>
                </td>
                <td class="text-muted">{{ $file['tiket_id'] }}</td>
                <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lihat Detail"
                        href="/detail/{{ $file['id_surat'] }}"
                        class="link-dark link-underline link-underline-opacity-0 fw-semibold link-underline-opacity-75-hover">{{ $file['nama_pengirim'] }}
                </td></a>
                <td class="text-muted
                        text-truncate">
                    <span>{{ $file['ringkasan_dokumen'] }}</span>
                </td>

                @php
                    $lampiran_path = null;
                    $file_name = null;

                    if (isset($file)) {
                        if (isset(json_decode($file['lampiran'], true)['path'])) {
                            $lampiran_path = json_decode($file['lampiran'], true)['path'];
                        }
                        $file_name = basename($lampiran_path);
                    } else {
                        $file = 'Error file not found';
                    }
                @endphp


                <td>
                    @if ($lampiran_path !== null)
                        <a href="{{ env('API_ENDPOINT') }}lampiran/{{ $file['tiket_id'] }}/{{ $lampiran_path }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Attachment">Attachment
                            <i class="ms-2 fa fa-clipboard"></i></a>
                    @else
                        <span class="text-danger">Not Found!
                            <i class="ms-2 fa fa-clipboard"></i></span>
                    @endif
                </td>
                <td class=" text-{{ $file['status'] === '1' ? 'success' : 'danger' }} fw-bold">
                    {{ $file['status'] === '1' ? 'Open' : 'Closed' }}</td>
                <td class="text-muted text-end">
                    <small>
                        {{ \Carbon\Carbon::parse($file['tanggal_diterima'])->format('d M') }}
                    </small>
                </td>
            </tr>
            @include('modal.disposisi')
        @endforeach
    @endisset
</table>
{{ $files->links('pagination::bootstrap-5') }}
@include('modal.history')
