@extends('layouts.app')

@section('content')
    @if ($file === 'Error file not found')
        <h1 class="text-danger text-center fw-light mt-5 pt-5">Error File Not Found</h1>
    @else
        <!-- Detail berkas -->
        <div class="mt-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Detail Berkas <span class="rounded fw-light text-muted">
                        {{ $file['tiket_id'] }}
                    </span></h1>

                <span class="d-flex align-self-center justify-self-end">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#closeModal">
                        Arsipkan
                    </button>
                    <a class="btn btn-primary ms-2" data-bs-toggle="modal"
                        data-bs-target="#disposisiModal{{ $file['tiket_id'] }}">
                        <i class="fa fa-share"></i>
                    </a>
                </span>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>


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
        <!-- Modal -->
        <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="closeModalLabel" aria-hidden="true">
            <form action="/close" id="closeForm" method="POST">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="closeModalLabel">Arsipkan Dokumen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="tiket_id" value="{{ $file['tiket_id'] }}">
                            <div class="">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- <script>
            $('#closeForm').submit(function(e) {
                e.preventDefault(); // Hindari pengiriman formulir default

                $('#closeModal').modal('hide');

                // Kirim formulir menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '/close', // Ganti dengan URL proses formulir
                    data: $('#closeForm').serialize(), // Serialize data formulir
                    success: function(response) {

                        // Tampilkan pesan sukses menggunakan alert Bootstrap
                        $('.content .container').prepend(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">Form berhasil dikirim!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                        // Bersihkan isi formulir
                        $('#myForm')[0].trigger("reset");
                    },
                    error: function() {
                        // Tampilkan pesan kesalahan jika terjadi error
                        $('.content .container').prepend(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">Terjadi kesalahan. Silakan coba lagi.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                    }
                });
            });
        </script> --}}
    @endif
@endsection
