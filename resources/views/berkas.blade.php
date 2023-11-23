<div class="table-responsive mb-3">
    <table class="table" id="daftar-berkas">
        @isset($files)
            @foreach ($files as $file)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="History"><a
                            id="history{{ $file['tiket_id'] }}" data-bs-toggle="modal"
                            data-bs-target="#historyModal{{ $file['tiket_id'] }}" class="text-muted icon-hover"><i
                                class="fa fa-clock"></i></a> </td>
                    <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Disposisi">
                        <a data-bs-toggle="modal" data-bs-target="#disposisiModal{{ $file['tiket_id'] }}"
                            class="text-muted icon-hover"><i class="fa fa-share"></i></a>
                    </td>
                    <td class="text-muted">{{ $file['tiket_id'] }}</td>
                    <td><a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lihat Detail"
                            href="/detail/{{ $file['id_surat'] }}"
                            class="link-dark link-underline link-underline-opacity-0 fw-semibold link-underline-opacity-75-hover">
                            <span class="">{{ $file['nama_pengirim'] }}</span>
                    </td></a>
                    <td class="text-muted">
                        <span class="">{{ $file['ringkasan_dokumen'] }}</span>
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
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Attachment">
                                <i class="ms-2 fa fa-clipboard"></i></a>
                        @else
                            <span class="text-danger">
                                <i class="ms-2 fa fa-clipboard"></i></span>
                        @endif
                    </td>
                    <td class=" text-{{ $file['status'] === '1' ? 'success' : 'danger' }} fw-bold">
                        <i class="fa fa-{{ $file['status'] === '1' ? 'folder-open' : 'file-zipper' }}"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="{{ $file['status'] === '1' ? 'Status Open' : 'Status Closed' }}"></i>
                    </td>
                    <td class="text-muted text-end">
                        <small>
                            {{ \Carbon\Carbon::parse($file['tanggal_diterima'])->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d M') }}
                        </small>
                    </td>
                </tr>
                @include('modal.disposisi')
                <!-- Modal -->
                <div class="modal modal-lg fade" id="historyModal{{ $file['tiket_id'] }}" tabindex="-1"
                    aria-labelledby="historyModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="historyModalLabel">Histori {{ $file['nama_dokumen'] }}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="events {{ $file['tiket_id'] }}">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('#history{{ $file['tiket_id'] }}').on('click', function(e) {
                        e.preventDefault();

                        if (!$('#history{{ $file['tiket_id'] }}').hasClass('loaded')) {
                            $.get('history?tiket_id=' + '{{ $file['tiket_id'] }}', function(res) {
                                $('ul.events.{{ $file['tiket_id'] }}').html(res);
                                $('#historyModal{{ $file['tiket_id'] }}').modal('show');
                            })
                            $('#history{{ $file['tiket_id'] }}').addClass('loaded');
                        } else {
                            $('#historyModal{{ $file['tiket_id'] }}').modal('show');
                        }



                    })
                </script>
            @endforeach
        @endisset
    </table>
</div>
{{ $files->links('pagination::bootstrap-5') }}
