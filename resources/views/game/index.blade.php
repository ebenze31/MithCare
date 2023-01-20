@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">///</h1>
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


   {{--//////////////////
            Game
     //////////////// --}}
<section class="page-title page-title-layout5">
     <div class="container mt-3">
        @if(Auth::user()->role == 'isAdmin')
            <div class="row d-flex justify-content-end ">
                <!-- Button trigger modal -->

                <a href="{{ url('/game/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                    <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่
                </a>
            </div>
        @endif
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
</section><!-- /.page-title -->

<section class="team-layout1 pb-40">
    <div class="container">
      <div class="row">
        @foreach ($game as $item)
            <!-- Member #1 -->
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="member" style="background-color: #c7e5e9">
                    <div class="member__img">
                        <img src="{{ url('storage/'.$item->img )}}" height="350px" width="100%" alt="member img">
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
                        <h5 class="member__name"><a href="doctors-single-doctor1.html">{{$item->name}}</a></h5>
                        <p class="text-primary">จำนวนครั้งที่เล่น : {{$item->amount_click}}</p>
                        <p class="member__desc">รายละเอียดเกม Muldoone obtained his undergraduate degree in Biomedical Engineering at Tulane
                        University prior to attending St George's University School of Medicine</p>
                    </div><!-- /.member-info -->
                </div><!-- /.member -->
            </div><!-- /.col-lg-4 -->
        @endforeach
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
@endsection
