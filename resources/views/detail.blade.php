@extends('layouts.app')

@section('content')
    @if ($file === 'Error file not found')
        <h1 class="text-danger text-center fw-light mt-5 pt-5">Error File Not Found</h1>
    @else
        <!-- Detail berkas -->
        <div class="mt-3 mb-4">
            <div class="d-flex justify-content-between mb-3">
                <h1>Detail Berkas</h1>
                <span class="d-flex align-self-center justify-self-end">
                    <span class="rounded fw-bold text-light px-3 py-2 bg-success">
                        {{ $file['tiket_id'] }}
                    </span>
                    <a class="btn btn-primary ms-2" data-bs-toggle="modal"
                        data-bs-target="#disposisiModal{{ $file['tiket_id'] }}">
                        <i class="fa fa-share"></i>
                    </a>
                </span>
            </div>


            <div class="row mb-3">
                <div class="col col-12 col-md-6">
                    <!-- Dokumen Info Section -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Informasi Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <p>Nama</p>
                                    <p>Agenda</p>
                                    <p>Perihal</p>
                                    <p>Attachment</p>
                                </div>
                                <div class="col">
                                    <p>
                                        <strong class="{{ $file['nama_dokumen'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['nama_dokumen'] ?: 'Data tidak tersedia' }}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong class="{{ $file['agenda'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['agenda'] ?: 'Data tidak tersedia' }}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong class="{{ $file['perihal'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['perihal'] ?: 'Data tidak tersedia' }}
                                        </strong>
                                    </p>

                                    @if ($file_name && $lampiran_path)
                                        <p><strong><a
                                                    href="http://103.100.27.59/~lacaksurat/lampiran/{{ $file['tiket_id'] }}/{{ $lampiran_path }}"
                                                    class="link-dark link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                                    {{ $file_name }}
                                                    <i class="fa fa-download fa-sm ms-2"></i></strong></p>
                                        </a>
                                    @else
                                        <p><strong class="text-warning">Data tidak tersedia</strong></p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col col-12 col-md-6">

                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Informasi Dokumen</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <p>Pengirim</p>
                                    <p>Diterima</p>
                                    <p>Dokumen</p>
                                    <p>Agenda</p>
                                </div>
                                <div class="col">
                                    <p>
                                        <strong class="{{ $file['nama_pengirim'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['nama_pengirim'] ?: 'Data tidak tersedia' }}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong class="{{ $file['tanggal_diterima'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['tanggal_diterima'] ? \Carbon\Carbon::parse($file['tanggal_diterima'])->format('d M Y') : 'Data tidak tersedia' }}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong class="{{ $file['tanggal_dokumen'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['tanggal_dokumen'] ? \Carbon\Carbon::parse($file['tanggal_dokumen'])->format('d M Y') : 'Data tidak tersedia' }}
                                        </strong>
                                    </p>
                                    <p>
                                        <strong class="{{ $file['tanggal_agenda'] ? 'text-dark' : 'text-warning' }}">
                                            {{ $file['tanggal_agenda'] ? \Carbon\Carbon::parse($file['tanggal_agenda'])->format('d M Y') : 'Data tidak tersedia' }}
                                        </strong>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Uraian Dokumen</h5>
                </div>
                <div class="card-body">
                    <p class="{{ $file['ringkasan_dokumen'] ? 'text-dark' : 'text-warning' }}">
                        {{ $file['ringkasan_dokumen'] ?: 'Data tidak tersedia' }}
                    </p>
                </div>
            </div>
        </div>

        @include('modal.disposisi')

        {{-- <form action="/disposisi" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-5">
                <div class="col-6 mx-auto">
                    <h4>Disposisi</h4>
                    <input type="hidden" name="tiket_id" value="{{ $file['tiket_id'] }}">
                    <select class="form-select mb-2" aria-label="Default select example" name="penerima">
                        <option selected>Pilih Disposisi</option>
                        @foreach ($disposisi as $d)
                            <option value="{{ $d['id_pegawai'] }}">{{ $d['nama'] }}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="keterangan"
                            style="height: 130px"></textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>
                    <div class="text-end">
                        <input type="submit" value="Kirim" class="btn btn-primary px-4">
                    </div>
                </div>
            </div>
        </form> --}}
    @endif
@endsection
