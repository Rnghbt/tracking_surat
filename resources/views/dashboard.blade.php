@extends('layouts.app')

@section('content')
    <!-- cards -->
    <div class="row">
        <!-- card -->
        <div class="col-xl-4 col-lg-6 mb-1">
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
        <div class="col-xl-4 col-lg-6 mb-1">
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
        <div class="col-xl-4 col-lg-6 mb-1">
            <div class="card card-stats mb-4 mb-xl-0 bg-body-tertiary border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0">{{ $cards['closed'] }}</span>
                            <p class="card-title text-muted mb-0">Berkas diarsipkan</p>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-danger">
                                <i class="fas fa-file-zipper fa-2xl"></i>
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
                            <input type="text" class="form-control lr" id="floatingInput" name="keyword"
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
        <div class="text-center">
            <div class="spinner-border" id="loader" role="status" style="display: none">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="berkas-container">
            @include('berkas')
        </div>

    </div>

    <div class="fab-container">
        <div class="fab shadow">
            <div class="fab-content">
                <i class="fa fa-plus fa-2xl text-light"></i>
            </div>
        </div>
        <div class="sub-button shadow" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ambil Berkas">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#AmbilModal">
                <i class="fa fa-file-download text-light"></i></button>
        </div>
        <div class="sub-button shadow" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Tambah Berkas">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#TambahModal">
                <i class="fa fa-file-upload text-light"></i></button>
        </div>
    </div>



    {{-- end daftar berkas --}}

    <script>
        // search

        $(document).ready(function() {
            // hilangkan tombol cari
            $('#searchButton').hide();

            // event ketika keyword ditulis
            $('#floatingInput').on('keyup', function(e) {
                e.preventDefault();

                $('#loader').show();

                $.get('search?keyword=' + $('#floatingInput').val(), function(res) {

                    $('.berkas-container').html(res);
                    $('#loader').hide();


                });

            });

            $('#status').on('change', function() {
                // Mendapatkan nilai yang dipilih
                var nilaiTerpilih = $(this).val();
                $('#loader').show();

                // Memeriksa apakah nilai yang dipilih adalah 1
                $.get('search?status=' + nilaiTerpilih, function(res) {

                    $('.berkas-container').html(res);
                    $('#loader').hide();

                });
            });

            // paginate
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                berkas(page)
                $('#loader').show();

            })

            function berkas(page) {
                $.ajax({
                    url: "paginate?page=" + page,
                    success: function(res) {
                        $('.berkas-container').html(res);
                        $('#loader').hide();

                    }
                })
            }
        });
    </script>

    @include('modal.ambil')
    @include('modal.tambah')
@endsection
