<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Medcity - Medical Healthcare HTML5 Template">
    <link href="assets/images/favicon/favicon.png" rel="icon">
    <title>Medcity - Medical Healthcare HTML5 Template</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

    <link href="{{ asset('mithcare/css/libraries.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="preloader">
            <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div><!-- /.preloader -->

        <!-- =========================
        Header
    =========================== -->
        <header class="header header-layout1">
            <div class="header-topbar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <ul class="contact__list d-flex flex-wrap align-items-center list-unstyled mb-0">
                                    <li>
                                        <button class="miniPopup-emergency-trigger" type="button">24/7 Emergency</button>
                                        <div id="miniPopup-emergency" class="miniPopup miniPopup-emergency text-center">
                                            <div class="emergency__icon">
                                                <i class="icon-call3"></i>
                                            </div>
                                            <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-phone"></i> <span>+2 01061245741</span>
                                            </a>
                                            <p>Please feel free to contact our friendly reception staff with any general or medical enquiry.
                                            </p>
                                            <a href="appointment.html" class="btn btn__secondary btn__link btn__block">
                                                <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                                            </a>
                                        </div><!-- /.miniPopup-emergency -->
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i><a href="tel:+5565454117">Emergency Line: (002) 01061245741</a>
                                    </li>
                                    <li>
                                        <i class="icon-location"></i><a href="#">Location: Brooklyn, New York</a>
                                    </li>
                                    <li>
                                        <i class="icon-clock"></i><a href="contact-us.html">Mon - Fri: 8:00 am - 7:00 pm</a>
                                    </li>
                                </ul><!-- /.contact__list -->
                                <div class="d-flex">
                                    <ul class="social-icons list-unstyled mb-0 mr-30">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </ul><!-- /.social-icons -->
                                    <form class="header-topbar__search">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <button class="header-topbar__search-btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.header-top -->
            <nav class="navbar navbar-expand-lg sticky-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ asset('/img/logo_mithcare/logo_mithcare(แนวนอน).png') }}" width="150px" class="logo-dark" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button">
                        <span class="menu-lines"><span></span></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link active">Home</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="index.html" class="nav__item-link">Home Main</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="home-modern.html" class="nav__item-link">Home Modern</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="home-classic.html" class="nav__item-link">Home Classic</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="home-dentist.html" class="nav__item-link">Home Dentist</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="home-pharmacy.html" class="nav__item-link">Home pharmacy</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">About Us</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="about-us.html" class="nav__item-link">About Us</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="services.html" class="nav__item-link">Our Services</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="services-single.html" class="nav__item-link">single Services</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="pricing.html" class="nav__item-link">Pricing & Plans</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="appointment.html" class="nav__item-link">Appointments</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="faqs.html" class="nav__item-link">Help & FAQs</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="gallery.html" class="nav__item-link">Our Gallery</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Doctors</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="doctors-timetable.html" class="nav__item-link">Doctors Timetable</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="doctors-standard.html" class="nav__item-link">Our Doctors Standard</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="doctors-modern.html" class="nav__item-link">Our Doctors Modern</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="doctors-grid.html" class="nav__item-link">Our Doctors Grid</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="doctors-single-doctor1.html" class="nav__item-link">Single Doctor 01</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="doctors-single-doctor2.html" class="nav__item-link">Single Doctor 02</a>
                                    </li> <!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="blog.html" class="nav__item-link">Blog Grid</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="blog-single-post.html" class="nav__item-link">Single Blog Post</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="shop.html" class="nav__item-link">Our Products</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="shop-single-product.html" class="nav__item-link">Products Single</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="cart.html" class="nav__item-link">Cart</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="contact-us.html" class="nav__item-link">Contacts</a>
                            </li><!-- /.nav-item -->
                        </ul><!-- /.navbar-nav -->
                        <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
                    </div><!-- /.navbar-collapse -->
                    <div class="d-none d-xl-flex align-items-center position-relative ml-30">
                        <div class="miniPopup-departments-trigger">
                            <span class="menu-lines" id="miniPopup-departments-trigger-icon"><span></span></span>
                            <a href="departments.html">Departments</a>
                        </div>
                        <ul id="miniPopup-departments" class="miniPopup miniPopup-departments dropdown-menu">
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Neurology Clinic</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Cardiology Clinic</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Pathology Clinic</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Laboratory Clinic</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Pediatric Clinic</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item">
                                <a href="department-single.html" class="nav__item-link">Cardiac Clinic</a>
                            </li><!-- /.nav-item -->
                        </ul> <!-- /.miniPopup-departments -->

                        <!-- Authentication Links -->
                        @guest

                        <a class="btn btn__primary btn__rounded ml-30" href="{{ route('login') }}">{{ __('Login') }}</a>

                        <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else


                        <li class="nav__item has-dropdown">
                            <a href="#" data-toggle="dropdown" class=" btn btn__primary btn__rounded ml-30"> {{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li class="nav__item">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li><!-- /.nav-item -->

                            </ul><!-- /.dropdown-menu -->
                        </li><!-- /.nav-item -->
                        @endguest


                    </div>
                </div><!-- /.container -->
            </nav><!-- /.navabr -->
        </header><!-- /.Header -->

        <main class="py-4">
            @yield('content')
        </main>

        <!-- ========================
      Footer
    ========================== -->
        <footer class="footer">
            <div class="footer-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="footer-widget-about">
                                <img src="mithcare/images/logo/logo-light.png" alt="logo" class="mb-30">
                                <p class="color-gray">Our goal is to deliver quality of care in a courteous, respectful, and
                                    compassionate manner. We hope you will allow us to care for you and strive to be the first and best
                                    choice for your family healthcare.
                                </p>
                                <a href="appointment.html" class="btn btn__primary btn__primary-style2 btn__link">
                                    <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                                </a>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-xl-2 -->
                        <div class="col-sm-6 col-md-6 col-lg-2 offset-lg-1">
                            <div class="footer-widget-nav">
                                <h6 class="footer-widget__title">Departments</h6>
                                <nav>
                                    <ul class="list-unstyled">
                                        <li><a href="#">Neurology Clinic</a></li>
                                        <li><a href="#">Cardiology Clinic</a></li>
                                        <li><a href="#">Pathology Clinic</a></li>
                                        <li><a href="#">Laboratory Analysis</a></li>
                                        <li><a href="#">Pediatric Clinic</a></li>
                                        <li><a href="#">Cardiac Clinic</a></li>
                                    </ul>
                                </nav>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-sm-6 col-md-6 col-lg-2">
                            <div class="footer-widget-nav">
                                <h6 class="footer-widget__title">Links</h6>
                                <nav>
                                    <ul class="list-unstyled">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Our CLinic</a></li>
                                        <li><a href="#">Our Doctors</a></li>
                                        <li><a href="#">News & Media</a></li>
                                        <li><a href="#">Appointments</a></li>
                                    </ul>
                                </nav>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="footer-widget-contact">
                                <h6 class="footer-widget__title color-heading">Quick Contacts</h6>
                                <ul class="contact-list list-unstyled">
                                    <li>If you have any questions or need help, feel free to contact with our team.</li>
                                    <li>
                                        <a href="tel:01061245741" class="phone__number">
                                            <i class="icon-phone"></i> <span>01061245741</span>
                                        </a>
                                    </li>
                                    <li class="color-body">2307 Beverley Rd Brooklyn, New York 11226 United States.</li>
                                </ul>
                                <div class="d-flex align-items-center">
                                    <a href="contact-us.html" class="btn btn__primary btn__link mr-30">
                                        <i class="icon-arrow-right"></i> <span>Get Directions</span>
                                    </a>
                                    <ul class="social-icons list-unstyled mb-0">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </ul><!-- /.social-icons -->
                                </div>
                            </div><!-- /.footer-widget__content -->
                        </div><!-- /.col-lg-2 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-primary -->
            <div class="footer-secondary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <span class="fz-14">&copy; 2020 DataSoft, All Rights Reserved. With Love by</span>
                            <a class="fz-14 color-primary" href="http://themeforest.net/user/7oroof">7oroof.com</a>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <nav>
                                <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end mb-0">
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cookies</a></li>
                                </ul>
                            </nav>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-secondary -->
        </footer><!-- /.Footer -->
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src="{{ asset('mithcare/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('mithcare/js/plugins.js') }}"></script>
    <script src="{{ asset('mithcare/js/main.js') }}"></script>
</body>

</html>