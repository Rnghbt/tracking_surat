<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking Surat</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/4b89c812ef.js" crossorigin="anonymous"></script>


    {{-- style.css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    {{-- tagify --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>

<body class="content-scrollbar">

    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow">
        <div class="container-md">
            <a href="/" class="text-dark navbar-brand mb-0 h1 fw-bold">Tracking.</a>

            <div class="d-flex">
                <div class="text-end">
                    <span class="fw-bold">Person 1</span>
                    <p class="mb-0">12:20</p>
                </div>
                <img src="https://api.lorem.space/image/face?w=48&h=48" style="width: 42px; height: 42px"
                    class="img-cover rounded-pill my-auto ms-3" alt="">
            </div>
        </div>
    </nav>
    <!-- content -->
    <div class="content">
        <div class="container mt-5">
            @yield('content')
        </div>
    </div>

    <!-- footer -->
    <footer class="bg-dark text-light text-center py-3">
        <div class="container">
            <p>&copy; 2023 Nama Perusahaan. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
