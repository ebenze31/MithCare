@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5 mb-3">
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

<section class="page-title page-title-layout5 mb-3">
    <div class="container d-none d-lg-block">
        <div class="row ">
            {{-- @include('admin.sidebar') --}}
            <div class="col-md-12 ">

                <div class="card mr-2 main-radius ">
                    <div class="card-header font-weight-bold" style="font-size: 25px">ไฟล์ตรวจสุขภาพ</div>
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm main-radius main-shadow text-white"
                        data-toggle="modal" data-target="#create_room">
                            <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มไฟล์ตรวจสุขภาพ
                        </a>

                        {{-- <button type="button" class="btn btn-info btn__rounded float-right" style="font-size: 20px" data-toggle="modal" data-target="#create_room">
                            <i class="fa fa-plus"></i>สร้างไฟล์ modal
                        </button> --}}


                        <form method="GET" action="{{ url('/health_check') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="ค้นหา"
                                    value="{{ request('search') }}">

                                <span class="input-group-append">
                                    <button class="btn-old btn-info"  type="submit"
                                     style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px; border-color:#495057" >
                                         <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                         <!--/////// Modal หน้าสร้างไฟล์ ///////////-->

                         <div class="modal fade" id="create_room" tabindex="-1" role="dialog" aria-labelledby="create_roomTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <!-- หน้าสร้างไฟล์ -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="contact-panel col-md-12 mb-2">

                                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <div class="container">
                                                <h3 ><i class="fa-solid fa-home"></i> เพิ่มเอกสาร</h3>
                                                    <br />
                                                    <br />
                                                    @if ($errors->any())
                                                    <ul class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                    <form method="POST" action="{{ url('/health_check') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        @include ('health_check.form', ['formMode' => 'create'])

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--///////End Modal หน้าสร้างไฟล์ ///////////-->


                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เรื่อง</th>
                                        <th>Img 1</th>
                                        <th>Img 2</th>
                                        <th>Img 3</th>
                                        <th>รหัสผู้ใช้</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($health_check as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->img_1 }}</td>
                                            <td>{{ $item->img_2 }}</td>
                                            <td>{{ $item->img_3 }}</td>
                                            <td>{{ $item->user_id }}</td>
                                            <td>
                                                <a href="{{ url('/health_check/' . $item->id) }}"
                                                    title="View Health_check"><button class="btn-old btn-info btn-sm"><i
                                                            class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/health_check/' . $item->id . '/edit') }}"
                                                    title="Edit Health_check"><button class="btn-old btn-primary btn-sm"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form method="POST" action="{{ url('/health_check' . '/' . $item->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn-old btn-danger btn-sm"
                                                        title="Delete Health_check"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $health_check->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div> {{-- end container --}}
</section><!-- /.page-title -->


                    {{-- ////////////////////
                                มือถือ
                        /////////////////// --}}

<section class="page-title page-title-layout5 mb-3">
    <div class="container-fluid card radius-10 d-block d-lg-none"
        style="font-family: 'Baloo Bhaijaan 2', cursive;font-family: 'Prompt', sans-serif;">
        <div class="row">
            <div class="card-header border-bottom-0 bg-transparent">
                <div class="col-12" style="margin-top:10px">
                    <div>
                        <h5 class="font-weight-bold mb-1 ">จัดการผู้ใช้ / Manage users</h5>
                    </div>
                        <form method="GET" action="{{ url('/health_check') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right " role="search">
                            <div class="input-group">
                                <input type="text" class="form-control d" name="search" placeholder="ค้นหา"
                                    value="{{ request('search') }}">

                                <span class="input-group-append">
                                    <button class="btn-old btn-info"  type="submit"
                                    style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px; border-color:#495057" >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <button type="button" class="btn btn-info btn__rounded float-right" style="font-size: 20px" data-toggle="modal" data-target="#create_room">
                            <i class="fa fa-plus"></i>สร้างไฟล์
                        </button>
                        <button type="button" class="btn btn-info btn__rounded float-right" style="font-size: 20px" data-toggle="modal" data-target="#create_room">
                            <i class="fa fa-plus"></i>สร้างไฟล์ modal
                        </button>

                        <!--/////// Modal หน้าสร้างไฟล์ ///////////-->

                        <div class="modal fade" id="create_room" tabindex="-1" role="dialog" aria-labelledby="create_roomTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <!-- หน้าสร้างไฟล์ -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="contact-panel col-md-12 mb-2">

                                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <div class="container">
                                                <h3 ><i class="fa-solid fa-home"></i> เพิ่มเอกสาร</h3>
                                                    <br />
                                                    <br />
                                                    @if ($errors->any())
                                                    <ul class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                    <form method="POST" action="{{ url('/health_check') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        @include ('health_check.form', ['formMode' => 'create'])

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--///////End Modal หน้าสร้างไฟล์ ///////////-->

                </div>
            </div>

            <div class="card-body" style="padding: 0px 10px 0px 10px;">
                @foreach ($health_check as $item)
                    <div class="card col-12 d-block d-lg-none"
                        style="font-family: 'Prompt', sans-serif;border-radius: 25px;border-bottom-color:;margin-bottom: 10px;border-style: solid;border-width: 0px 0px 4px 0px;">
                        <center>
                            <div class="row col-12 card-body "
                                style="padding:15px 0px 15px 0px ;border-radius: 25px;margin-bottom: -2px;">
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;padding:0px"
                                    data-toggle="collapse" data-target="health_id{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <i class="bx bx-line text-success"></i>
                                </div>
                                <div class="col-8 collapsed" style="margin-bottom:0px;padding:0px" data-toggle="collapse"
                                    data-target="#health_id{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <h5 style="margin-bottom:0px; margin-top:0px; ">
                                        <a target="break">
                                            <i class="far fa-eye text-primary"></i></a>&nbsp;&nbsp;
                                        {{ $item->title }} {{-- // หัวข้อ // --}}
                                    </h5>
                                </div>
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;"
                                    data-toggle="collapse" data-target="#health_id{{ $item->id }}"
                                    aria-expanded="false" aria-controls="form_delete_11003308">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="col-12 collapse" id="health_id{{ $item->id }}" style="">
                                    <hr>
                                    <p style="font-size:18px;padding:0px"> รูป1
                                        <img src="{{ url('storage/'.$item->img_1 )}}" alt="background" loading="lazy" style="visibility: visible;">
                                    </p>
                                    <hr>
                                    <p style="font-size:18px;padding:0px"> รูป2
                                        <img src="{{ url('storage/'.$item->img_2 )}}" alt="background" loading="lazy" style="visibility: visible;">
                                    </p>
                                    <hr>
                                    <p style="font-size:18px;padding:0px"> รูป3
                                        <img src="{{ url('storage/'.$item->img_3 )}}" alt="background" loading="lazy" style="visibility: visible;">
                                    </p>
                                    <hr>
                                        <button href="#" style="font-size:18px;padding:0px" class="btn btn-sm btn-primary radius-30 mb-2">
                                            <i class="fa-solid fa-pen-to-square"></i> แก้ไข
                                        </button>
                                        <form method="POST" action="{{ url('/health_check' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            <button href="#" type="submit" onclick="return confirm('ต้องการลบหรือไม่')" style="font-size:18px;padding:0px" class="btn btn-sm btn-danger radius-30 mb-2">
                                                <i class="fa-solid fa-trash"></i> ลบ
                                            </button>
                                        </form>
                                </div>
                            </div>
                        </center>
                    </div>
                @endforeach

                <div class="pagination-wrapper"> </div>
            </div>
        </div>
    </div>
</section><!-- /.page-title -->
@endsection
