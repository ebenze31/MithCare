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
        <a href="{{ url('/room/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
            <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่</a>
        <a href="{{ url('/room_join') }}" class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
            <i class="fa-solid fa-right-to-bracket"></i>ค้นหาบ้าน</a>
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
                @foreach($room as $item)
                <div class="card col-4 ">
                    <img class="card-img-top mt-3" src="{{asset('/img/logo_mithcare/portrait-volunteer-who-organized-donations-charity.jpg')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ url('/room/' . $item->id) }}" class="btn-old btn-info btn-sm btn-block main-shadow main-radius">                                
                                    <i class="fa-solid fa-magnifying-glass"></i> รายละเอียด        
                                </a>
                            </div>
                            <div class="col-6">
                                <button class="btn-old btn-success btn-sm btn-block main-shadow main-radius">ตารางนัด</button>
                            </div>
                        </div>
                        <p class="text-center main-shadow main-radius btn-block mt-2 p-2" style="background-color:#407CAB; color:#ffffff; font-size:18px">{{$item->name}}</p>
                        <p style="font-size: 13px;">เจ้าของบ้าน : {{$item->user->name}}</p>
                        <hr>
                        @if(Auth::user()->id == $item->owner_id)
             
                        <div class="row">
                            <div class="col-12">
                                <i data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="fa-solid fa-caret-down" style="font-size: 30px; float: right"></i>
                            </div>
                            <div class="collapse col-12" id="collapseExample">
                                <div class="row mr-2">

                                    <a href="{{ url('/room/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn-old btn-primary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i></button></a>

                                    <form method="POST" action="{{ url('/room' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn-old btn-danger btn-sm" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>               
                        @endif
                    </div><!--  card-body -->
                </div><!--  card -->
                @endforeach
                <div class="pagination-wrapper"> {!! $room->appends(['search' => Request::get('search')])->render() !!} </div>
               
            </div> <!-- contact-panel -->

        </div>
    </div>
</section>

@endsection














<!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">Room</div>
                <div class="card-body">
                    <a href="{{ url('/room/create') }}" class="btn btn-success btn-sm" title="Add New Room">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="row">
                        <ul > 
                            <li>

                                <a>#</a><a>Name</a><a>Pass</a><a>Actions</a>

                            </li>
                            <li>
                                @foreach($room as $item)
                                <tr>
                                    <a>{{ $loop->iteration }}</a>
                                    <a>{{ $item->name }}</a>
                                    <a>{{ $item->pass }}</a>
                                    <a>
                                        <a href="{{ url('/room/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/room/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/room' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </a>
                                </tr>
                                @endforeach
                            </li>
                        </ul>
                        </div>
                        <div class="pagination-wrapper"> {!! $room->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div> -->