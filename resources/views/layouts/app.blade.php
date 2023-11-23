<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking Surat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/4b89c812ef.js" crossorigin="anonymous"></script>

    {{-- animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- style.css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">



    {{-- tagify --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>

<script>
    $(document).ready(function() {

        function hideSpinner() {
            $('#container-loader').addClass('d-none');
        }
        $(window).on('load', function() {
            hideSpinner();
        });

    });
</script>

<body class="content-scrollbar">
    <div class="fixed-bottom">
        <div id="container-loader" class="bg-light d-flex justify-content-center align-items-center vh-100">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow">
        <div class="container-md">
            <a href="/" class="text-dark navbar-brand mb-0 h1 fw-bold">Tracking.</a>

            <div class="d-flex">
                <div class="text-end">
                    <span class="fw-bold">{{ Session::get('login')['nama_pegawai'] }}</span>
                    <p class="mb-0">{{ \Carbon\Carbon::now()->format('d M Y h:i') }}</p>
                </div>
                <div class="dropdown-center">
                    <a data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://api.lorem.space/image/face?w=48&h=48" style="width: 42px; height: 42px"
                            class="img-cover rounded-pill my-auto ms-3" alt="">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <!-- content -->
    <div class="content">
        {{-- Toast --}}
        <div class="toast-container top-0 end-0 p-3" id="toastPlacement">
            @if (session()->has('failure'))
                <div id="failtoast" class="toast text-bg-danger">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session()->get('failure') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        const failtoast = bootstrap.Toast.getOrCreateInstance($('#failtoast'))
                        failtoast.show()
                    });
                </script>
            @endif
            @if (session()->has('success'))
                <div id="failtoast" class="toast text-bg-success">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session()->get('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        const failtoast = bootstrap.Toast.getOrCreateInstance($('#failtoast'))
                        failtoast.show()
                    });
                </script>
            @endif
        </div>
        <div class="container mt-3">
            @yield('content')
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-dark text-light text-center py-3 mt-3">
        <div class="container">
            <p>&copy; 2023 Nama Perusahaan. All Rights Reserved.</p>
        </div>
    </footer>



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Your Bootstrap-related JavaScript code here
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl))
        });
    </script>

</body>

</html>
