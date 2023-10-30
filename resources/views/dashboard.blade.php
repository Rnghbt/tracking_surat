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
                            <p class="card-title text-muted mb-0">Berkas di tambahkan</p>
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
                            <p class="card-title text-muted mb-0">Berkas dibuka</p>
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
                            <p class="card-title text-muted mb-0">Berkas ditutup</p>
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
    <h3 class="my-3">Daftar Berkas</h3>
    <div class="card my-3 px-4 py-3">
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
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                    <div class="mx-1">
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TambahModal"><i
                                class="fa fa-plus"></i></a>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AmbilModal"><i
                                class="fa fa-file"></i></a>
                    </div>
                </div>
            </div>
        </form>
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

        @isset($files)
            @foreach ($files as $file)
                {{-- card berkas --}}
                <div class="card mb-3">
                    <div class="d-flex flex-row mb-2 card-header pt-4 px-5">
                        <span class="fw-bold me-2"><i class="fa fa-file fa-sm me-2"></i>{{ $file['perihal'] }}</span>
                        <span class="me-2">{{ \Carbon\Carbon::parse($file['tanggal_diterima'])->format('d M Y') }}</span>
                        @if ($file['status'] == 1)
                            <p class="me-2"><span class="badge bg-success">Open</span></p>
                        @else
                            <p class="me-2"><span class="badge bg-danger">Closed</span></p>
                        @endif
                        <span class="text-muted me-2 ms-auto">{{ $file['keterangan'] }}</span>
                    </div>

                    <div class="card-body px-5">

                        <div class="row d-flex">
                            <div class="col-12 col-lg-8 ">
                                <h4>{{ $file['nama_pengirim'] }}</h4>
                                <p class="text-muted">{{ $file['ringkasan_dokumen'] }}</p>
                            </div>
                            <div class="col-12 col-lg-4 card text-center">
                                <span class="display-5 p-3 fw-bold text-muted">{{ $file['tiket_id'] }}</span>
                            </div>
                        </div>

                    </div>


                    <div class="d-flex flex-row-reverse align-items-center card-footer px-5 py-2">
                        <div class="p-1"><a class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#disposisiModal{{ $file['tiket_id'] }}"><i class="fa fa-share"></i></a>
                        </div>
                        <div class="p-1"><a class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#historyModal{{ $file['id_surat'] }}"><i class="fa fa-clock"></i></a>
                        </div>
                        <div class="p-2"><a
                                class="fw-bold text-primary link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                href="/detail/{{ $file['id_surat'] }}">Selengkapnya</a>
                        </div>

                    </div>
                </div>
                @include('modal.disposisi')
            @endforeach
        @endisset

        {{ $files->links('pagination::bootstrap-5') }}
    </div>
    <!-- end daftar berkas -->
    @include('modal.ambil')
    @include('modal.history')
    @include('modal.tambah')
@endsection
