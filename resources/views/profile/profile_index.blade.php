@extends('layouts.mithcare')

@section('content')

<!-- ========================
       page title 
    =========================== -->
<section class="page-title page-title-layout5">
  <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง.png')}}" width="90%" alt="background"></div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="pagetitle__heading">{{$user->name}}</h1>
        <nav>
          <!-- แสดงเฉพาะคอม -->
          <div class="d-none d-lg-block">
            <ol class=" breadcrumb mb-0 ">
              <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 30px;">Profile</a></li>
            </ol>
          </div> <!--d-none d-lg-block -->25
          <!-- แสดงเฉพาะมือถือ -->
          <div class="d-block d-md-none">
            <ol class=" breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 20px;">Profile</a></li>
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
                <img src="{{asset('/img/logo_mithcare/portrait-volunteer-who-organized-donations-charity.jpg')}}" alt="member img">
              </div><!-- /.member-img -->
              <div class="member__info">
                <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">{{$user->full_name}}</a></h2>
                <button class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10 main-shadow ">
                  <a style="font-size: 20px; color:#ffffff;" href="{{ url('/profile/'. $user->id . '/edit') }}">แก้ไขโปรไฟล์</a>
                </button>

              </div><!-- /.member-info -->
            </div><!-- /.member -->
          </div><!-- /.widget-member -->
          <div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
            <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
            <div class="widget-content">
              <!-- <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div> -->
              <h2 class="widget__title" style="font-size: 30px;">บัตร 1</h2>
              <!-- <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p> -->
              <a href="tel:+201061245741" class="phone__number">
                <i class="icon-detail"></i> <span>Details</span>
              </a>
            </div><!-- /.widget-content -->
          </div><!-- /.widget-help -->

          <div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
            <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
            <div class="widget-content">
              <!-- <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div> -->
              <h2 class="widget__title" style="font-size: 30px;">บัตร 2</h2>
              <!-- <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p> -->
              <a href="tel:+201061245741" class="phone__number">
                <i class="icon-detail"></i> <span>Details</span>
              </a>
            </div><!-- /.widget-content -->
          </div><!-- /.widget-help -->

          <div class="widget widget-help bg-overlay bg-overlay-primary-gradient main-radius">
            <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
            <div class="widget-content">
              <!-- <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div> -->
              <h2 class="widget__title" style="font-size: 30px;">บัตร 3</h2>
              <!-- <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p> -->
              <a href="tel:+201061245741" class="phone__number">
                <i class="icon-detail"></i> <span>Details</span>
              </a>
            </div><!-- /.widget-content -->
          </div><!-- /.widget-help -->


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
              <p class="mb-0" style="font-size: 25px;">{{$user->birthday}}</p>
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
              <p class="mb-0" style="font-size: 25px;">{{$user->address}} {{$user->sub_district}} {{$user->district}} {{$user->province}} </p>
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

          <div class="widget widget-help bg-secondary mt-40">
            <div class="bg-img"><img src="#" alt="background"></div>
            <h2 style="color: #ffffff;">จัดการบ้าน</h2>
            <ul class="widget-content">
              <!-- <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div> -->
              <li class="widget__title">ลูกบ้าน1</li>
              <li class="widget__title">ลูกบ้าน1</li>
              <li class="widget__title">ลูกบ้าน1</li>
              <!-- <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p> -->
              <!-- <a href="tel:+201061245741" class="phone__number">
                    <i class="icon-detail"></i> <span>สมาชิกในบ้าน</span>
                  </a> -->
              </ี><!-- /.widget-content -->
          </div><!-- /.widget-help -->



      </div><!-- /.col-lg-8 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>

@endsection