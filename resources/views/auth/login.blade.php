@extends('layouts.mithcare')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="section-overlay"></div>

            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <form class="custom-form donate-form" method="POST" action="{{ route('login') }}" role="form">
                        @csrf
                        <section class="contact-layout1 pt-0 ">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="contact-panel d-flex flex-wrap">
                                            <center>
                                                <img class="d-none d-md-block " style=" width: 50%; " src="{{asset('/img/logo_mithcare/x-icon.png')}}">
                                            </center>

                                            <div class="row">
                                                <div class="col-sm-12 mt-10">
                                                    <h4 class="contact-panel__title text-center">เข้าสู่ระบบ </h4>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-user form-group-icon"></i>
                                                        <input id="email" type="email" placeholder="Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div><!-- /.col-lg-6 -->

                                                <div class="col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <i class="icon-email form-group-icon"></i>
                                                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div><!-- /.col-lg-6 -->



                                                <div class="col-12">
                                                    <button type="submit" class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10">
                                                        <span>เข้าสู่ระบบ</span> <i class="icon-arrow-right"></i>
                                                    </button>
                                                </div><!-- /.col-lg-12 -->

                                                <div class="col-12">
                                                    <center>
                                                        <br> <hr class="hr" style="width:70%;">
                                                    </center>
                                                </div>


                                                <div class="col-sm-12 col-md-12 col-lg-12 mt-5">
                                                    <a href="{{ url('login/line') }}">
                                                        <span style="background-color: #21C608;" class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10 main-shadow">
                                                            <img src="{{ asset('/img/icon_Social/icon-line.png')}}"  style="border-radius: 30px;background-color: #ffff; margin-top:5px; margin-bottom:5px" width="10%" class="center main-shadow " >&nbsp;&nbsp; เข้าสู่ระบบด้วย LINE
                                                        </span>
                                                    </a>

                                                    <br>
                                                    <br>
                                                    <center>
                                                        <a href="{{ route('register') }}">สมัครสมาชิก</a>
                                                    </center>
                                                </div><!-- /.col-lg-12 -->
                                            </div><!-- /.row -->

                                        </div><!-- /.col-lg-6 -->
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.container -->
                        </section>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
    @endsection
