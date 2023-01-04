@extends('layouts.mithcare')

@section('content')

     <!-- ========================
       page title 
    =========================== -->
    <section class="page-title page-title-layout5">
      <div class="bg-img"><img src="assets/images/backgrounds/6.jpg" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="pagetitle__heading">Ahmed Abdallah</h1>
            <nav>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Doctors</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ahmed Abdallah</li>
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
                    <img src="assets/images/team/2.jpg" alt="member img">
                  </div><!-- /.member-img -->
                  <div class="member__info">
                    <h5 class="member__name"><a href="doctors-single-doctor1.html">Ahmed Abdallah</a></h5>
                    <p class="member__job">Cardiology Specialist</p>
                    <p class="member__desc">Brian specializes in treating skin, hair, nail, and mucous membrane. He also
                      address cosmetic issues, helping to revitalize the appearance of the skin</p>
                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                      <ul class="social-icons list-unstyled mb-0">
                        <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="phone"><i class="fas fa-phone-alt"></i></a></li>
                      </ul><!-- /.social-icons -->
                    </div>
                  </div><!-- /.member-info -->
                </div><!-- /.member -->
              </div><!-- /.widget-member -->
              <div class="widget widget-help bg-overlay bg-overlay-primary-gradient">
                <div class="bg-img"><img src="assets/images/banners/5.jpg" alt="background"></div>
                <div class="widget-content">
                  <div class="widget__icon">
                    <i class="icon-call3"></i>
                  </div>
                  <h4 class="widget__title">Emergency Cases</h4>
                  <p class="widget__desc">Please feel welcome to contact our friendly reception staff with any general
                    or medical enquiry call us.
                  </p>
                  <a href="tel:+201061245741" class="phone__number">
                    <i class="icon-phone"></i> <span>01061245741</span>
                  </a>
                </div><!-- /.widget-content -->
              </div><!-- /.widget-help -->
              <div class="widget widget-schedule">
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
                </div><!-- /.widget-content -->
              </div><!-- /.widget-schedule -->
              <div class="widget widget-reports">
                <a href="#" class="btn btn__primary btn__block">
                  <i class="icon-pdf-file"></i>
                  <span>2020 Patient Reports</span>
                </a>
              </div>
            </aside><!-- /.sidebar -->
          </div><!-- /.col-lg-4 -->
          <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="text-block mb-50">
              <h5 class="text-block__title">Biography</h5>
              <p class="text-block__desc mb-20 font-weight-bold color-secondary">A neurologist is a medical doctor with
                specialized training
                in diagnosing, treating, and managing disorders of the brain and nervous system including, but not
                limited to, Alzheimer’s disease, amyotrophic lateral sclerosis (ALS), concussion, epilepsy, migraine,
                multiple sclerosis, Parkinson’s disease, and stroke.</p>
              <p class="text-block__desc mb-20">He then traveled to Philadelphia, Pennsylvania to complete a Fellowship
                in Intervention Cardiology at Hahnemann Hospital in conjunction with Drexel University, where he
                received extensive training in coronary as well as peripheral interventions and limb salvage procedures.
                He actively participates in clinical research trials and has been published in peer reviewed journals
                such as the Journal of the State Medical Society and Baylor University Medical Center's Proceedings.</p>
              <p class="text-block__desc mb-20">In his spare time, watches college and professional football and enjoys
                traveling, swimming and playing chess. He is currently Board Certified in Cardiovascular Disease and
                Interventional Cardiology. He moved to California where he completed both his Internship ('85-'86) and
                Residency ('87-'89) at the University of California.</p>
            </div><!-- /.text-block -->
            <ul class="details-list list-unstyled mb-60">
              <li>
                <h5 class="details__title">Speciality</h5>
                <div class="details__content">
                  <p class="mb-0">Cardiology </p>
                </div>
              </li>
              <li>
                <h5 class="details__title">Degrees</h5>
                <div class="details__content">
                  <p class="mb-0">M.D. of Medicine </p>
                </div>
              </li>
              <li>
                <h5 class="details__title">Areas of Expertise</h5>
                <div class="details__content">
                  <ul class="list-items list-items-layout2 list-unstyled mb-0">
                    <li>Cardiac Imaging – Non-invasive.</li>
                    <li>Cardiac Rehabilitation and Exercise.</li>
                    <li>Hypertrophic Cardiomyopathy.</li>
                    <li>Inherited Heart Diseases.</li>
                  </ul>
                </div>
              </li>
              <li>
                <h5 class="details__title">Office</h5>
                <div class="details__content">
                  <p class="mb-0">2307 Beverley Rd Brooklyn, New York 11226 United States.</p>
                </div>
              </li>
              <li>
                <h5 class="details__title">University</h5>
                <div class="details__content">
                  <p class="mb-0">Harvard University</p>
                </div>
              </li>
            </ul>
            <div class="text-block mb-50">
              <h5 class="text-block__title">Doctor’s Services</h5>
              <p class="text-block__desc mb-20">He actively participates in clinical research trials and has been
                published in peer reviewed journals such as the Journal of the State Medical Society and Baylor
                University Medical Center’s Proceedings. At Hahnemann Hospital in conjunction with Drexel University,
                where he received extensive training in coronary as well as peripheral interventions and limb salvage
                procedures.
              </p>
            </div><!-- /.text-block -->
            <div class="pricing-widget-layout3 mb-70">
              <h5 class="pricing__title">Treatments Price List</h5>
              <div class="row">
                <div class="col-md-6">
                  <ul class="pricing__list list-unstyled mb-0">
                    <li><span>Umbilical Cord Appearance</span><span class="price">$50</span></li>
                    <li><span>Cardiac Electrophysiology</span><span class="price">$45</span></li>
                    <li><span>Repositioning Techniques</span><span class="price">$60</span></li>
                    <li><span>Geriatric Neurology</span><span class="price">$65</span></li>
                    <li><span>Nuclear Cardiology</span><span class="price">$40</span></li>
                    <li><span>Nuclear Cardiology</span><span class="price">$55</span></li>
                  </ul><!-- /.pricing__list -->
                </div><!-- /.col-md-6 -->
                <div class="col-md-6">
                  <ul class="pricing__list list-unstyled mb-0">
                    <li><span>Umbilical Cord Appearance</span><span class="price">$50</span></li>
                    <li><span>Cardiac Electrophysiology</span><span class="price">$45</span></li>
                    <li><span>Repositioning Techniques</span><span class="price">$60</span></li>
                    <li><span>Geriatric Neurology</span><span class="price">$65</span></li>
                    <li><span>Nuclear Cardiology</span><span class="price">$40</span></li>
                    <li><span>Nuclear Cardiology</span><span class="price">$55</span></li>
                  </ul><!-- /.pricing__list -->
                </div><!-- /.col-md-6 -->
              </div><!-- /.pricing-widget-layout3 -->
            </div><!-- /.text-block -->
            <div class="text-block mb-50">
              <h5 class="text-block__title">Awards And Honours</h5>
              <p class="text-block__desc mb-20">Today the hospital is recognised as a world renowned institution, not
                only providing outstanding care and treatment, but improving the outcomes for all through a
                comprehensive medical research. For over 20 years, our hospital has touched lives of millions of people,
                and provide care and treatment for the sickest in our community including rehabilitation and aged care.
              </p>
            </div><!-- /.text-block -->
            <div class="fancybox-layout2">
              <div class="row">
                <div class="col-sm-6">
                  <!-- fancybox item #1 -->
                  <div class="fancybox-item d-flex">
                    <div class="fancybox__icon">
                      <i class="icon-diploma"></i>
                    </div><!-- /.fancybox__icon -->
                    <div class="fancybox__content">
                      <h4 class="fancybox__title">Edison Awards</h4>
                      <p class="fancybox__desc">Honoring excellence in innovation</p>
                    </div><!-- /.fancybox-content -->
                  </div><!-- /.fancybox-item -->
                </div><!-- /.col-sm-6 -->
                <div class="col-sm-6">
                  <!-- fancybox item #2 -->
                  <div class="fancybox-item d-flex">
                    <div class="fancybox__icon">
                      <i class="icon-diploma"></i>
                    </div><!-- /.fancybox__icon -->
                    <div class="fancybox__content">
                      <h4 class="fancybox__title">Edwin Grant Medal</h4>
                      <p class="fancybox__desc">Research in developmental biology</p>
                    </div><!-- /.fancybox-content -->
                  </div><!-- /.fancybox-item -->
                </div><!-- /.col-sm-6 -->
                <div class="col-sm-6">
                  <!-- fancybox item #3 -->
                  <div class="fancybox-item d-flex">
                    <div class="fancybox__icon">
                      <i class="icon-diploma"></i>
                    </div><!-- /.fancybox__icon -->
                    <div class="fancybox__content">
                      <h4 class="fancybox__title">Robert L. Noble Prize</h4>
                      <p class="fancybox__desc">Canadian Cancer Society</p>
                    </div><!-- /.fancybox-content -->
                  </div><!-- /.fancybox-item -->
                </div><!-- /.col-sm-6 -->
                <div class="col-sm-6">
                  <!-- fancybox item #4 -->
                  <div class="fancybox-item d-flex">
                    <div class="fancybox__icon">
                      <i class="icon-diploma"></i>
                    </div><!-- /.fancybox__icon -->
                    <div class="fancybox__content">
                      <h4 class="fancybox__title">National Prize for Medicine</h4>
                      <p class="fancybox__desc">Chilean Academy of Medicine etc.</p>
                    </div><!-- /.fancybox-content -->
                  </div><!-- /.fancybox-item -->
                </div><!-- /.col-sm-6 -->
              </div><!-- /.row -->
            </div><!-- /.fancybox-layout2 -->
            <div class="text-block mb-40">
              <h5 class="text-block__title">Medical Education</h5>
              <p class="text-block__desc mb-20">She then went to LSU Medical School in New Orleans where she was an
                Honors Program Graduate and finished in the top quartile of his graduating class. She completed his
                Internal Medicine Residency at the University of Alabama in Birmingham, AL where he was selected as a
                Chief Internal Medicine Resident.
              </p>
            </div><!-- /.text-block -->
            <div class="timeline-wrapper mb-60">
              <!-- Timeline Item #1 -->
              <div class="timeline-item d-flex">
                <span class="timeline__year">2020</span>
                <div class="timeline__body">
                  <h4 class="timeline__title">Royal College of Surgeons of Harvard</h4>
                  <p class="timeline__desc mb-0">We partner with you to enable your technology so that you can focus on
                    your organization’s mission leverage our talent, and creativity to help your business succeed above
                    all your business competitors.
                  </p>
                </div><!-- /.timeline__body -->
              </div><!-- /.timeline-item -->
              <!-- Timeline Item #2 -->
              <div class="timeline-item d-flex">
                <span class="timeline__year">2015</span>
                <div class="timeline__body">
                  <h4 class="timeline__title">Fellowship, Royal College of Physicians of Harvard</h4>
                  <p class="timeline__desc mb-0">After relocating to Louisiana she served as Director of the Cardiac
                    Catheterization Lab at Regional Medical Center of Acadiana. She was honored by the Medical
                    Association for Physician's Recognition Award from March of 2015 through May 2016.
                  </p>
                </div><!-- /.timeline__body -->
              </div><!-- /.timeline-item -->
              <!-- Timeline Item #3 -->
              <div class="timeline-item d-flex">
                <span class="timeline__year">2015</span>
                <div class="timeline__body">
                  <h4 class="timeline__title">Residency, St. Harvard University Hospital</h4>
                  <p class="timeline__desc mb-0">Dr has also had professional accomplishments at the University of
                    Southern California School of Medicine and Medical Center including Instructor of Medicine, Chief
                    Administrative Fellow, Division of Cardiology University of Southern California.
                  </p>
                </div><!-- /.timeline__body -->
              </div><!-- /.timeline-item -->
            </div><!-- /.timeline-wrapper -->
            <div class="text-block mb-40">
              <h5 class="text-block__title">Doctor’s Skills</h5>
              <p class="text-block__desc mb-20">He completed his Internal Medicine Residency at the University of
                Alabama in Birmingham, AL where he was selected as a Chief Internal Medicine Resident. He then went to
                LSU Medical School in New Orleans where he was an Honors Program Graduate and finished in the top
                quartile of his graduating class.
              </p>
            </div><!-- /.text-block -->
            <div class="animated-Progressbars mb-60">
              <!-- progress 1 -->
              <div class="progress-item">
                <h5 class="progress__title">Cardiac Rehabilitation</h5>
                <div class="progress">
                  <div class="progress-bar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                    <span class="progress__percentage"></span>
                  </div>
                </div><!-- /.progress -->
              </div><!-- /.progress-item  -->
              <!-- progress 2 -->
              <div class="progress-item">
                <h5 class="progress__title">Nuclear Cardiology</h5>
                <div class="progress">
                  <div class="progress-bar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                    <span class="progress__percentage"></span>
                  </div>
                </div><!-- /.progress -->
              </div><!-- /.progress-item  -->
              <!-- progress 3 -->
              <div class="progress-item">
                <h5 class="progress__title">Neurocritical Care</h5>
                <div class="progress">
                  <div class="progress-bar" aria-valuenow="81" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                    <span class="progress__percentage"></span>
                  </div>
                </div><!-- /.progress -->
              </div><!-- /.progress-item  -->
            </div><!-- /.animated-Progressbars -->
            <section class="contact-layout4 bg-overlay bg-overlay-secondary-gradient pb-50 pb-50">
              <div class="bg-img"><img src="assets/images/banners/3.jpg" alt="banner"></div>
              <div class="contact-panel mb-0">
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
                      <button type="submit" class="btn btn__primary btn__rounded btn__block btn__xhight mt-10">
                        <span>Book Appointment</span> <i class="icon-arrow-right"></i>
                      </button>
                      <div class="contact-result"></div>
                    </div><!-- /.col-lg-12 -->
                  </div><!-- /.row -->
                </form>
              </div>
            </section><!-- /.contact layout 2 -->
          </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section>

@endsection