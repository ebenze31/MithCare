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
            <h1 class="pagetitle__heading" >User Name</h1>
            <nav>
                <!-- แสดงเฉพาะคอม -->
               <div class="d-none d-lg-block"> 
                  <ol class=" breadcrumb mb-0 ">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 30px;">โปรไฟล์</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/profile/edit')}}" style="font-size: 30px;">แก้ไขโปรไฟล์</a></li>  
                  </ol>
                </div> <!--d-none d-lg-block -->

                <!-- แสดงเฉพาะมือถือ -->
                <div class="d-block d-md-none">
                  <ol class=" breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 20px;">โปรไฟล์</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/profile/edit')}}" style="font-size: 30px;">แก้ไขโปรไฟล์</a></li>   
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
                    <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">ชื่อ สกุล</a></h2>
                    <!-- <button class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10" style="font-size: 20px;">แก้ไขโปรไฟล์</button> -->
                    <!-- <p class="member__job">Cardiology Specialist</p>
                    <p class="member__desc">Brian specializes in treating skin, hair, nail, and mucous membrane. He also
                      address cosmetic issues, helping to revitalize the appearance of the skin</p> -->
                    <!-- <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <ul class="social-icons list-unstyled mb-0">
                        <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i>แก้ไขโปรไฟล์</a></li>
                        <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="phone"><i class="fas fa-phone-alt"></i></a></li>
                      </ul> 
                    </div> -->
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
                    <i class="icon-detail" ></i> <span>Details</span>
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

              <div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
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



              <!-- <div class="widget widget-schedule">
                <div class="widget-content">
                  <div class="widget__icon">
                    <i class="icon-charity2"></i>
                  </div>
                  <h4 class="widget__title">Opening Hours</h4>
                  <ul class="time__list list-unstyled mb-0">
                    <li><span>Monday - Friday</span><span>8.00 - 7:00 pm</span></li>
                    <li><span>Saturday</span><span>9.00 - 10:00 pm</span></li>
                    <li><span>Sunday</span><span>10.00 - 12:00 pm</span></li>
                  </ul>
                </div>/.widget-content
              </div>/.widget-schedule -->
              <!-- <div class="widget widget-reports">
                <a href="#" class="btn btn__primary btn__block">
                  <i class="icon-pdf-file"></i>
                  <span>2020 Patient Reports</span>
                </a>
              </div> -->
            </aside><!-- /.sidebar -->
          </div><!-- /.col-lg-4 -->
          <div class="col-sm-12 col-md-12 col-lg-8">
            
            <ul class="details-list list-unstyled mb-60 mt-40">
                <form method="POST" action="{{ url('/profile/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('profile.profile_form', ['formMode' => 'edit'])

                </form> <!--form edit_profile -->
            </ul><!-- /.widget-content -->
             
           

          
            
          </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>

@endsection