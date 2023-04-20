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

    <main class="py-4">
        @yield('content')
    </main>

</body>
</html>
