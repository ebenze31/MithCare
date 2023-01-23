@extends('layouts.admin.main')

@section('content')
<div class="row">
    {{-- @include('admin.sidebar') --}}
    <div class="col-md-12">

                <section class="page-title page-title-layout5 p-3">
                    <div class="">
                        <div class="row">

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

                                    @foreach($room as $item)
                                    <div class="col-md-4 col-sm-12 mt-2">
                                        <div class="card product-item ">
                                        @if(!empty($item->home_pic))
                                            <img class="card-img-top p-3 " src="{{ url('storage/'.$item->home_pic )}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                                        @else
                                            <img class="card-img-top p-3 " src="{{asset('/img/logo_mithcare/home-background.png')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                                        @endif
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{ url('/room/' . $item->id) }}" class="btn btn-info btn-sm btn-block main-shadow main-radius">
                                                            <!-- <i class="fa-solid fa-magnifying-glass"></i>  -->
                                                            รายละเอียด
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{ url('/appoint/') }}?room_id={{ $item->id }}" class="btn btn-success btn-sm btn-block main-shadow main-radius">
                                                           ตารางนัด
                                                        </a>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                        <p class="pricing__title text-center mt-2 p-2 h3" style="color: #4170A2;">{{$item->name}}</p>
                                                        <p style="font-size: 20px;">เจ้าของบ้าน : {{ $item->user->name }}</p>
                                                        <hr>
                                                    </div>
                                                </div>

                                                @if(Auth::user()->id == $item->owner_id)

                                                <div class="row">


                                                    <div class="col-12">
                                                        <a data-toggle="collapse" href="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample{{$item->id}}" class="btn btn-info text-white p-1" style="float: right;">
                                                            เพิ่มเติม <i class="fa-solid fa-caret-down"></i>
                                                        </a>

                                                    </div>

                                                    <div class="col-12 mt-2">
                                                        <div class="collapse" id="collapseExample{{$item->id}}">
                                                            <br>
                                                            <div class="row ">
                                                                <div class="col-6 p-0 text-center">
                                                                    <a href="{{ url('/room/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm main-radius main-shadow">
                                                                        <i class="fa-solid fa-pen-to-square"></i> แก้ไขบ้าน
                                                                    </a>
                                                                </div>
                                                                <div class="col-6 p-0 text-center">
                                                                    <form method="POST" action="{{ url('/room' . '/' . $item->id) }}" accept-charset="UTF-8">
                                                                        {{ method_field('DELETE') }}
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-danger btn-sm main-shadow main-radius" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')">
                                                                            <i class="fa-solid fa-trash"></i> ลบบ้าน
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div><!--  card-body -->
                                        </div><!--  card -->
                                    </div>
                                    @endforeach
                                </div>
                                <div class="pagination-wrapper"> {!! $room->appends(['search' => Request::get('search')])->render() !!} </div>

                            </div> <!-- contact-panel -->

                        </div>
                    </div>
                </section>

    </div>
</div>

@endsection



