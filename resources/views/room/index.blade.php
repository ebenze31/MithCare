@extends('layouts.mithcare')

@section('content')



<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">{{$user->name}}</h1>
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

<div class="container mt-3">
    <div class="row d-flex justify-content-end ">
        <!-- Button trigger modal -->
        <a class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px; color:#ffffff;" id="btn_create_room" data-toggle="modal" data-target="#create_room">
            <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่
        </a>
        <!-- <a href="{{ url('/room/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
            <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่</a> -->
        <a href="{{ url('/room_join') }}" class="btn btn-primary btn-sm main-shadow main-radius mr-2" style="font-size: 20px;" id="btn_find_room" data-toggle="modal" data-target="#join_room">
            <i class="fa-solid fa-right-to-bracket"></i>ขอเข้าร่วม</a>


        <!--/////// Modal หน้าสร้างบ้าน ///////////-->

        <div class="modal fade" id="create_room" tabindex="-1" role="dialog" aria-labelledby="create_roomTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- หน้าสร้างบ้าน -->
                    <div class="container">
                        <div class="row">
                            <div class="contact-panel col-md-12 mb-2">

                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <div class="container">
                                <h3 ><i class="fa-solid fa-home"></i> สร้างบ้านใหม่</h3>
                                    <br />
                                    <br />
                                    @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                    <form method="POST" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        @include ('room.form_create')

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--///////End Modal หน้าสร้างบ้าน ///////////-->

        <!--/////// Modal เข้าร่วมบ้าน ///////////-->

          <div class="modal fade" id="join_room" tabindex="-1" role="dialog" aria-labelledby="join_roomTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- หน้าสร้างบ้าน -->
                    <div class="container">
                        <div class="row">
                            <div class="contact-panel col-md-12 mb-2">
                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>


                                <div class="container">
                                    <h3><i class="fa-solid fa-right-to-bracket"></i> เข้าร่วมบ้าน</h3>
                                    {{-- <a href="#" onclick="goBack()">
                                        <button class="btn btn-info btn-sm main-shadow main-radius" style="font-size: 20px;">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ
                                        </button>
                                    </a> --}}
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
                </div>
            </div>
        </div>
        <!--///////End Modal เข้าร่วมบ้าน ///////////-->
    </div>
</div>

<section class="page-title page-title-layout5 p-3">
    <div class="container">
        <div class="row">

            <!--//////// Sidebar ////////-->

            <!--////// End Sidebar /////////-->


            <div class="contact-panel col-md-12 mb-2">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <h2>บ้านของฉัน</h2>
                    </div>
                    <div class=" col-md-4 col-12">
                        <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right d-block" role="search">
                            <input type="text" class="form-control" placeholder="Search...">
                            <!-- <button class="btn" type="submit"><i class="icon-search"></i></button> -->
                        </form>
                    </div>
                </div>
                <hr width="97%">
                <div class="row">


                    @foreach($my_room as $item)
                    <div class="col-md-4 col-sm-12">
                        <div class="card product-item ">
                        @if(!empty($item->room->home_pic))
                            <img class="card-img-top p-3 " src="{{ url('storage/'.$item->room->home_pic )}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                        @else
                            <img class="card-img-top p-3 " src="{{asset('/img/logo_mithcare/home-background.png')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                        @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ url('/room/' . $item->room->id) }}" class="btn-old btn-info btn-sm btn-block main-shadow main-radius">
                                            <!-- <i class="fa-solid fa-magnifying-glass"></i>  -->
                                            รายละเอียด
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        @if (!empty($type))
                                            <a href="{{ url('/appoint/') }}?room_id={{ $item->room->id }}&type={{$type}}" class="btn-old btn-primary btn-sm btn-block main-shadow main-radius">
                                                ตารางนัด
                                            </a>
                                        @else
                                            <a href="{{ url('/appoint/') }}?room_id={{ $item->room->id }}" class="btn-old btn-primary btn-sm btn-block main-shadow main-radius">
                                                ตารางนัด
                                            </a>
                                        @endif

                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <p class="pricing__title text-center mt-2 p-2 h3" style="color: #4170A2;">{{$item->room->name}}</p>
                                        @php
                                            $data_room = \App\Models\Room::where('id',$item->room_id)->first();
                                        @endphp
                                        <p style="font-size: 20px;">เจ้าของบ้าน : {{ $data_room->user->name }}</p>
                                        <hr>
                                    </div>
                                </div>



                                @if(Auth::user()->id == $item->room->owner_id)

                                <div class="row">


                                    <div class="col-12">
                                        <a data-toggle="collapse" href="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample{{$item->id}}" class="btn-old btn-info text-white" style="float: right;">
                                            เพิ่มเติม <i class="fa-solid fa-caret-down"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 mt-5">
                                        <div class="collapse" id="collapseExample{{$item->id}}">
                                            <br>
                                            <div class="row">
                                                <div class="col-6 p-0">
                                                    <a href="{{ url('/room/' . $item->room->id . '/edit') }}" class="btn-old btn-sm main-radius main-shadow">
                                                        <i class="fa-solid fa-pen-to-square"></i> แก้ไขบ้าน
                                                    </a>
                                                </div>
                                                <div class="col-6 p-0">
                                                    {{-- <form method="POST" action="{{ url('/room' . '/' . $item->room->id) }}" accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn-old btn-danger btn-sm main-shadow main-radius" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')">
                                                            <i class="fa-solid fa-trash"></i> ยืนยัน
                                                        </button>
                                                    </form> --}}

                                                    <button data-toggle="modal" data-target="#room_delete"
                                                    class="btn-old btn-danger btn-sm main-shadow main-radius" title="Delete Room">
                                                        <i class="fa-solid fa-trash"></i> ลบบ้าน
                                                    </button>

                                                    <div class="modal fade" id="room_delete" tabindex="-1" role="dialog" aria-labelledby="room_delete" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- หน้าสร้างบ้าน -->
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="contact-panel col-md-12 mb-2">

                                                                            <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>

                                                                            <div class="container">
                                                                            <h5 class="text-warning"><i class="fa-solid fa-warning"></i> ท่านต้องการลบบ้านหรือไม่</h5>
                                                                            <br>
                                                                            <br>

                                                                            <div class="row justify-content-between">
                                                                                <form method="POST" action="{{ url('/room' . '/' . $item->room->id) }}" accept-charset="UTF-8">
                                                                                    {{ method_field('DELETE') }}
                                                                                    {{ csrf_field() }}
                                                                                    <button type="submit" class="btn-old btn-secondary btn-sm main-shadow main-radius" title="Delete Room" >
                                                                                        <i class="fa-solid fa-trash"></i> ยืนยัน
                                                                                    </button>
                                                                                </form>

                                                                                <button type="submit" class="btn-old btn-primary btn-sm main-shadow main-radius" data-dismiss="modal" aria-label="Close">
                                                                                    <i class="fa-solid fa-arrow"></i> ยกเลิก
                                                                                </button>
                                                                            </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div><!--  card-body -->
                        </div><!--  card -->
                    </div><!--  col-md-4 col-sm-12 -->
                    @endforeach
                </div>
                <div class="pagination-wrapper"> {!! $my_room->appends(['search' => Request::get('search')])->render() !!} </div>

            </div> <!-- contact-panel -->

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");

        if('{{$check_url}}' == 'create_room'){
            document.querySelector('#btn_create_room').click();
        }else if('{{$check_url}}' == 'find_room'){
            document.querySelector('#btn_find_room').click();
        }

    });
</script>

@endsection





