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

<style>
    body {
        background-color: #ffffff;
        background-image: url('pattern/topography.svg');
        background-repeat: repeat;
    }
</style>

<body class="" style="height: 100vh">
    <!-- content -->
    <div class="container h-100 d-flex flex-column align-items-center">

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
        </div>

        {{-- Toast:end --}}
        @yield('content')
    </div>

</body>

</html>
