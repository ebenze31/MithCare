@extends('layouts.mithcare')

@section('content')

<style>
    .page-item{
        border-radius: 50%!important;
        padding: 5px;
    }
</style>

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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">ล็อบบี้</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">ล็อบบี้</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->


   {{--//////////////////
            Roomt RTC
     //////////////// --}}

     <div id="room_rtc_focus" class="container mt-3">
        <div class="row">
            <div class="col-6 ">
                @if(Auth::user()->role == 'isAdmin')
                    <!-- Button trigger modal -->
                    {{-- <a href="{{ url('/game/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2 mt-3" style="font-size: 20px;">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มเกมใหม่
                    </a> --}}
                @endif
            </div>
            <div class="col-6">
                {{-- <form method="GET" action="{{ url('/game') }}" accept-charset="UTF-8"
                class="form-inline my-2 my-lg-0 float-right " role="search">
                <div class="input-group mt-3">
                    <input type="text" class="form-control d" name="search" placeholder="ค้นหา"
                        value="{{ request('search') }}">

                    <span class="input-group-append">
                        <button class="btn-old btn-info"  type="submit"
                        style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px; border-color:#495057" >
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                </form> --}}
            </div>
        </div>
        <hr>
    </div>



<section  class="team-layout1 pb-40">
<div class="container">
    <div class="row">
        @foreach ($lobby_room as $item)
            <!-- Member #1 -->

                <div class="col-sm-6 col-md-4 col-lg-4" >
                    <div class="member" style="background-color: #c7e5e9" >
                        {{-- <form method="POST" id="click" action="{{ url('/game')}}"
                            accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }} --}}
                            <div class="member__img">
                                    <img src="{{ url('storage/'.$item->user->photo )}}" height="350px" width="100%" alt="member img" >
                            </div><!-- /.member-img -->
                            <div class="member__info">
                                {{-- <h4 class="member__name"><a href="{{$item->link}}" target="_blank" onclick="click_game('{{$item->id}}')">{{$item->name}}</a></h4> --}}
                                <p id="amount_id_{{$item->id}}" class="text-primary h5">ห้องสนทนาของ {{$item->user->name}}</p>
                                <hr>
                                @php
                                    $dataRoomRTC = App\Models\RoomRTC::where('room_id',$item->room_id)->where('room_of_members',$item->user_id)->first();
                                @endphp
                                @if ($dataRoomRTC !== null)
                                    @if (!empty($dataRoomRTC->current_people))
                                        <p id="showPeopleCurrent_{{$item->user_id}}" class="h5">จำนวนคนในห้อง : {{ $dataRoomRTC->current_people }}</p>
                                    @else
                                        <p id="showPeopleCurrent_{{$item->user_id}}" class="h5">จำนวนคนในห้อง : 0</p>
                                    @endif
                                @else
                                    <p id="showPeopleCurrent_{{$item->user_id}}" class="h5">ยังไม่เคยเริ่มการสนทนา</p>
                                @endif


                            </div><!-- /.member-info -->
                            <center>
                                <a class="btn-old btn-info m-2 col-9" href="{{ url('/room_call'. '/' . $item->room_id . '/' . $item->user_id) }}">เข้าร่วมห้องสนทนา</a>
                            </center>
                    </div><!-- /.member -->
                    </a>
                </div><!-- /.col-lg-4 -->


        @endforeach
    </div><!-- /.row -->
      <div class="pagination" > {!! $lobby_room->appends(['search' => Request::get('search')])->render() !!}  </div>

        <nav class="pagination-area">
            <ul class="pagination justify-content-center">
                {{-- <li><a href="#"><i class="icon-arrow-left"></i></a></li>
                <li><a class="current" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#"><i class="icon-arrow-right"></i></a></li> --}}
            </ul>
        </nav>

</div><!-- /.container -->
</section>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    // console.log("START");
    window.location.hash = '#room_rtc_focus';

    });
    // window.addEventListener("DOMContentLoaded", document, false);
</script>

<script>
    setInterval(() => {

        const urlCheckPeople = "{{ url('/') }}/api/urlCheckPeople?room_id=" + '{{$room_id}}' ;
        axios.get(urlCheckPeople).then((response) => {
            // console.log(response['data']);
            for (let item of response['data']) {
                // console.log(item.room_of_members);
                document.querySelector('#showPeopleCurrent_' + item.room_of_members).innerHTML = "จำนวนคนในห้อง : " + item.current_people;
            }
        })
        .catch((error) => {
            console.log("ERROR HERE");
            console.log(error);
        });

    }, 5000);
</script>

@endsection


