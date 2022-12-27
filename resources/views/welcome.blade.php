<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- icon Favicons -->
        <link rel="shortcut icon" href="{{ url('img/logo mithcare/x-icon.png') }}" type="image/x-icon" />

        <title>Mith Care</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- icon -->
        <link href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css" rel="stylesheet">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img width="250" src="{{ url('img/logo mithcare/logo mithcare.png') }}">
                </div>

                <h2>
                    <i class="fa-solid fa-timer"></i>&nbsp;&nbsp; ..MithCare is Coming Soon.. &nbsp;&nbsp;<i class="fa-solid fa-timer"></i>
                </h2>
                <h3>
                    <i class="fa-duotone fa-face-thinking"></i>
                </h3>

                <div class="links">
                    <a href="https://www.viicheck.com/">ViiCHECK</a>
                    <a href="https://www.peddyhub.com/">PEDDyHUB</a>
                    <a href="https://2b-green.com/">2B-Green</a>
                </div>
            </div>
        </div>
    </body>
</html>
