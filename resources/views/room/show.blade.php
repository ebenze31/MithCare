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
                                <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">บ้านของฉัน</a></li>
                            </ol>
                        </div> <!--d-none d-lg-block -->
                        <!-- แสดงเฉพาะมือถือ -->
                        <div class="d-block d-md-none">
                            <ol class=" breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                                <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">บ้านของฉัน</a></li>
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
                
                    <h3 >บ้านไอดีที่ {{ $room->id }} ของฉัน</h3>
                    <div class="h5">
                    <a href="#" onclick="goBack()"><button class="btn btn-info btn-sm main-shadow main-radius"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/room/' . $room->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm main-shadow main-radius"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('room' . '/' . $room->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm main-shadow main-radius" title="Delete Room" onclick="return confirm('ต้องการลบใช่ไหม')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $room->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $room->name }} </td></tr><tr><th> Pass </th><td> {{ $room->pass }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection
