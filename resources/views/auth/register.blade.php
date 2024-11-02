@extends('layouts.auth')

@section('content')
    <!-- Sign Up Start -->
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Register - Pegawai</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets1/img/nty.png" rel="icon">
        <link href="assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets1/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets1/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets1/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets1/css/style.css" rel="stylesheet">

    </head>


    <main style="background-image: url('assets1/img/regis4.jpg'); background-size: cover; background-position: center; min-height: 100vh; width: 100vw; overflow: hidden;">
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets1/img/nty.png" alt="">
                                    <span class="d-none d-lg-block">Register Panel</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create an account</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Username</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    required>
                                                <div class="invalid-feedback">Please enter a valid email address!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="confirmPassword" required>
                                            <div class="invalid-feedback">Please confirm your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Log in</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="credits">
                                Designed by <a href="https://github.com/nanar123">nanartp.web.id</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- End #main -->

    <script>
        // Enable form validation
        (function () {
            'use strict';

            // Fetch all forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation');

            // Loop over forms and prevent submission if invalid
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    <!-- Sign Up End -->
@endsection
