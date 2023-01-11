@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">deer</h1>
                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room_join') }}" style="font-size: 30px;">เข้าร่วมบ้าน</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room_join') }}" style="font-size: 20px;">เข้าร่วมบ้าน</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="page-title page-title-layout5">
    <div class="container">
        <div class="row">
     
            <div class="contact-panel col-md-12 mb-2">

                <h3>เข้าร่วมบ้าน</h3>
                <div class="container">
                    <a href="#" onclick="goBack()"><button class="btn btn-info btn-sm main-shadow main-radius" style="font-size: 20px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <form method="POST" action="{{ url('/room_join') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('room.form_join')

                    </form>

                </div>

            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection