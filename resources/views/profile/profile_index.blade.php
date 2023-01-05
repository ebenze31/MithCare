@extends('layouts.mithcare')

@section('content')

     <!-- ========================
       page title 
    =========================== -->
    <section class="page-title page-title-layout5">
      <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง.png')}}" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="pagetitle__heading">User Name</h1>
            <nav>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <!-- <li class="breadcrumb-item active" aria-current="page">Ahmed Abdallah</li> -->
              </ol>
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
                    <h5 class="member__name text-center"><a href="#">ชื่อ สกุล</a></h5>
                    <button class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10">แก้ไขโปรไฟล์</button>
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
                  <h2 class="widget__title">บัตร 1</h2>
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
                  <h2 class="widget__title">บัตร 2</h2>
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
                  <h2 class="widget__title">บัตร 3</h2>
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
              <li>
                <h5 class="details__title">ชื่อเล่น</h5>
                <div class="details__content">
                  <p class="mb-0">User Name</p>
                </div>
              </li>
              <li>
                <h5 class="details__title">อีเมล</h5>
                <div class="details__content">
                  <p class="mb-0">lnwza@gmai.com</p>
                </div>
              </li>       
              <li>
                <h5 class="details__title">วันเกิด</h5>
                <div class="details__content">
                  <p class="mb-0">12/12/2541</p>
                </div>
              </li>
              <li>
                <h5 class="details__title">เพศ</h5>
                <div class="details__content">
                  <p class="mb-0">หญิง</p>
                </div>
              </li>
              <li>
                <h5 class="details__title">ที่อยู่</h5>
                <div class="details__content">
                  <p class="mb-0">505/1 T.Nongmoo A.Wihandang P.Saraburi</p>
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
                <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
                <div class="widget-content">
                  <!-- <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div> -->
                  <h2 class="widget__title">บ้าน</h2>
                  <!-- <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p> -->
                  <!-- <a href="tel:+201061245741" class="phone__number">
                    <i class="icon-detail"></i> <span>สมาชิกในบ้าน</span>
                  </a> -->
                </div><!-- /.widget-content -->
              </div><!-- /.widget-help -->

          
            
          </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>

@endsection