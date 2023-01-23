@extends('layouts.mithcare')

@section('content')

    <section class="page-title page-title-layout5">
        <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="pagetitle__heading">{{Auth::user()->name}}</h1>
                    <nav>
                        <!-- แสดงเฉพาะคอม -->
                        <div class="d-none d-lg-block">
                            <ol class=" breadcrumb mb-0 ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/health_check') }}" style="font-size: 30px;">บ้าน</a></li>
                                <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">หน้าแก้ไขไฟล์</a></li>
                            </ol>
                        </div> <!--d-none d-lg-block -->
                        <!-- แสดงเฉพาะมือถือ -->
                        <div class="d-block d-md-none">
                            <ol class=" breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/health_check') }}" style="font-size: 20px;">บ้าน</a></li>
                                <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">หน้าแก้ไขไฟล์</a></li>
                            </ol>
                        </div> <!--d-block d-md-none -->
                    </nav>
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.page-title -->

    <section class="page-title page-title-layout5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card mt-3">
                        <div class="card-header h4 font-weight-bold bg-transparent"> แก้ไขเอกสารเรื่อง #{{ $health_check->title }}</div>
                        <div class="card-body h5">
                            <br />
                            <br />
                            <form method="POST" action="{{ url('/health_check/' . $health_check->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}

                                @include ('health_check.form', ['formMode' => 'edit'])

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
