@extends('layouts.guest')

@section('content')
    <div class="col col-12 col-sm-10 col-md-4 m-auto card px-4 py-5">
        <!-- title -->
        <div class="text-center mb-3">
            <h1 class="fw-semibold">Login</h1>
            <small>Silahkan masukan username dan password dengan benar.</small>
        </div>

        <!-- form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- input user -->
            <div class="mb-3">
                <div class="form">
                    <i class="icon-left fa-solid fa-user fa-md"></i>
                    <input type="text" class="form-control lr" id="floatingInput" name="username" placeholder="Username"
                        autofocus>
                </div>
                @error('username')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- input password -->
            <div class="mb-3">

                <div class="form ">
                    <i class="icon-left fa-solid fa-lock fa-md"></i>
                    <input type="password" class="form-control lr" id="floatingPassword" name="password"
                        placeholder="Password">
                    <i onclick="togglePassword()" class="icon-right act fa-solid fa-eye fa-md" id="togglePassword"></i>
                </div>
                @error('password')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>


            <div class="text-center">
                <input class="btn btn-primary" type="submit" value="Login">
            </div>
        </form>
    </div>


    <script>
        function togglePassword() {
            const inputpassword = document.getElementById("floatingPassword");
            const togglePassword = document.getElementById("togglePassword");
            if (inputpassword.getAttribute("type") == "password") {
                togglePassword.classList.replace("fa-eye", "fa-eye-slash")
                inputpassword.setAttribute("type", "text");
            } else if (inputpassword.getAttribute("type") == "text") {
                togglePassword.classList.replace("fa-eye-slash", "fa-eye")
                inputpassword.setAttribute("type", "password");
            }
        }
    </script>
@endsection
