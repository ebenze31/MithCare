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
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">GAME</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">GAME</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->


   {{--//////////////////
            Game
     //////////////// --}}

     <div class="container mt-3">
        <div class="row">
            <div class="col-6 ">
                @if(Auth::user()->role == 'isAdmin')
                    <!-- Button trigger modal -->
                    <a href="{{ url('/game/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2 mt-3" style="font-size: 20px;">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่
                    </a>
                @endif
            </div>
            <div class="col-6">
                <form method="GET" action="{{ url('/game') }}" accept-charset="UTF-8"
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
                </form>
            </div>
        </div>
        <hr>
    </div>



<section class="team-layout1 pb-40">
    <div class="container">
      <div class="row">
        @foreach ($game as $item)
            <!-- Member #1 -->
            <div class="col-sm-6 col-md-4 col-lg-4" >
                <div class="member" style="background-color: #c7e5e9" >
                    {{-- <form method="POST" id="click" action="{{ url('/game')}}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ csrf_field() }} --}}
                        <div class="member__img">
                                <img src="{{ url('storage/'.$item->img )}}" height="350px" width="100%" alt="member img" ><a href="{{$item->link}}"></a>
                            <div class="member__hover">
                            @if(Auth::user()->role == 'isAdmin')
                                <ul class="social-icons list-unstyled mb-0">
                                    <li><a href="{{ url('/game/'. $item->id . '/edit') }}" class="facebook"><i class="fa-solid fa-pen-to-square"></i></a></li>
                                    {{-- <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" class="phone"><i class="fas fa-phone-alt"></i></a></li> --}}
                                </ul><!-- /.social-icons -->
                            @endif
                            </div><!-- /.member-hover -->
                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <h4 class="member__name"><a  href="{{$item->link}}" target="_blank">{{$item->name}}</a></h4>
                    {{-- </form> --}}
                            <p class="text-primary h5">จำนวนครั้งที่เล่น : {{$item->amount_click}}</p>
                            <hr>
                            <p class="h5">{{$item->detail_of_game}}</p>
                        </div><!-- /.member-info -->
                </div><!-- /.member -->
            </div><!-- /.col-lg-4 -->
        @endforeach
      </div><!-- /.row -->
      <div class="pagination-wrapper">  {!! $game->appends(['search' => Request::get('search')])->render() !!} </div>

        {{-- <nav class="pagination-area">
            <ul class="pagination justify-content-center">
                <li><a href="#"><i class="icon-arrow-left"></i></a></li>
                <li><a class="current" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#"><i class="icon-arrow-right"></i></a></li>
            </ul>
        </nav> --}}

    </div><!-- /.container -->
  </section>
@endsection
