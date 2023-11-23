@extends('layout.guest')

@section('content')
    <div class="container mt-5 pt-5">

        <div class="row">
            <div class="col col-12 col-sm-10 col-md-4 m-auto">
                <!-- image -->
                <div class="w-75 m-auto">
                    <img class="img img-fluid" src="img/login-illustration.png" alt="">
                </div>
                <!-- title -->
                <div class="text-center mt-3">
                    <h1 class="fw-bold">Login</h1>
                </div>

                <!-- form -->
                <form action="#">

                    <!-- input user -->
                    <div class="form mb-3">
                        <i class="icon-left fa-solid fa-user fa-md"></i>
                        <input type="text" class="form-control lr" id="floatingInput" placeholder="Username">
                    </div>

                    <!-- input password -->
                    <div class="form mb-3">
                        <i class="icon-left fa-solid fa-lock fa-md"></i>
                        <input type="password" class="form-control lr" id="floatingPassword" placeholder="Password">
                        <i onclick="togglePassword()" class="icon-right act fa-solid fa-eye fa-md" id="togglePassword"></i>
                    </div>

                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Login">
                    </div>
                </form>
            </div>
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

    </div>
@endsection
