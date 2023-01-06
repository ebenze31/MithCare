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
                    <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">{{$user->full_name}}</a></h2>
                  
                  </div><!-- /.member-info -->
                </div><!-- /.member -->
              </div><!-- /.widget-member -->

              <form method="POST" action="{{ url('/profile/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                        <div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
                          <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
                          <div class="widget-content">
                            <!-- <div class="widget__icon">
                              <i class="icon-call3"></i>
                            </div> -->
                            <h2 class="widget__title" style="font-size: 30px;">บัตร 1</h2>
                          
                            <div class="form-group ">
                                  <input class="form-control" name="health_card_1" type="file" id="health_card_1" value="" >
                            </div>        
                                  
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

                      </aside><!-- /.sidebar -->
                    </div><!-- /.col-lg-4 -->
                    <div class="col-sm-12 col-md-12 col-lg-8">
                      
                      <ul class="details-list list-unstyled mb-60 mt-40">    

                            @include ('profile.profile_form', ['formMode' => 'edit'])

                </form> <!--form edit_profile -->
            </ul><!-- /.widget-content -->
             
           

          
            
          </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>

@endsection