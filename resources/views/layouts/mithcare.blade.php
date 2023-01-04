<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Medcity - Medical Healthcare HTML5 Template">
    <link href="assets/images/favicon/favicon.png" rel="icon">
    <title>MithCare</title>

       
     <!-- icon -->

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
     <link href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css" rel="stylesheet"> 

     <!-- font -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">

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
                                        <button class="miniPopup-emergency-trigger" type="button">ติดต่อพวกเรา</button>
                                        <div id="miniPopup-emergency" class="miniPopup miniPopup-emergency text-center">
                                            <div class="emergency__icon">
                                                <i class="icon-call3"></i>
                                            </div>
                                            <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-phone"></i> <span>02-0277856</span>
                                            </a>
                                            <!-- <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-mail"></i> <span>contact.mithcare@gmail.com</span>
                                            </a> -->
                                            <a href="" class="btn btn__secondary btn__link btn__block">
                                                <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                                            </a>
                                        </div><!-- /.miniPopup-emergency -->
                                    </li>
                                    <!-- <li>
                                        <i class="icon-phone"></i><a href="#">02-0277856</a>
                                    </li> -->
                                    <li>
                                        <i class="icon-email"></i><a href="#">contact.mithcare@gmail.com </a>
                                    </li>

                                </ul><!-- /.contact__list -->
                                <div class="d-flex">
                                    <ul class="social-icons list-unstyled mb-0 mr-30">
                                        <li><a href="#"><i class="fab fa-facebook-f" title="facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-line" title="line"></i></a></li>

                                    </ul><!-- /.social-icons -->
                                    <!-- <form class="header-topbar__search">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <button class="header-topbar__search-btn"><i class="fa fa-search"></i></button>
                                    </form> -->
                                </div>
                            </div>
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.header-top -->
            <nav class="navbar navbar-expand-lg sticky-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('/img/logo_mithcare/logo_mithcare(แนวนอน).png') }}" width="150px" class="logo-dark" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button">
                        <span class="menu-lines"><span></span></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNavigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link active">หน้าแรก</a>
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
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">เกี่ยวกับเรา</a>
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
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">หมอ</a>
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
                                <a href="contact-us.html" class="nav__item-link">ติดต่อ</a>
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
                                    
                                    <a class="nav__item-link text-center" href="#" >
                                        <i class="fa-solid fa-user"></i>โปรไฟล์
                                    </a>
                                </li>
                                <hr style="width: 75%;">
                                <li class="nav__item">
                                    <a class="nav__item-link text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>{{ __('Logout') }}
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
            

        


            <div class="footer-secondary">
                <div class="container">
                    <div class="row ">
                        <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                            <span class="fz-14">&copy; 2020 DataSoft, All Rights Reserved. With Love by</span>
                            <a class="fz-14 color-primary" href="http://themeforest.net/user/7oroof">7oroof.com</a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <nav>
                                <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end mb-0">
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cookies</a></li>
                                </ul>
                            </nav>
                        </div> -->
                      
               

                        <div class="copyright text-center align-items-center" style="margin-top:-15px;">
                            <span>•</span> WWW.MithCare.COM
                            <span>•</span>
                            <a href="privacy_policy">
                                <span>นโยบายเกี่ยวกับข้อมูลส่วนบุคคล</span>
                            </a>
                            <span>•</span>
                            <a href="terms_of_service">
                                <span>ข้อกำหนดและเงื่อนไขการใช้บริการ</span>
                            </a>
                        </div>


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