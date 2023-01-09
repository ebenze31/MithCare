@extends('layouts.mithcare')

@section('content')
<section class="page-title page-title-layout5">
<div class="container">
    <div class="row">

        <!--//////// Sidebar ////////-->
             @include('admin.sidebar')
        <!--////// End Sidebar /////////-->

        <div class="contact-panel col-md-9 mb-2">
            <h2>ค้นหาบ้าน</h2>
            <div class="row">
              
                <form  method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 " role="search">
                    <input type="text" class="form-control" placeholder="Search...">
                    <!-- <button class="btn" type="submit"><i class="icon-search"></i></button> -->
                </form>
            </div>
                <hr width="97%">
                  
                <div class="container ">
                        <div class="row">               
                                <div class="col-3 h5">ลำดับ</div>
                                <div class="col-3 h5">ชื่อ</div>
                                <div class="col-3 h5">Pass</div>
                                <div class="col-3 h5">...</div>
                        </div>
                        <hr>
                        <div class="row">
                                @foreach($room as $item)
                               
                                    <div class="col-3 h6">{{ $loop->iteration }}</div>
                                    <div class="col-3 h6">{{ $item->name }}</div>
                                    <div class="col-3 h6">{{ $item->pass }}</div>
                                    <div class="col-3 h6">
                                                                    
                                        <a href="{{ url('/room/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true">                             
                                        </i> View</button></a>

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