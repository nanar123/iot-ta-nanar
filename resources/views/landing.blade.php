<!doctype html>
<html lang="en">

<head>
    <title>Landing Internet of Things</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style-landing.css">
</head>

<body>

    <header role="banner">

        <nav class="navbar navbar-expand-md navbar-dark bg-light">
            <div class="container">
                <a class="navbar-brand absolute" href="index.html">Internet Of Things</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                    aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://www.linkedin.com/in/nanar-tyrta-prayuga-9a8444296/">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/nanar123">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <!-- END header -->

    <section class="site-hero overlay" data-stellar-background-ratio="0.5"
        style="background-image: url(images/iiot.jpg);">
        <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
                <div class="col-md-8 text-center">

                    <div class="mb-5 element-animate">
                        <h1>WELCOME</h1>
                        <p class="lead">The internet of things is a network of interconnected physical devices that
                            exchange data with one another</p>
                        {{-- tag a: anchor->hyperlink --}}
                        {{-- gref: hyperlink reference --}}
                        <p><a href="{{ route('login') }}" class="btn btn-primary">SIGN IN</a></p>

                    </div>


                </div>
            </div>
        </div>
    </section>


    <section class="school-features d-flex" style="background-image: url(img/biru.jpg);">

        <div class="inner">
            <div class="media d-block feature">
                <div class="icon"><span class="flaticon-student"></span></div>
                <div class="media-body">
                    <h3 class="mt-0">Online trainings from experts</h3>
                    <p> Online learning provides fantastic flexibility, among other benefits, and aids in making
                        the task of arranging development opportunities far easier. </p>
                </div>
            </div>

            <div class="media d-block feature">
                <div class="icon"><span class="flaticon-book"></span></div>
                <div class="media-body">
                    <h3 class="mt-0">Creative learning teknologi</h3>
                    <p> The comfort zone is the great enemy of creativity; moving beyond them requires intuition,
                        which in turn forms new perspectives and levels the playing field.</p>
                </div>
            </div>

            <div class="media d-block feature">
                <div class="icon"><span class="flaticon-geography"></span></div>
                <div class="media-body">
                    <h3 class="mt-0">Learn anywhere in the world</h3>
                    <p> You're going to see this 'Internet of Things' start to place greater demands on
                        network performance and make networks more aware of what's on them.</p>
                </div>
            </div>


            <div class="media d-block feature">
                <div class="icon"><span class="flaticon-interface"></span></div>
                <div class="media-body">
                    <h3 class="mt-0">Audio learning</h3>
                    <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati,
                        voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->


    <section class="section-cover" data-stellar-background-ratio="0.5" style="background-image: url(img/iot.jpeg);">
        <div class="container">
            <div class="row justify-content-center align-items-center intro">
                <div class="col-md-7 text-center element-animate">
                    <h2>Sign Up </h2>
                    <p class="lead mb-5">
                        <span>The Internet of Things</span><br>
                        <span>Is Just The Beginning</span>
                    </p>
                    <p><a href="{{ route('register') }}" class="btn btn-primary">SIGN UP</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->


    <section class="site-section bg-light-grey">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center">
                    <h2>Quotes Teknologi</h2>
                    <p class="lead"> " I think we should be very careful about artificial intelligence. If I had to
                        guess at what our biggest existential threat is,
                        I’d probably say that. So, we need to be very careful.” –– Elon Musk </p>
                </div>
            </div>

            <div class="row top-course">
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://laravel.com/docs/11.x/releases" class="course">
                        <img src="img/laravel.png" alt="Image placeholder">
                        <h2>Laravel 11</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://www.programiz.com/cpp-programming/online-compiler/" class="course">
                        <img src="img/cc.png" alt="Image placeholder">
                        <h2>C++</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://www.arduino.cc/" class="course">
                        <img src="img/arduino1.jpg" alt="Image placeholder">
                        <h2>Arduino</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://react.dev/" class="course">
                        <img src="images/reactjs.jpg" alt="Image placeholder">
                        <h2>Learn Native ReactJS</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://www.php.net/" class="course">
                        <img src="img/php.png" alt="Image placeholder">
                        <h2>PHP</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <a href="https://alexa.amazon.com/" class="course">
                        <img src="img/alexa.jpeg" alt="Image placeholder">
                        <h2>ALEXA</h2>
                        <p>Enroll Now</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="overflow">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-7 order-lg-3 order-1 mb-lg-0 mb-5">
                    <img src="images/iot 2.jpg" alt="Image placeholder" class="img-md-fluid">
                </div>
                <div class="col-lg-1 order-lg-2"></div>
                <div class="col-lg-4 order-lg-1 order-2 mb-lg-0 mb-5">
                    <blockquote class="testimonial">
                        &ldquo; “You’re going to see this ‘Internet of things’ start demanding network performance and
                        making the networks much more aware of what is on top of them.” &rdquo;
                    </blockquote>
                    <p>&mdash; –– Hans Vestberg</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <footer class="site-footer" style="background-image: url(img/biru2.jpg);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4">
                    <h3>About</h3>
                    <p>
                        The Internet of Things (IoT) describes the network of physical objects—“things”—that are
                        embedded with sensors, software, and other technologies for the purpose of connecting
                        and exchanging data with other devices and systems over the internet.
                    </p>
                </div>
                <div class="col-md-6 ml-auto">
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li><a href="https://www.linkedin.com/in/nanar-tyrta-prayuga-9a8444296/" class="nav-link">About Us</a>
                                </li>
                                <li><a href="#" class="nav-link">Contact</a></li>
                                <li><a href="https://arkatama.id/articles/" class="nav-link">Artikel</a></li>
                                <li><a href="https://arkatama.id/portofolio/" class="nav-link">Portofolio</a></li>
                                <br>
                                <ul class="list-unstyled d-flex social-icons" style="margin-left: -50px;">
                                    <li class="mr-3"><a href="https://www.linkedin.com/in/nanar-tyrta-prayuga-9a8444296/" class="nav-link" target="_blank"><i
                                                class="bi bi-linkedin fs-2"></i></a></li>
                                    <li class="mr-3"><a href="https://www.youtube.com/watch?v=7RjcCLVNVLo" class="nav-link" target="_blank"><i
                                                class="bi bi-youtube fs-2"></i></a></li>
                                    <li class="mr-3"><a
                                            href="https://x.com/MasterNTP_?t=y0NBqEFnufWUS1VoBLIJMw&s=09"
                                            class="nav-link" target="_blank"><i class="bi bi-twitter"></i></a></li>
                                    <li class="mr-3"><a href="#" class="nav-link" target="_blank"><i
                                                class="bi bi-facebook"></i></a></li>

                                    <li class="mr-3"><a href="https://bardi.co.id/alexa-amazon-echo/" class="nav-link" target="_blank"><i
                                                class="bi bi-whatsapp"></i></a></li>
                                    <li class="mr-3"><a href="" class="nav-link" target="_blank"><i
                                                class="bi bi-globe2"></i></i></a></li>
                                </ul>
                                </br>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Nanar.Tp.Web.id <i class=""
                            aria-hidden=""></i> <a href="" target="_blank"></a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#f4b214" />
        </svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-landing.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <script src="js/main-landing.js"></script>
</body>

</html>
