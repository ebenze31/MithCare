<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Medcity - Medical Healthcare HTML5 Template">
    <link href="{{asset('/img/logo_mithcare/x-icon.png')}}" rel="icon">
    <title>MithCare</title>



    <!-- calendar -->
    <link href="{{ asset('mithcare/js/fullcalendar/css/main.css') }}" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css" rel="stylesheet">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">


    <link href="{{ asset('mithcare/css/libraries.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/style_by_deer.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        .close_img{
            right:0px;
            position: absolute;
        }
        .ab{
        display: flex;
        align-items: center;
        position: absolute;
        height: 100%;
        top: 0;
        right: 0;
        padding-right: 1px;
        }

        input.pw {
        -webkit-text-security: disc;
        }
        .modal {
            background: rgba(0, 0, 0, 0.5);
        }
        .modal-backdrop {
            display: none;
        }

        p,button,body,h1,h2,h3,h4,h5,h6{
            font-family: 'IBM Plex Sans Thai Looped', sans-serif !important;
        }
        .form-control input {
            border: none;
            box-sizing: border-box;
            outline: 0;
            padding: .75rem;
            position: relative;
            width: 100%;
        }
        input[type="time"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }

    </style>


</head>

<body>
    <div class="wrapper">
        <!-- <div class="preloader">
            <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div>   /.preloader -->

        <!-- =========================
        Header
    =========================== -->
        <header class="header header-layout1">
            <!-- ///////////////
                   คอม
            ///////////////////-->
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
                                            <a  class="phone__number">
                                                <i class="icon-phone"></i> <span>090-559-2624</span>
                                            </a>
                                            <!-- <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-mail"></i> <span>contact.mithcare@gmail.com</span>
                                            </a> -->
                                            {{-- <a href="" class="btn btn__secondary btn__link btn__block">
                                                <span>ติดต่อเรา</span> <i class="icon-arrow-right"></i>
                                            </a> --}}

                                            <!-- เช็คว่ามีข้อมูลเบอร์? ไปหน้าแรก , ไปหน้าลงทะเบียน-->
                                            @if (Auth::check())
                                                @if (empty(Auth::user()->phone) && url()->full() != url('/profile/'. Auth::user()->id . '/register'))

                                                    <a class="d-none" id="register_first_of_id" href="{{ url('/profile/'. Auth::user()->id . '/register') }}">DEER</a>
                                                @endif
                                            @endif
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
                                    <!--<ul class="social-icons list-unstyled mb-0 mr-30">
                                        <li><a href="#"><i class="fab fa-facebook-f" title="facebook"></i></a></li>
                                        <li><a href="#"><i class="fab fa-line" title="line"></i></a></li>

                                    </ul> /.social-icons -->
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
                    <div class="collapse navbar-collapse" id="mainNavigation" >
                        <ul class="navbar-nav ml-auto" >
                            <li class="nav__item ">
                                <a href="{{ url('/') }}" class="nav__item-link active fz-30">หน้าแรก</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href="" data-toggle="dropdown" class="dropdown-toggle nav__item-link">เกี่ยวกับเรา</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="#Health_news" class="nav__item-link">ข่าวสารเกี่ยวกับสุขภาพ</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="#MithCare_Dee_Yang_Rai" class="nav__item-link">MithCare ดีอย่างไร</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            <li class="nav__item has-dropdown">
                                <a href=""  class="nav__item-link">รพ./ร้านขายยา</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="#" class="nav__item-link">โรงพยาบาลใกล้ฉัน</a>
                                    </li> <!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="#" class="nav__item-link">ร้านขายยาใกล้ฉัน</a>
                                    </li> <!-- /.nav-item -->
                                    {{-- <li class="nav__item">
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
                                    </li> <!-- /.nav-item --> --}}
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item -->
                            {{-- <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav__item">
                                        <a href="blog.html" class="nav__item-link">Blog Grid</a>
                                    </li><!-- /.nav-item -->
                                    <li class="nav__item">
                                        <a href="blog-single-post.html" class="nav__item-link">Single Blog Post</a>
                                    </li><!-- /.nav-item -->
                                </ul><!-- /.dropdown-menu -->
                            </li><!-- /.nav-item --> --}}
                            {{-- <li class="nav__item has-dropdown">
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
                            </li><!-- /.nav-item --> --}}
                            {{-- <li class="nav__item">
                                <a href="contact-us.html" class="nav__item-link">ติดต่อ</a>
                            </li><!-- /.nav-item --> --}}

                            <li class="nav__item">
                                @guest
                                <a class="btn btn__primary btn__rounded ml-30 mt-xl-3" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                                @else
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class=" btn btn__primary btn__rounded mt-xl-3"> {{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">

                                    <li class="nav__item">
                                        <a class="nav__item-link text-center" href="{{url('/profile')}}">
                                            <i class="fa-solid fa-user"></i> โปรไฟล์
                                        </a>

                                        <a class="nav__item-link text-center" href="{{url('/room')}}">
                                            <i class="fa-solid fa-home"></i> ครอบครัวของฉัน
                                        </a>

                                        <a class="nav__item-link text-center" href="{{url('/ask_for_help/create')}}">
                                            <i class="fa-solid fa-truck-medical"></i> หน้าขอความช่วยเหลือ
                                        </a>

                                        <a class="nav__item-link text-center" href="{{url('/health_check')}}">
                                            <i class="fa-solid fa-file"></i> หน้าไฟล์ตรวจสุขภาพ
                                        </a>
                                        <a class="nav__item-link text-center" href="{{url('/game')}}">
                                            <i class="fa-solid fa-gamepad"></i> GAME
                                        </a>
                                        <hr>
                                        <a class="nav__item-link text-center" href="{{url('/room_admin')}}">
                                            <i class="fa-solid fa-user-tie"></i> หน้า Admin
                                        </a>
                                        @if (Auth::user()->role == 'isAdmin')
                                        <a class="nav__item-link text-center" href="{{ url('/partner') }}">
                                            <i class="fa-solid fa-handshake"></i> Partner
                                        </a>
                                        @endif
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

                            </li><!-- /.nav-item -->

                        </ul><!-- /.navbar-nav -->
                        <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
                    </div><!-- /.navbar-collapse -->

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
        <hr width="90%">
        <div class="footer-secondary">
            <div class="container">
                <div class="row mb-40">

                        <div class="col-12 ">
                            <div class="slick-carousel"
                            data-slick='{"slidesToShow": 3,
                            {{-- "infinite": true, --}}
                            "slidesToScroll": 1,
                            "autoplay": true,
                            "centerMode": true,
                            "variableWidth": true,
                            "arrows": false,
                            "dots": false,
                            "responsive": [
                                {"breakpoint": 992, "settings": {"slidesToShow": 2}},
                                {"breakpoint": 767, "settings": {"slidesToShow": 1}},
                                {"breakpoint": 480, "settings": {"slidesToShow": 1}}
                            ]}'>

                                @php
                                    $partner = \App\Models\Partner::where(['show_homepage' => 'show'])->get()
                                @endphp

                                @foreach($partner as $item)
                                    <div class="item">
                                        <!-- /.computer -->
                                        <img class="d-none d-lg-block" src="{{ url('storage/'.$item->logo )}}" width="95px" alt="gallery img">
                                        <!-- /.mobile -->
                                        <img class="d-block d-md-none" src="{{ url('storage/'.$item->logo )}}" width="50px" alt="gallery img">

                                    </div>
                                @endforeach
                            </div><!-- /.carousel -->
                        </div><!-- /.col-12 -->

                </div><!-- /.row -->
                <center>
                <div class="copyright text-center h6" style="margin-top:-5px;">
                    <span>•</span> WWW.MithCare.COM
                    <span>•</span>
                    <a href="{{url('privacy_policy')}}">
                        <span>นโยบายเกี่ยวกับข้อมูลส่วนบุคคล</span>
                    </a>
                    <span>•</span>
                    <a href="{{url('terms_of_service')}}">
                        <span>ข้อกำหนดและเงื่อนไขการใช้บริการ</span>
                    </a>

                </div>
                <!-- <a class="h6">เว็บไซต์นี้ อ้างอิงมาจากเว็บไซต์ www.princhealth.com เพื่อใช้ในการพัฒนาระบบเท่านั้น ไม่ได้มีเจตนาแสวงหาผลกำไร</a> -->
                </center>
            </div><!-- /.container -->
        </div><!-- /.footer-secondary -->
    </footer><!-- /.Footer -->
    <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->


    <!--เรียกใช้ axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('mithcare/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('mithcare/js/plugins.js') }}"></script>
    <script src="{{ asset('mithcare/js/main.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(function() {
            // Owl Carousel
            var owl = $(".owl-carousel-mithcare");
            owl.owlCarousel({
                items: 8,
                margin: 40,
                loop: true,
                nav: true
            });
        });


        function goBack() {
            window.history.back()
        }

        $('#myModal').appendTo("body")


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");

            try {
                document.querySelector('#register_first_of_id').click();
            } catch (error) {
            // Only runs when there is an error/exception
            }
        });
        window.addEventListener("DOMContentLoaded", document, false);
    </script>


</body>

</html>
