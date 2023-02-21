@extends('layouts.mithcare')

@section('content')
    <!-- ============================
        Slider
    ============================== -->
    <section class="slider">
      <div class="slick-carousel m-slides-0"
        data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
        <div class="slide-item align-v-h">
          <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-04.png')}}" alt="slide img"></div>
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                <div class="slide__content">
                  <h2 class="slide__title">ยินดีต้อนรับสู่ MithCare</h2>
                  <!-- <p class="slide__desc">The health and well-being of our patients and their health care team will
                    always be our priority, so we follow the best practices for cleanliness.</p> -->
                  <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                    <!-- feature item #1 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart"></i>
                      </div>
                      <h2 class="feature__title">แจ้งเตือนนัดหมอ</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #2 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-medicine"></i>
                      </div>
                      <h2 class="feature__title">แจ้งเตือนการทานยา</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #3 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart2"></i>
                      </div>
                      <h2 class="feature__title">ช่วยเหลือเหตุฉุกเฉิน</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #4 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-blood-test"></i>
                      </div>
                      <h2 class="feature__title">ค้นหาโรงพยาบาลใกล้คุณ</h2>
                    </li><!-- /.feature-item-->
                  </ul><!-- /.features-list -->
                </div><!-- /.slide-content -->
              </div><!-- /.col-xl-7 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
        <div class="slide-item align-v-h">
          <div class="bg-img"><img src="assets/images/sliders/2.jpg" alt="slide img"></div>
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                <div class="slide__content">
                  <h2 class="slide__title">All Aspects Of Medical Practice</h2>
                  <p class="slide__desc">The health and well-being of our patients and their health care team will
                    always be our priority, so we follow the best practices for cleanliness.</p>
                  <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                    <!-- feature item #1 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart"></i>
                      </div>
                      <h2 class="feature__title">Examination</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #2 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-medicine"></i>
                      </div>
                      <h2 class="feature__title">Prescription </h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #3 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart2"></i>
                      </div>
                      <h2 class="feature__title">Cardiogram</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #4 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-blood-test"></i>
                      </div>
                      <h2 class="feature__title">Blood Pressure</h2>
                    </li><!-- /.feature-item-->
                  </ul><!-- /.features-list -->
                </div><!-- /.slide-content -->
              </div><!-- /.col-xl-7 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
      </div><!-- /.carousel -->
    </section><!-- /.slider -->

    <!-- ============================
        contact info
    ============================== -->
    <section class="contact-info py-0">
      <div class="container">
        <div class="row row-no-gutter boxes-wrapper">
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-call3"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">Emergency Cases</h2>
                <p class="contact__desc">Please feel free to contact our friendly reception staff with any general or
                  medical enquiry.</p>
                <a href="tel:+201061245741" class="phone__number">
                  <i class="icon-phone"></i> <span>090-559-2624</span>
                </a>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-health-report"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">บ้านของฉัน</h2>
                <p class="contact__desc">
                  1.สร้างบ้านและเพิ่มสมาชิกภายในบ้าน<br>
                  2.นัดหมายนัดพบแพทย์<br>
                  3.แจ้งเตือนการรับประทานยานัดพบแพทย์<br>
                </p>
                <a href="#" class="btn btn__white btn__outlined btn__rounded">
                  <span></span><i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-heart2"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">Opening Hours</h2>
                <ul class="time__list list-unstyled mb-0">
                  <li><span>Monday - Friday</span><span>8.00 - 7:00 pm</span></li>
                  <li><span>Saturday</span><span>9.00 - 10:00 pm</span></li>
                  <li><span>Sunday</span><span>10.00 - 12:00 pm</span></li>
                </ul>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.contact-info -->

    <!-- ========================
      About Layout 2
    =========================== -->
    <section class="about-layout2 pb-0">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-7 offset-lg-1">
            <div class="heading-layout2">
              <h3 class="heading__title mb-60">เกี่ยวกับเรา</h3>
            </div><!-- /heading -->
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="text-with-icon">
              <div class="text__icon">
                <i class="icon-doctor"></i>
              </div>
              <div class="text__content">
                <p class="heading__desc font-weight-bold color-secondary mb-30">Our goal is to deliver quality of care
                  in a courteous, respectful, and
                  compassionate manner. We hope you will allow us to care for you and strive to be the first and best
                  choice for healthcare.
                </p>
                {{-- <a href="doctors-timetable.html" class="btn btn__secondary btn__rounded mb-70">
                  <span>Find A Doctor</span> <i class="icon-arrow-right"></i>
                </a> --}}
              </div>
            </div>
            <div class="video-banner-layout2 bg-overlay">
                <!-- Computer Mode-->
              <img class="Image d-none d-lg-block" data-image-size="leadPromoB" alt="about" src="{{asset('/img/logo_mithcare/doctor.jpg')}}" width="642" height="427">
                <!-- Mobile Mode-->
              <img class="Image d-block d-md-none" data-image-size="leadPromoB" alt="about" src="{{asset('/img/logo_mithcare/doctor.jpg')}}" width="100%" >
              <a class="video__btn video__btn-white popup-video" href="https://www.youtube.com/watch?v=nrJtHemSPW4">
                <div class="video__player">
                  <i class="fa fa-play"></i>
                </div>
                <span class="video__btn-title color-white">MithCare</span>
              </a>
            </div><!-- /.video-banner -->
          </div><!-- /.col-lg-6 -->
          <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="about__text bg-white">
              <p class="heading__desc mb-30" style="font-size: 16px;">ข้อมูลจากสหประชาชาติ จากการเก็บผลสำรวจทำให้ทราบว่าจำนวนผู้สูงอายุไทยเพิ่มขึ้นอย่างต่อเนื่องและอัตราการเกิดต่ำ โดยประชากรผู้สูงอายุในปี 2565 คิดเป็น 18.5% ของประชากรทั้งหมด
              <p class="heading__desc mb-30" style="font-size: 16px;"> ซึ่งปัจจุบันสังคมเมืองมีแนวโน้มที่วัยแรงงานจะย้ายถิ่นฐานไปทำงานและปล่อยให้ผู้สูงอายุหรือคนเจ็บป่วยอยู่ที่บ้านโดยลำพัง ทำให้ขาดคนดูแลและไม่สามารถทราบได้ว่าเมื่อพวกเขาเหล่านั้นเจ็บป่วยได้รับการดูแล ทานยา หรือไปพบแพทย์ตามกำหนดหรือไม่
                ทำให้แพลตฟอร์มมิตรแคร์ได้กำเนิดขึ้น แพลตฟอร์มนี้ทำงานผ่านระบบไลน์ออฟฟิตเชียล
                 ซึ่งจะสามารถช่วยเหลือและแก้ไขปัญหาต่างๆเปรียบเสมือนเป็นผู้ช่วยดูแลผู้สูงอายุและผู้เจ็บป่วยตลอด 24 ชั่วโมง</p>
              <ul class="list-items list-unstyled">
                <li style="font-size: 18px;">ครอบคลุมพื้นที่ 77 จังหวัด</li>
                <li style="font-size: 18px;">บริการตลอด 24 ชม.</li>

                {{-- <li>We offer a wide range of care and support to our patients, from diagnosis to treatment and
                  rehabilitation.
                </li> --}}
              </ul>
            </div>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.About Layout 2 -->

      <!-- ========================
        ข่าวเกี่ยวกับสุขภาพ
    =========================== -->
    <section id="Health_news" class="team-layout2 pb-80">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
              <div class="heading text-center mb-40">
                <h3 class="heading__title">ข่าวเกี่ยวกับสุขภาพ</h3>
              </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="slick-carousel"
                data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": false, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                <!-- News #1 -->
                <div class="member">
                  <div class="member__img">
                    <img src="https://www.princhealth.com/wp-content/uploads/2023/02/PRINH-cancer-1024x1024.jpg" alt="member img" width="100%">
                  </div><!-- /.member-img -->
                  <div class="member__info">
                    <h5 class="member__name"><a href="https://www.princhealth.com/prinh-cancer-self-care/">กรมอนามัย แนะ เริ่มต้นป้องกัน “โรคมะเร็ง” ด้วยตนเอง เพียงปรับพฤติกรรมการใช้ชีวิต และตรวจคัดกรอง</a></h5>
                    <p></p>
                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <a href="https://www.princhealth.com/prinh-cancer-self-care/" class="btn btn__secondary btn__link btn__rounded">
                        <span>Read More</span>
                        <i class="icon-arrow-right"></i>
                      </a>
                    </div>
                  </div><!-- /.member-info -->
                </div><!-- /.member -->
                <!-- News #2 -->
                <div class="member">
                  <div class="member__img">
                    <img src="https://www.princhealth.com/wp-content/uploads/2023/02/PRINH-PM25-1-1024x1024.jpg" alt="member img " height="100%">
                  </div><!-- /.member-img -->
                  <div class="member__info">
                    <h5 class="member__name"><a href="https://www.princhealth.com/prinh-pm25-self-care/">กรมการแพทย์ แนะ วิธีการดูแลตนเองให้ปลอดภัยจากฝุ่น PM2.5</a></h5>
                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <a href="https://www.princhealth.com/prinh-pm25-self-care/" class="btn btn__secondary btn__link btn__rounded">
                        <span>Read More</span>
                        <i class="icon-arrow-right"></i>
                      </a>
                    </div>
                  </div><!-- /.member-info -->
                </div><!-- /.member -->
                <!-- News #3 -->
                <div class="member">
                  <div class="member__img">
                    <img src="https://www.princhealth.com/wp-content/uploads/2023/02/PRINH-PM25-1024x1024.jpg" alt="member img" height="100%">
                  </div><!-- /.member-img -->
                  <div class="member__info">
                    <h5 class="member__name"><a href="https://www.princhealth.com/prinh-pm25-suggestions/">กรมอนามัย เตือน 1 – 4 ก.พ. 66 ค่าฝุ่น PM2.5 สูงถึงระดับสีแดงหลายพื้นที่ เน้นย้ำ สวมหน้ากากอนามัย-งดกิจกรรมกลางแจ้ง</a></h5>
                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <a href="https://www.princhealth.com/prinh-pm25-suggestions/" class="btn btn__secondary btn__link btn__rounded">
                        <span>Read More</span>
                        <i class="icon-arrow-right"></i>
                      </a>

                    </div>
                  </div><!-- /.member-info -->
                </div><!-- /.member -->
                <!-- News #4 -->
                <div class="member">
                  <div class="member__img">
                    <img src="https://www.princhealth.com/wp-content/uploads/2023/01/PRINH-mental-health-fam-care-1024x1024.jpg" alt="member img" height="100%">
                  </div><!-- /.member-img -->
                  <div class="member__info">
                    <h5 class="member__name"><a href="https://www.princhealth.com/prinh-mental-health-fam-care/">กรมสุขภาพจิต แนะ ญาติของผู้ป่วยจิตเวชและผู้ติดยาเสพติด หมั่นสังเกตอาการ พาเข้าพบแพทย์ตามนัด</a></h5>
                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <a href="https://www.princhealth.com/prinh-mental-health-fam-care/" class="btn btn__secondary btn__link btn__rounded">
                        <span>Read More</span>
                        <i class="icon-arrow-right"></i>
                      </a>

                    </div>
                  </div><!-- /.member-info -->
                </div><!-- /.member -->

              </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section><!-- /.Team -->

    <!-- ======================
    MithCare_Dee_Yang_Rai
    ========================= -->
    <section id="MithCare_Dee_Yang_Rai" class="features-layout1 pt-130 pb-50 mt--90">
        <div class="bg-img"><img src="assets/images/backgrounds/1.jpg" alt="background"></div>
        <div class="container">
        <h3 class="text-center">MithCare ดีอย่างไร</h3>
        <div class="row">
            <!-- Feature item #1 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
                <div class="feature__content">
                <div class="feature__icon">
                    <i class="icon-heart"></i>
                    <i class="icon-heart feature__overlay-icon"></i>
                </div>
                <h4 class="feature__title">ระบบที่ช่วยดูแลครอบครัวของคุณ</h4>
                </div><!-- /.feature__content -->

            </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Feature item #2 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item">
                    <div class="feature__content">
                    <div class="feature__icon">
                        <i class="icon-ambulance"></i>
                        <i class="icon-ambulance feature__overlay-icon"></i>
                    </div>
                    <h4 class="feature__title">ขอความช่วยเหลือฉุกเฉิน</h4>
                    </div><!-- /.feature__content -->
                </div><!-- /.feature-item -->
                </div><!-- /.col-lg-3 -->
            <!-- Feature item #3 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="feature-item">
                    <div class="feature__content">
                    <div class="feature__icon">
                        <i class="icon-doctor"></i>
                        <i class="icon-doctor feature__overlay-icon"></i>
                    </div>
                    <h4 class="feature__title">แจ้งเตือนการนัดหมอ</h4>
                    </div><!-- /.feature__content -->
                </div><!-- /.feature-item -->
                </div><!-- /.col-lg-3 -->
            <!-- Feature item #4 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
                <div class="feature__content">
                <div class="feature__icon">
                    <i class="icon-drugs"></i>
                    <i class="icon-drugs feature__overlay-icon"></i>
                </div>
                <h4 class="feature__title">แจ้งเตือนการใช้ยา</h4>
                </div><!-- /.feature__content -->

            </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->

            <!-- Feature item #5 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
                <div class="feature__content">
                <div class="feature__icon">
                    <i class="icon-hospital"></i>
                    <i class="icon-hospital feature__overlay-icon"></i>
                </div>
                <h4 class="feature__title">ตามหาโรงพยาบาลใกล้ฉัน</h4>
                </div><!-- /.feature__content -->

            </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Feature item #6 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
                <div class="feature__content">
                <div class="feature__icon">
                    <i class="icon-expenses"></i>
                    <i class="icon-expenses feature__overlay-icon"></i>
                </div>
                <h4 class="feature__title">ตามหาร้านขายยาใกล้ฉัน</h4>
                </div><!-- /.feature__content -->

            </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->

        </div><!-- /.row -->

        </div><!-- /.container -->
    </section><!-- /.Features Layout 1 -->



    <!-- ======================
     Work Process
    ========================= -->
    {{-- <section class="work-process work-process-carousel pt-130 pb-0 bg-overlay bg-overlay-secondary">
      <div class="bg-img"><img src="assets/images/banners/1.jpg" alt="background"></div>
      <div class="container">
        <div class="row heading-layout2">
          <div class="col-12">
            <h2 class="heading__subtitle color-primary">Caring For The Health Of You And Your Family.</h2>
          </div><!-- /.col-12 -->
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5">
            <h3 class="heading__title color-white">We Provide All Aspects Of Medical Practice For Your Whole Family!
            </h3>
          </div><!-- /.col-xl-5 -->
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 offset-xl-1">
            <p class="heading__desc font-weight-bold color-gray mb-40">We will work with you to develop individualised
              care
              plans, including
              management of chronic diseases. If we cannot assist, we can provide referrals or advice about the type of
              practitioner you require. We treat all enquiries sensitively and in the strictest confidence.
            </p>
            <ul class="list-items list-items-layout2 list-items-light list-horizontal list-unstyled">
              <li>Fractures and dislocations</li>
              <li>Health Assessments</li>
              <li>Desensitisation injections</li>
              <li>High Quality Care</li>
              <li>Desensitisation injections</li>
            </ul>
          </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="carousel-container mt-90">
              <div class="slick-carousel"
                data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": false, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                <!-- process item #1 -->
                <div class="process-item">
                  <span class="process__number">01</span>
                  <div class="process__icon">
                    <i class="icon-health-report"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Fill In Our Medical Application</h4>
                  <p class="process__desc">Medcity offers low-cost health coverage for adults with limited income, you
                    can
                    enroll.</p>
                  <a href="#" class="btn btn__secondary btn__link">
                    <span>Doctors’ Timetable</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #2 -->
                <div class="process-item">
                  <span class="process__number">02</span>
                  <div class="process__icon">
                    <i class="icon-dna"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Review Your Family Medical History</h4>
                  <p class="process__desc">Regular health exams can help find all the problems, also can find it early
                    chances.</p>
                  <a href="#" class="btn btn__secondary btn__link">
                    <span>Start A Check Up</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #3 -->
                <div class="process-item">
                  <span class="process__number">03</span>
                  <div class="process__icon">
                    <i class="icon-medicine"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Choose Between Our Care Programs</h4>
                  <p class="process__desc">We have protocols to protect our patients while continuing to provide
                    necessary
                    care.</p>
                  <a href="#" class="btn btn__secondary btn__link">
                    <span>Explore Programs</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #4 -->
                <div class="process-item">
                  <span class="process__number">04</span>
                  <div class="process__icon">
                    <i class="icon-stethoscope"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Introduce You To Highly Qualified Doctors</h4>
                  <p class="process__desc">Our administration and support staff have exceptional skills and trained to
                    assist you. </p>
                  <a href="#" class="btn btn__secondary btn__link">
                    <span>Meet Our Doctors</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #5 -->
                <div class="process-item">
                  <span class="process__number">05</span>
                  <div class="process__icon">
                    <i class="icon-head"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Your custom Next process</h4>
                  <p class="process__desc">Our administration and support staff have exceptional skills to assist you.
                  </p>
                  <a href="#" class="btn btn__secondary btn__link">
                    <span>Meet Our Doctors</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
              </div><!-- /.carousel -->
            </div>
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
      <div class="cta bg-light-blue">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-2 col-lg-2">
              <img src="assets/images/icons/alert2.png" alt="alert">
            </div><!-- /.col-lg-2 -->
            <div class="col-sm-12 col-md-7 col-lg-7">
              <h4 class="cta__title">True Healthcare For Your Family!</h4>
              <p class="cta__desc">Serve the community by improving the quality of life through better health. We have
                put protocols to protect our patients and staff while continuing to provide medically necessary care.
              </p>
            </div><!-- /.col-lg-7 -->
            <div class="col-sm-12 col-md-3 col-lg-3">
              <a href="appointment.html" class="btn btn__primary btn__secondary-style2 btn__rounded">
                <span>Healthcare Programs</span>
                <i class="icon-arrow-right"></i>
              </a>
            </div><!-- /.col-lg-3 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.cta -->
    </section><!-- /.Work Process --> --}}

    <!-- ==========================
        นัดหมาย
    =========================== -->
    {{-- <section class="contact-layout3 bg-overlay bg-overlay-primary-gradient pb-60">
      <div class="bg-img"><img src="assets/images/banners/3.jpg" alt="banner"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="contact-panel mb-50">
              <form class="contact-panel__form" method="post" action="assets/php/contact.php" id="contactForm">
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="contact-panel__title">Book An Appointment</h4>
                    <p class="contact-panel__desc mb-30">Please feel welcome to contact our friendly reception staff
                      with any general or medical enquiry. Our doctors will receive or return any urgent calls.
                    </p>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                      <i class="icon-widget form-group-icon"></i>
                      <select class="form-control">
                        <option value="0">Choose Clinic</option>
                        <option value="1">Pathology Clinic</option>
                        <option value="2">Pathology Clinic</option>
                      </select>
                    </div>
                  </div><!-- /.col-lg-6 -->
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                      <i class="icon-user form-group-icon"></i>
                      <select class="form-control">
                        <option value="0">Choose Doctor</option>
                        <option value="1">Ahmed Abdallah</option>
                        <option value="2">Mahmoud Begha</option>
                      </select>
                    </div>
                  </div><!-- /.col-lg-6 -->
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                      <i class="icon-news form-group-icon"></i>
                      <input type="text" class="form-control" placeholder="Name" id="contact-name" name="contact-name"
                        required>
                    </div>
                  </div><!-- /.col-lg-6 -->
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                      <i class="icon-email form-group-icon"></i>
                      <input type="email" class="form-control" placeholder="Email" id="contact-email"
                        name="contact-email" required>
                    </div>
                  </div><!-- /.col-lg-6 -->
                  <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                      <i class="icon-phone form-group-icon"></i>
                      <input type="text" class="form-control" placeholder="Phone" id="contact-Phone"
                        name="contact-phone" required>
                    </div>
                  </div><!-- /.col-lg-4 -->
                  <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group form-group-date">
                      <i class="icon-calendar form-group-icon"></i>
                      <input type="date" class="form-control" id="contact-date" name="contact-date" required>
                    </div>
                  </div><!-- /.col-lg-4 -->
                  <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group form-group-date">
                      <i class="icon-clock form-group-icon"></i>
                      <input type="time" class="form-control" id="contact-time" name="contact-time" required>
                    </div>
                  </div><!-- /.col-lg-4 -->
                  <div class="col-12">
                    <button type="submit" class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10">
                      <span>Book Appointment</span> <i class="icon-arrow-right"></i>
                    </button>
                    <div class="contact-result"></div>
                  </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
              </form>
            </div>
          </div><!-- /.col-lg-7 -->
          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="heading heading-light mb-30">
              <h3 class="heading__title mb-30">Helping Patients From Around the Globe!!</h3>
              <p class="heading__desc">Our staff strives to make each interaction with patients clear, concise, and
                inviting. Support the important work of Medicsh Hospital by making a much-needed donation today.
              </p>
            </div>
            <div class="d-flex align-items-center">
              <a href="contact-us.html" class="btn btn__white btn__rounded mr-30">
                <i class="fas fa-heart"></i> <span>Make A Gift</span>
              </a>
              <a class="video__btn video__btn-white popup-video" href="https://www.youtube.com/watch?v=nrJtHemSPW4">
                <div class="video__player">
                  <i class="fa fa-play"></i>
                </div>
                <span class="video__btn-title color-white">Play Video</span>
              </a>
            </div>
            <div class="text__block">
              <p class="text__block-desc color-white font-weight-bold">We provide a comprehensive range of plans for
                families and individuals at every stage of life, with annual limits ranging from £1.5m to unlimited.</p>
              <div class="sinature color-white">
                <span class="font-weight-bold">Martin Qube</span><span>, Medcity Manager</span>
              </div>
            </div><!-- /.text__block -->
            <div class="slick-carousel clients-light mt-20"
              data-slick='{"slidesToShow": 3, "arrows": false, "dots": false, "autoplay": true,"autoplaySpeed": 2000, "infinite": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 3}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 2}}]}'>
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/1.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/1.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/2.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/2.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/3.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/3.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/4.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/4.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/5.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/5.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/6.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/6.png" alt="client">
              </div><!-- /.client -->
              <div class="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/7.png" alt="client">
                <img src="https://www.viicheck.com/img/stickerline/PNG/7.png" alt="client">
              </div><!-- /.client -->
            </div><!-- /.carousel -->



          </div><!-- /.col-lg-5 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.contact layout 3 --> --}}

    <!-- ======================
            ViiCheck
    ========================= -->

    <section class="work-process work-process-carousel pt-60 pb-60 " style="background-color: #ffefef;padding-top:20px;padding-bottom:20px;">
        <h2 class="text-center" style="color: black">บริการดีๆจาก <br class="d-block d-md-none"> ViiCHECK</h2>
      <div class="row">
        <div class="col-12">
          <div class="carousel-container mt-40 mr-2 ml-2">
            <div class="slick-carousel"
              data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": true, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
              <!-- process item #1 -->
              <div class="process-item">
                <span class="process__number">01</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.peddyhub.com/peddyhub/images/sticker_vc/2.png" class="img-fluid text-center " alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color:#EB2424;"> ติดต่อเจ้าของรถ</h4>
                <p class="process__desc h6">ติดต่อเจ้าของรถได้ง่ายๆ โดยผ่าน Line Official: @Viicheck  เพียงแค่สแกน QR-CODE บนสติ๊กเกอร์</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                  <span class="p-2" style="color:#EB2424;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->

              <!-- process-item #2 -->
              <div class="process-item">
                <span class="process__number">02</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.peddyhub.com/peddyhub/images/sticker_vc/1.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color:#EB2424;">ติดต่อแจ้งเหตุฉุกเฉิน</h4>
                <p class="process__desc h6">ติดต่อแจ้งเหตุฉุกเฉิน 24 ชั่วโมงเพียงแค่กดปุ่มก็จะมีเบอร์ที่จำเป็นแสดงขึ้นมา</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color:#EB2424;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->
              <!-- process-item #3 -->
              <div class="process-item">
                <span class="process__number">03</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.peddyhub.com/peddyhub/images/sticker_vc/4.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color:#EB2424;">แจ้งเตือน พรบ./ประกัน</h4>
                <p class="process__desc h6">หายห่วงเรื่องลืมต่ออายุ พรบ./ประกันระบบจะแจ้งเตือนเมื่อใกล้วันครบกำหนด</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color:#EB2424;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->
              <!-- process-item #4 -->
              <div class="process-item">
                <span class="process__number">04</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.peddyhub.com/peddyhub/images/sticker_vc/6.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color:#EB2424;">โปรโมชั่นเกี่ยวกับยานพาหนะ</h4>
                <p class="process__desc h6">โปรโมชั่นของยานพาหนะมากมายที่รอเสนอให้คุณใช้บริการรีบเลยก่อนหมดเวลา !</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color:#EB2424;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->

            </div><!-- /.carousel -->
          </div>
        </div><!-- /.col-12 -->
      </div><!-- /.row -->
    </section>

    <!-- ======================
            Peddy_Hub
    ========================= -->

    <section class="work-process work-process-carousel pt-60 pb-60 " style="background-color:rgb(232, 216, 247)">
        <div class="bg-img"><img src="{{asset('/img/peddy_hub/app-bg.png')}}" width="90%" alt="background"></div>
        <h2 class="text-center" style="color: black">บริการดีๆจาก PEDDyHUB</h2>
        <h5 class="text-center" style="color: black">PeddyHub ศูนย์รวมบริการ ข้อมูล และ community สำหรับคนรักสัตว์ peddy hub ครบจบในที่เดียว !!</h5>
      <div class="row">
        <div class="col-12">
          <div class="carousel-container mt-40 mr-2 ml-2">
            <div class="slick-carousel"
              data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": false, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
              <!-- process item #1 -->
              <div class="process-item">
                <span class="process__number">01</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.viicheck.com/img/sticker_ph/1.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color :#B8205B;">ตามหาเจ้าตัวแสบ</h4>
                <p class="process__desc h6">ตามหาเจ้าตัวแสบได้ง่ายๆ เพียงลงทะเบียนสัตว์เลี้ยงกับระบบ ของเรา เพียงเท่านี้ ผู้คนที่อยู่ในบริเวณใกล้เคียงก็พร้อมช่วยเหลือท่านทันที</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                  <span class="p-2" style="color :#B8205B;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->

              <!-- process-item #2 -->
              <div class="process-item">
                <span class="process__number">02</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.viicheck.com/img/sticker_ph/5.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color :#B8205B;">บัตรประจำตัวสัตว์เลี้ยง</h4>
                <p class="process__desc h6">เมื่อลงทะเบียนสัตว์ เรามีบัตรประจำตัวสัตว์เลี้ยงให้ ภายในบัตรมีรายละเอียดสัตว์เลี้ยงอย่าครบถ้วนรวมไปถึงข้อมูลติดต่อเจ้าของอีกด้วย </p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color :#B8205B;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->
              <!-- process-item #3 -->
              <div class="process-item">
                <span class="process__number">03</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.viicheck.com/img/sticker_ph/2.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color :#B8205B;">โรงพยาบาลสัตว์ </h4>
                <p class="process__desc h6">เมื่อต้องการหาโรงพยาบาลสัตว์ ก็สามารถค้นหาโรงพยาบาลสัตว์ใกล้คุณได้ทันที</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color :#B8205B;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->
              <!-- process-item #4 -->
              <div class="process-item">
                <span class="process__number">04</span>
                <div class="process__icon">
                    <img width="25%" src="https://www.viicheck.com/img/sticker_ph/4.png" class="img-fluid" alt="">
                </div><!-- /.process__icon -->
                <h4 class="process__title" style="color :#B8205B;">ชุมชนคนรักสัตว์</h4>
                <p class="process__desc h6">เรามีชุมชนสำหรับคนรักสัตว์ สามารถชมหรือมาแชร์ความน่ารักของสัตว์เลี้ยงของทุกๆคนได้เลย</p>
                <a href="https://lin.ee/y3gA8A3" class="btn btn__secondary btn__link">
                    <span class="p-2" style="color :#B8205B;">กดเพื่อดูเพิ่มเติม</span>
                  <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.process-item -->


            </div><!-- /.carousel -->
          </div>
        </div><!-- /.col-12 -->
      </div><!-- /.row -->
    </section>

@endsection
