@extends('layouts.mithcare')

@section('content')
<style>
.modal {
  background: rgba(0, 0, 0, 0.5); 
}
.modal-backdrop {
  display: none;
}
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fa-solid fa-door-open"></i>ขอเข้าร่วม
</button>

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
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">ค้นหาบ้าน</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">ค้นหาบ้าน</a></li>
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

            <!--//////// Sidebar ////////-->
            @if(Auth::check() && Auth::user()->role == "isAdmin")
            @include('sidebar.admin_sidebar')
            @else
            @include('sidebar.user_sidebar')
            @endif
            <!--////// End Sidebar /////////-->

            <div class="contact-panel col-md-9 mb-2">
                <h2>ค้นหาบ้าน</h2>
                <div class="row">

                    <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 " role="search">
                        <input type="text" class="form-control" placeholder="Search...">
                        <!-- <button class="btn" type="submit"><i class="icon-search"></i></button> -->
                    </form>
                </div>
                <hr width="97%">

                <div class="container ">
                    <div class="row">
                        <div class="col-3 h5">ลำดับ</div>
                        <div class="col-3 h5">ชื่อบ้าน</div>
                        <div class="col-3 h5">ชื่อเจ้าของ</div>
                        <div class="col-3 h5">...</div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($room as $item)

                        <div class="col-3 h6">{{ $loop->iteration }}</div>
                        <div class="col-3 h6">{{ $item->name }}</div>
                        <div class="col-3 h6">ชื่อเจ้าของบ้าน</div>
                        <div class="col-3 h6">

                            <a href="{{ url('/room/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa-solid fa-door-open"></i>
                                    ขอเข้าร่วม</button></a>

                            

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <a href="{{ url('/room/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/room' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form> -->

                        </div>

                        @endforeach
                    </div>

                    <div class="pagination-wrapper"> {!! $room->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>



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
        