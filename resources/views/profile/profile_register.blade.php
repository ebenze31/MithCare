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
    <link href="assets/plugins/fullcalendar/css/main.min.css" rel="stylesheet" />
    <link href="{{ asset('mithcare/js/fullcalendar/css/main.min.css') }}" rel="stylesheet">

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
        input[type="file"]::file-selector-button {
            border: 2px solid #00cec9;
            border-radius: 50%;
            padding: 0.3em 0.5em;
            border-radius: 0.8em;
            background-color: #81ecec;
            transition: 1s;
            margin-top: 0.8em;

        }
        input[type="file"]::file-selector-button:hover {
            background-color: #007bff;
            border: 2px solid #4170A2;
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
                                            <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-phone"></i> <span>02-0277856</span>
                                            </a>
                                            <!-- <a href="tel:+201061245741" class="phone__number">
                                                <i class="icon-mail"></i> <span>contact.mithcare@gmail.com</span>
                                            </a> -->
                                            <a href="" class="btn btn__secondary btn__link btn__block">
                                                <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                                            </a>
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
                    <div class="collapse navbar-collapse" id="mainNavigation">
                        <ul class="navbar-nav ml-auto">

                            <li class="nav__item">
                                @guest
                                <a class="btn btn__primary btn__rounded ml-30 mt-xl-3" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                                @else
                            <li class="nav__item has-dropdown">
                                <a href="#" data-toggle="dropdown" class=" btn btn__primary btn__rounded mt-xl-3"> {{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">

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

        <!-- ========================
            Content
        ========================== -->

        <section class="page-title page-title-layout5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card mt-3">
                            <div class="card-header h4 font-weight-bold bg-transparent text-center text-primary"> กรอกข้อมูลเบื้องต้น</div>
                            <div class="card-body h5 text-info">
                                <br />
                                <br />
                                <form method="POST" action="{{ url('/profile/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="text-center text-info">บัตรที่ 1</h5>
                                            <div id="health_card_1_old">
                                                @if (!empty($user->health_card_1))
                                                      <!-- คอม -->
                                                      <div class="d-none d-lg-block">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="150px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_1 }}" >
                                                        </div>
                                                    </div>
                                                    <!-- มือถือ -->
                                                    <div class="d-block d-md-none">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius " height="200px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_1 }}" >
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- คอม -->
                                                    <div class="d-none d-lg-block">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="150px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                    <!-- มือถือ -->
                                                    <div class="d-block d-md-none">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="main-radius" id="health_card_1_new" class="m-2"></div>
                                            <div class="form-group mt-3">
                                                <input class="form-control" name="health_card_1" type="file" id="health_card_1" value="{{ url('storage/'.$user->health_card_1 )}}"
                                                onchange="document.querySelector('#health_card_1_old').classList.add('d-none');">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="text-center text-info">บัตรที่ 2</h5>
                                            <div id="health_card_2_old">
                                                @if (!empty($user->health_card_2))
                                                        <!-- คอม -->
                                                        <div class="d-none d-lg-block">
                                                            <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                                <img class="main-radius"  height="150px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_2 }}" >
                                                            </div>
                                                        </div>
                                                        <!-- มือถือ -->
                                                        <div class="d-block d-md-none">
                                                            <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                                <img class="main-radius " height="200px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_2 }}" >
                                                            </div>
                                                        </div>
                                                @else
                                                    <!-- คอม -->
                                                    <div class="d-none d-lg-block">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="150px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                    <!-- มือถือ -->
                                                    <div class="d-block d-md-none">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="main-radius" id="health_card_2_new" class="m-2"></div>
                                            <div class="form-group mt-3">
                                                <input class="form-control" name="health_card_2" type="file" id="health_card_2" value="{{ url('storage/'.$user->health_card_2 )}}"
                                                onchange="document.querySelector('#health_card_2_old').classList.add('d-none');" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-center text-info">บัตรที่ 3</h5>
                                            <div id="health_card_3_old">
                                                @if (!empty($user->health_card_3))
                                                     <!-- คอม -->
                                                     <div class="d-none d-lg-block">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="150px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_3 }}" >
                                                        </div>
                                                    </div>
                                                    <!-- มือถือ -->
                                                    <div class="d-block d-md-none">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius " height="200px" width="100%" src="{{ url('storage')}}/{{ $user->health_card_3 }}" >
                                                        </div>
                                                    </div>
                                                @else
                                                     <!-- คอม -->
                                                     <div class="d-none d-lg-block">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="150px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                    <!-- มือถือ -->
                                                    <div class="d-block d-md-none">
                                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                                            <img class="main-radius"  height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="main-radius" id="health_card_3_new" class="m-2"></div>
                                            <div class="form-group mt-3">
                                                  <input class="form-control" name="health_card_3" type="file" id="health_card_3" value="{{ url('storage/'.$user->health_card_3 )}}"
                                                  onchange="document.querySelector('#health_card_3_old').classList.add('d-none');" >
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                    <br>
                                    <br>

                                    @include ('profile.profile_form', ['formMode' => 'edit'])

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ========================
      Footer
    ========================== -->
    <footer class="footer">

        <hr width="90%">
        <div class="footer-secondary">
            <div class="container">
                <div class="row ">

                    <section class="gallery pt-0 pb-90">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">

                                                {{-- คอม --}}
                                    <div class="home-demo d-none d-lg-block">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/logo-ph.png')}}" width="50px" alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/logo_x-icon.png')}}" width="50px" alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/green-logo-01.png')}}" width="50px" alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/chalie-2.2.png')}}" width="50px" alt="gallery img">
                                            </div>
                                        </div>
                                    </div>

                                                {{-- มือถือ --}}
                                    <div class="home-demo d-block d-md-none">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/logo-ph.png')}}" width="50px"  alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/logo_x-icon.png')}}" width="50px"  alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/green-logo-01.png')}}" width="50px"   alt="gallery img">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('/img/logo_partner/chalie-2.2.png')}}" width="50px"   alt="gallery img">
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.gallery-images-wrapper -->
                            </div><!-- /.col-xl-5 -->
                        </div><!-- /.row -->
                </div><!-- /.container -->
                </section><!-- /.gallery 2 -->


                <div class="copyright text-center align-items-center " style="margin-top:-15px;">
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(function() {
            // Owl Carousel
            var owl = $(".owl-carousel");
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




</body>

</html>


{{-- กดอัพโหลดรูปบัตร 1->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_1").change(function () {
            var health_card_1_new = $("#health_card_1_new");
            health_card_1_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "100%");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_1_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>

{{-- กดอัพโหลดรูปบัตร 2->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_2").change(function () {
            var health_card_2_new = $("#health_card_2_new");
            health_card_2_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "100%");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_2_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>

{{-- กดอัพโหลดรูปบัตร 3->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_3").change(function () {
            var health_card_3_new = $("#health_card_3_new");
            health_card_3_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "100%");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_3_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>
