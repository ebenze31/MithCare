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

    <!-- css -->
    <link href="{{ asset('mithcare/css/libraries.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/style_by_deer.css') }}" rel="stylesheet">

    <!-- owl-carousel -->
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
                /* คอม */
        @media screen and (min-width: 1024px) {
            body{
                height: 100% !important;
                overflow: hidden;
            }
            main{
                height: 100% !important;
            }
            footer{
                height: 100% !important;
                margin-bottom: 1rem !important;
            }
        }
            /* tablet */
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            body{
                height: 100% !important;
                /* overflow: hidden; */
            }
            main{
                height: 100% !important;
            }
            footer{
                height: 100% !important;
                margin-bottom: 1rem !important;
            }
        }
                /* มือถือ */
        @media screen and (max-width: 768px) {
            main{
                height: 100%;
            }
            body{
                height: 85%;
                overflow: hidden;
            }
            footer{
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 25%; /* ความสูงของ Footer */
            }
        }

    </style>


</head>

<body>
    <main>
        @yield('content')
    </main>
   <!--เรียกใช้ axios -->
    <!-- ========================
      Footer
    ========================== -->

    <footer class="footer">
        <hr width="90%">
            <div class="container">
                <div class="row mb-40">

                        <div class="col-12 ">
                            <div class="slick-carousel"
                            data-slick='{"slidesToShow": 3,
                            {{-- "infinite": true, --}}
                            "slidesToScroll": 2,
                            "autoplay": false,
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
                                        <img class="" src="{{ url('storage/'.$item->logo )}}"  width="40em" alt="gallery img">
                                        {{-- <img class="d-none d-lg-block" src="{{ url('storage/'.$item->logo )}}" height="25rem" width="25rem" alt="gallery img"> --}}
                                        <!-- /.mobile -->
                                        {{-- <img class="d-block d-md-none" src="{{ url('storage/'.$item->logo )}}" width="50px" alt="gallery img"> --}}

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
    </footer><!-- /.Footer -->

   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        // function goBack() {
        //     window.history.back()
        // }

        $('#myModal').appendTo("body")


    </script>

</body>
</html>
