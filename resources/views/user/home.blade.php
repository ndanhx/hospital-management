<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="copyright" content="MACode ID, https://macodeid.com/">

    <title>One Health</title>
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />

    <link rel="stylesheet" href="../assets/css/maicons.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="../assets/css/theme.css">
    <style>




        .logout-form {
            display: none;
        }

        #user-profile:hover .logout-form {
            display: block;
        }


        /* CSS */
        .tab {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tab button {
            background-color: #f1f1f1;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #c2f2d9;
        }

        .tabcontent {
            display: none;
            padding: 20px;
            text-align: center;
           
            
        }
    </style>
</head>

<body>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-sm">
                        <div class="site-info">
                            
                            <a href="#"><span class="mai-call text-primary"></span> +84 868 888 548</a>
                            <span class="divider">|</span>
                            <a href="#"><span class="mai-mail text-primary"></span> ndanhx@gmail.com</a>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right text-sm">
                        <div class="social-mini-button">
                            <a href="#"><span class="mai-logo-facebook-f"></span></a>
                            <a href="#"><span class="mai-logo-twitter"></span></a>
                            <a href="#"><span class="mai-logo-dribbble"></span></a>
                            <a href="#"><span class="mai-logo-instagram"></span></a>
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .topbar -->

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <a href=""><img style=" width: 50px; padding-right: 10px; " src="admin/assets/images/favicon.png" alt="lỗi"></a>
                <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

                <form action="#">
                    <div class="input-group input-navbar">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username"
                            aria-describedby="icon-addon1">
                    </div>
                </form>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footerview">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doctorview">Doctors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#news">News</a>
                        </li>


                        @if (Route::has('login'))
                            @auth

                            

                                @if (Auth::user()->usertype == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('view-doctor') }}">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('user-view-appointment') }}">Dashboard</a>
                                    </li>
                                @endif




                                <li class="nav-item">
                                    <div id="user-profile">
                                        {{ Auth::user()->name }}
                                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                            @csrf
                                            <input class="btn btn-info" type="submit" value="Logout">
                                        </form>
                                    </div>
                                </li>
                                

                                {{-- <li class="nav-item">

                                    <a href="{{ route('profile.show') }}"> {{ Auth::user()->name }}</a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <input type="submit" value="Logout">

                                    </form>
                                </li> --}}
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary ml-lg-3" href="{{ route('register') }}">Register</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div> <!-- .navbar-collapse -->
            </div> <!-- .container -->
        </nav>
    </header>

    <div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/bg_image_1.jpg);">
        <div class="hero-section">
            <div class="container text-center wow zoomIn">
                <span class="subhead">Let's make your life happier</span>
                <h1 class="display-4">Healthy Living</h1>
                
                @if (Route::has('login'))
                @auth
                <a href="#bookview" class="btn btn-primary">Let's Consult</a>
                @else
                <a href="/login" class="btn btn-primary">Login</a>

                @endauth 
                @endif
               
            </div>
        </div>
    </div>


    <div class="bg-light">
        <div class="page-section py-3 mt-md-n5 custom-index">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-secondary text-white">
                                <span class="mai-chatbubbles-outline"></span>
                            </div>
                            <p><span>Chat</span> with a doctors</p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-primary text-white">
                                <span class="mai-shield-checkmark"></span>
                            </div>
                            <p><span>One</span>-Health Protection</p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-accent text-white">
                                <span class="mai-basket"></span>
                            </div>
                            <p><span>One</span>-Health Pharmacy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .page-section -->

        <div class="page-section pb-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 py-3 wow fadeInUp">
                        <h1>Welcome to Your Health <br> Center</h1>
                        <p class="text-grey mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
                            vero eos et accusam et justo duo dolores et ea rebum. Accusantium aperiam earum ipsa eius,
                            inventore nemo labore eaque porro consequatur ex aspernatur. Explicabo, excepturi
                            accusantium! Placeat voluptates esse ut optio facilis!</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                        <div class="img-place custom-img-1">
                            <img src="../assets/img/bg-doctor.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .bg-light -->
    </div> <!-- .bg-light -->

    @include('user.doctor');

    @include('user.latest');

    @include('user.appointment');

    

    <footer class="page-footer" id="footerview">
        <div class="container">
            <div class="row px-md-3">
                <div class="col-sm-6 col-lg-3 py-3">
                    <h5>Company</h5>
                    <ul class="footer-menu">
                        <li><a href="https://nguyenduyanh.netlify.app/">About Us</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Career</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Editorial Team</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Protection</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 py-3">
                    <h5>More</h5>
                    <ul class="footer-menu">
                        <li><a href="https://nguyenduyanh.netlify.app/">Terms & Condition</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Privacy</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Advertise</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">Join as Doctors</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 py-3">
                    <h5>Our partner</h5>
                    <ul class="footer-menu">
                        <li><a href="https://nguyenduyanh.netlify.app/">One-Fitness</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">One-Drugs</a></li>
                        <li><a href="https://nguyenduyanh.netlify.app/">One-Live</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 py-3">
                    <h5>Contact</h5>
                    <p class="footer-link mt-2">215 Dien bien phu street, ward 15, Binh Thanh</p>
                    <a href="https://nguyenduyanh.netlify.app/" class="footer-link">868-888-548</a>
                    <a href="https://nguyenduyanh.netlify.app/" class="footer-link">ndanhx@gmail.com</a>

                    <h5 class="mt-3">Social Media</h5>
                    <div class="footer-sosmed mt-3">
                        <a href="https://nguyenduyanh.netlify.app/" target="_blank"><span class="mai-logo-facebook-f"></span></a>
                        <a href="https://nguyenduyanh.netlify.app/" target="_blank"><span class="mai-logo-twitter"></span></a>
                        <a href="https://nguyenduyanh.netlify.app/" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
                        <a href="https://nguyenduyanh.netlify.app/" target="_blank"><span class="mai-logo-instagram"></span></a>
                        <a href="https://nguyenduyanh.netlify.app/" target="_blank"><span class="mai-logo-linkedin"></span></a>
                    </div>
                </div>
            </div>

            <hr>

            <p id="copyright">Copyright &copy; 2020 <a href="https://macodeid.com/" target="_blank">MACode ID</a>.
                All right reserved</p>
        </div>
    </footer>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <script src="../assets/vendor/wow/wow.min.js"></script>

    <script src="../assets/js/theme.js"></script>

</body>

</html>
