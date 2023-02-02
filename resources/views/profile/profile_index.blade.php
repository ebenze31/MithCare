@extends('layouts.mithcare')

@section('content')

<!-- ========================
       page title
    =========================== -->
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
              <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 30px;">โปรไฟล์</a></li>
            </ol>
          </div> <!--d-none d-lg-block -->
          <!-- แสดงเฉพาะมือถือ -->
          <div class="d-block d-md-none">
            <ol class=" breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 20px;">โปรไฟล์</a></li>
            </ol>
          </div> <!--d-block d-md-none -->
        </nav>
      </div><!-- /.col-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="pt-120 pb-80">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-4">
        <aside class="sidebar has-marign-right">
          <div class="widget widget-member">
            <div class="member mb-0">
              <div class="member__img">
                {{-- @if (!empty($user->photo))
                    <a href="{{ $user->avatar }}" class="glightbox play-btn mb-4">
                        <img src="{{ url('storage/'.$user->photo )}}" alt="member img" height="300px" width="100%">
                    </a>
                @else
                    <img src="https://www.viicheck.com/Medilab/img/icon.png" alt="member img" height="300px" width="100%">
                @endif --}}
                @if(!empty($user->avatar) and empty($user->photo))
                <a href="{{ $user->avatar }}" class="glightbox play-btn mb-4">
                    <img alt="member img" height="300px" width="100%" src="{{ $user->avatar }}" data-original-title="Usuario">
                </a>
                @endif
                @if(!empty($user->photo))
                    <a href="{{ url('storage')}}/{{ $user->photo }}" class="glightbox play-btn mb-4">
                        <img alt="member img" height="300px" width="100%" src="{{ url('storage')}}/{{ $user->photo }}" data-original-title="Usuario">
                    </a>
                @endif
                @if(empty($user->avatar) and empty($user->photo))
                    <img alt="member img" height="300px" width="100%" src="https://www.viicheck.com/Medilab/img/icon.png" data-original-title="Usuario">
                @endif
              </div><!-- /.member-img -->
              <div class="member__info">
                <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">{{$user->full_name}}</a></h2>

                <a class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10 main-shadow"
                    style="font-size: 20px; color:#ffffff;" href="{{ url('/profile/'. $user->id . '/edit') }}">แก้ไขโปรไฟล์
                </a>

              </div><!-- /.member-info -->
            </div><!-- /.member -->
          </div><!-- /.widget-member -->

            <div class="card main-shadow main-radius mt-3  ">
                <!-- /.zoom_picture-only-pc -->
                <div class="product__img main-radius d-none d-lg-block">
                    @if (!empty($user->health_card_1))
                    <img src="{{ url('storage/'.$user->health_card_1 )}}" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                @else
                    <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                @endif
                </div>
                <!-- /.-only-mobile -->
                <div class="d-block d-md-none">
                    @if (!empty($user->health_card_1))
                        <img src="{{ url('storage/'.$user->health_card_1 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                    @else
                        <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                    @endif
                </div>

            </div><!-- /.card -->

            <div class="card main-shadow main-radius mt-3  ">
                <!-- /.zoom_picture-only-pc -->
                <div class="product__img d-none d-lg-block">
                    @if (!empty($user->health_card_2))
                        <img src="{{ url('storage/'.$user->health_card_2 )}}" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                    @else
                        <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                    @endif
                </div>

                <!-- /.-only-mobile -->
                <div class="d-block d-md-none">
                    @if (!empty($user->health_card_2))
                        <img src="{{ url('storage/'.$user->health_card_2 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                    @else
                        <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                    @endif
                </div>

            </div><!-- /.card -->

            <div class="card main-shadow main-radius mt-3 ">
                <!-- /.zoom_picture-only-pc -->
                <div class="product__img d-none d-lg-block">
                    @if (!empty($user->health_card_3))
                    <img src="{{ url('storage/'.$user->health_card_3 )}}" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                @else
                    <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                @endif
                </div>

                <!-- /.-only-mobile -->
                <div class="d-block d-md-none">
                    @if (!empty($user->health_card_3))
                        <img src="{{ url('storage/'.$user->health_card_3 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                    @else
                        <img alt="member img" height="200px" width="100%" src="{{ url('/img/logo_mithcare/nation_card.png') }}" data-original-title="Usuario">
                    @endif
                </div>

            </div><!-- /.card -->


        </aside><!-- /.sidebar -->
      </div><!-- /.col-lg-4 -->
      <div class="col-sm-12 col-md-12 col-lg-8">

        <ul class="details-list list-unstyled mb-60 mt-40">
          <li>
            <h5 class="details__title" style="font-size: 25px;">ชื่อเล่น</h5>
            <div class="details__content">
              <p class="mb-0" style="font-size: 25px;">{{ $user->name}}</p>
            </div>
          </li>
          <li>
            <h5 class="details__title" style="font-size: 25px;">อีเมล</h5>
            <div class="details__content">
              <p class="mb-0" style="font-size: 25px;">{{ $user->email}}</p>
            </div>
          </li>
          <li>
            <h5 class="details__title" style="font-size: 25px;">วันเกิด</h5>
            <div class="details__content">
              <p class="mb-0" style="font-size: 25px;">{{ $user->birthday}}</p>
            </div>
          </li>
          <li>
            <h5 class="details__title" style="font-size: 25px;">เพศ</h5>
            <div class="details__content">
              <p class="mb-0" style="font-size: 25px;">{{$user->gender}}</p>
            </div>
          </li>
          <li>
            <h5 class="details__title" style="font-size: 25px;">ที่อยู่</h5>
            <div class="details__content">
              @if(!empty($user->province))
              <p class="mb-0" style="font-size: 25px;">{{$user->address}} ต.{{$user->sub_district}} อ.{{$user->district}} จ.{{$user->province}} </p>
              @else
              <p class="mb-0" style="font-size: 25px;"></p>
              @endif
            </div>
          </li>
          <!-- <li>
                <h5 class="details__title">เพศ</h5>
                <div class="details__content">
                  <ก class="list-items list-items-layout2 list-unstyled mb-0">
                    <li>Cardiac Imaging – Non-invasive.</li>
                    <li>Cardiac Rehabilitation and Exercise.</li>
                    <li>Hypertrophic Cardiomyopathy.</li>
                    <li>Inherited Heart Diseases.</li>
                  </ก>
                </div>
              </li> -->

          <div class="widget widget-help bg-secondary mt-40 main-shadow">
            <div class="bg-img"><img src="#" alt="background"></div>
              <div class="row">
                <h2 style="color: #ffffff;" class="col-10 ">ครอบครัวของฉัน</h2>

                    <li class="nav__item has-dropdown col-6" >
                        <ul class="dropdown-menu">

                                <a href="{{ url('/room') }}" class="nav__item-link">บ้านของฉัน</a>

                        </ul><!-- /.dropdown-menu -->
                    </li><!-- /.nav-item -->
              </div><!-- row -->

              <ul class="widget-content">
                <li class="widget__title">บ้านที่ 1</li>
                <li class="widget__title">บ้านที่ 2</li>
                <li class="widget__title">บ้านที่ 3</li>
              </ul><!-- /.widget-content -->
          </div><!-- /.widget-help -->



      </div><!-- /.col-lg-8 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>

@endsection
