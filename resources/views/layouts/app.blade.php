<!doctype html>
<html lang="en">

<head>
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
                    <span class="fw-bold">Person 1</span>
                    <p class="mb-0">{{ \Carbon\Carbon::now()->format('h:i d M Y') }}</p>
                </div>
                <img src="https://api.lorem.space/image/face?w=48&h=48" style="width: 42px; height: 42px"
                    class="img-cover rounded-pill my-auto ms-3" alt="">
            </div>
        </div>
    </nav>
    <!-- content -->
    <div class="content">
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
