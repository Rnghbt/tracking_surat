@extends('layouts.app')

@section('content')
    <!-- cards -->
    <div class="row">
        <!-- card -->
        <div class="col-xl-3 col-lg-6 mb-1">
            <div class="card card-stats mb-4 mb-xl-0 bg-body-tertiary border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">{{ $cards['add'] }}</span>
                            <p class="card-title text-muted mb-0">Berkas ditambahkan</p>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-info">
                                <i class="fas fa-plus fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
        <!-- card -->
        <div class="col-xl-3 col-lg-6 mb-1">
            <div class="card card-stats mb-4 mb-xl-0 bg-body-tertiary border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">{{ $cards['total'] }}</span>
                            <p class="card-title text-muted mb-0">Total Berkas</p>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-warning">
                                <i class="fas fa-file fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
        <!-- card -->
        <div class="col-xl-3 col-lg-6 mb-1">
            <div class="card card-stats mb-4 mb-xl-0 bg-body-tertiary border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">{{ $cards['open'] }}</span>
                            <p class="card-title text-muted mb-0">Berkas Terbuka</p>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-success">
                                <i class="fas fa-folder-open fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
        <!-- card -->
        <div class="col-xl-3 col-lg-6 mb-1">
            <div class="card card-stats mb-4 mb-xl-0 bg-body-tertiary border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">{{ $cards['closed'] }}</span>
                            <p class="card-title text-muted mb-0">Berkas diarsipkan</p>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-danger">
                                <i class="fas fa-folder fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end cards -->

    <!-- daftar berkas -->
    <h3 class="">Daftar Berkas</h3>
    <div class="card px-4 py-3">
        <form action="/" method="get">
            <div class="d-flex my-3 flex-wrap">
                <div class="d-flex flex-fill mb-1">
                    <div class="mx-1 flex-fill">
                        <div class="form">
                            <i class="icon-left fa-solid fa-magnifying-glass act" type="submit"></i>
                            <input type="text" class="form-control lr" id="floatingInput" name="search"
                                placeholder="Search..">
                        </div>
                    </div>
                    <div class="mx-1 flex-fill">
                        <div class="input-group">
                            <select name="status" class="form-select" id="status">
                                @php
                                    $status = request()->input('status', '');
                                @endphp
                                <option disabled {{ $status ? '' : 'selected' }}>Status</option>
                                <option {{ $status == 1 ? 'selected' : '' }} value="1">Open</option>
                                <option {{ $status == 0 ? 'selected' : '' }} value="0">Closed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="mx-1 flex-fill">
                        <input type="submit" class="btn btn-primary" id="searchButton" value="Search">
                    </div>
                </div>
                <a class="text-center pt-1 px-2" data-bs-toggle="collapse" href="#tags-filter" role="button"
                    aria-expanded="false" aria-controls="tags-filter">
                    Tags
                </a>
            </div>
        </form>
        <div class="collapse" id="tags-filter">
            <div class="d-flex align-items-center mb-3">
                <div class="p-1"><span class="fw-bold me-5" style="cursor: text;">Tags</span></div>
                <div class="p-1 flex-fill d-flex overflow-x-auto content-scrollbar">
                    @foreach ($tags as $t)
                        <a style="white-space: nowrap;" class="mx-1 flex-fill w-100 btn bg-light">{{ $t }}</a>
                    @endforeach

                </div>
                <div class="p-1 ms-5 justify-self-end"><a
                        class="fw-bold text-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                        href="#" style="white-space: nowrap;">Reset Filter</a></div>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table" id="daftar-berkas">
                @isset($files)
                    @foreach ($files as $file)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="History"><a
                                    data-bs-toggle="modal" data-bs-target="#historyModal{{ $file['id_surat'] }}"
                                    class="text-muted icon-hover"><i class="fa fa-clock"></i></a>
                            </td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Disposisi"><a
                                    data-bs-toggle="modal" data-bs-target="#disposisiModal{{ $file['tiket_id'] }}"
                                    class="text-muted icon-hover"><i class="fa fa-share"></i></a>
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


                            <td><a href="{{ env('API_ENDPOINT') }}lampiran/{{ $file['tiket_id'] }}/{{ $lampiran_path }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download Attachment"
                                    class="{{ $lampiran_path !== null ? '' : 'link-danger' }}">{{ $lampiran_path !== null ? 'Attachment' : 'Not Found!' }}
                                    <i class="ms-2 fa fa-clipboard"></i></a>
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
        </div>

        {{ $files->links('pagination::bootstrap-5') }}

        <div class="fab-container">
            <div class="fab shadow">
                <div class="fab-content">
                    <i class="fa fa-plus fa-2xl text-light"></i>
                </div>
            </div>
            <div class="sub-button shadow" data-bs-toggle="tooltip" data-bs-placement="left"
                data-bs-title="Ambil Berkas">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#AmbilModal">
                    <i class="fa fa-file-download text-light"></i></button>
            </div>
            <div class="sub-button shadow" data-bs-toggle="tooltip" data-bs-placement="left"
                data-bs-title="Tambah Berkas">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#TambahModal">
                    <i class="fa fa-file-upload text-light"></i></button>
            </div>
        </div>
    </div>

    <!-- end daftar berkas -->
    @include('modal.ambil')
    @include('modal.history')
    @include('modal.tambah')
@endsection
