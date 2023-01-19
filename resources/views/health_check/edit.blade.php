@extends('layouts.mithcare')

@section('content')

    <section class="page-title page-title-layout5">
        <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <nav>
                        <!-- แสดงเฉพาะคอม -->
                        <div class="d-none d-lg-block">
                            <ol class=" breadcrumb mb-0 ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a></li>
                            </ol>
                        </div> <!--d-none d-lg-block -->
                        <!-- แสดงเฉพาะมือถือ -->
                        <div class="d-block d-md-none">
                            <ol class=" breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                            </ol>
                        </div> <!--d-block d-md-none -->
                    </nav>
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.page-title -->

    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Health_check #{{ $health_check->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/health_check') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

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
@endsection
