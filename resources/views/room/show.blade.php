@extends('layouts.mithcare')

@section('content')

<style>
    .btn-circle{
        font-size: 20px;
        font-weight: 700;
        display: block;
        width: 60px;
        height: 60px;
        line-height: 46px;
        text-align: center;
        border-radius: 50%;
        color: #4170A2;
        border: 2px solid #e6e8eb;
        background-color: #ffffff;
        -webkit-transition: all 0.3s linear;
        transition: all 0.3s linear;
    }
</style>

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">deer</h1>
                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">{{$room->name}}</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">{{$room->name}}</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->



<section class="features-layout1 pt-130 pb-50 mt--90">
    <div class="bg-img"><img src="assets/images/backgrounds/1.jpg" alt="background"></div>
    <div class="container">
        <h3 class="text-center"><i class="fa-solid fa-house"></i> {{ $room->name }} </h3>
            <a class="btn-old btn-info btn-sm main-shadow main-radius" href="#" onclick="goBack()">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
            </a>
            {{-- เช็คว่าเป็น owner or admin -> มองเห็นปุ่มลบและแก้ไข  --}}
            @if($room->owner_id == Auth::user()->id || Auth::user()->role == 'isAdmin')
            <a href="{{ url('/room/' . $room->id . '/edit') }}" title="Edit Room">
                <button class="btn-old btn-primary btn-sm main-shadow main-radius m-2">
                    <i class="fa-solid fa-pen-to-square"></i> แก้ไขบ้าน
                </button>
            </a>
            <form method="POST" action="{{ url('room' . '/' . $room->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn-old btn-danger btn-sm main-shadow main-radius m-2" title="Delete Room" onclick="return confirm('ต้องการลบใช่ไหม')">
                    <i class="fa-solid fa-trash"></i> ลบบ้าน
                </button>
            </form>
            @endif
            <br><br>
        <div class="row">
            <!-- Feature item #1 -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="feature-item">
                    <div class="feature__content">
                        <div class="feature__icon">
                            {{-- <i class="fa-solid fa-notes-medical"></i>
                            <i class="fa-solid fa-notes-medical feature__overlay-icon"></i> --}}
                        </div>

                        <div class="row d-flex justify-content-between ">
                            <span class="feature__title" style="font-size: 25px; color:#4170A2; font-weight:bold;">รหัสค้นหาบ้าน</span>
                            <p type="text" id="gen_id" class="feature__title" style="font-size: 25px;" >{{ isset($room->gen_id) ? $room->gen_id : ''}}</p>&nbsp;&nbsp;
                            <div class="input-group-append">
                                <!-- คอม -->
                                <span class="input-group-append d-none d-lg-block">
                                    <button class="btn-old btn-secondary btn-circle" onclick="Copy_Text_()" type="submit" >
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </span>

                                  <!-- มือถือ -->
                                <span class="input-group-append d-block d-md-none">
                                    <button class="btn-old btn-secondary btn-circle" onclick="Copy_Text_()" type="submit" >
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                    </div><!-- /.feature__content -->

                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.Features Layout 1 -->

 <!-- ======================
             คอม
    ========================= -->
    <section class="team-layout2 pb-80 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                    <div class="heading text-center mb-40">
                        <h3 class="heading__title">สมาชิกในบ้าน</h3>
                    </div><!-- /.heading -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row ">
                <div class="col-12">
                    <div class="slick-carousel"
                        data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": false, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                        <!-- Member #1 -->
                        @foreach ($member as $item)
                        <div class="member">
                            <div class="member__img">
                                @if(!empty($item->user->avatar) and empty($item->user->photo))
                                    <div class="member__img ">
                                        <img src="{{ url('storage')}}/{{ $item->user->avatar }}" alt="member img" height="300px" width="100%">
                                    </div><!-- /.member-img -->
                                @endif

                                @if(!empty($item->user->photo))
                                    <div class="member__img ">
                                        <img src="{{ url('storage')}}/{{ $item->user->photo }}" alt="member img" height="300px" width="100%">
                                    </div><!-- /.member-img -->
                                @endif

                                @if(empty($item->user->avatar) and empty($item->user->photo))
                                    <div class="member__img ">
                                        <img src="{{ asset('/img/logo_mithcare/x-icon-2.png') }}" alt="member img" height="300px" width="100%">
                                    </div><!-- /.member-img -->
                                @endif
                            </div><!-- /.member-img -->
                            <div class="member__info">
                                <h5 class="member__name"><a href="">{{$item->user->name}}</a></h5>
                                @if ($item->status == 'owner')
                                    <p class="member__job ">สถานะ : เจ้าของบ้าน</p>
                                @else
                                    <p class="member__job ">สถานะ : สมาชิก</p>
                                @endif
                                <p class="member__desc">เลเวล</p>
                            </div><!-- /.member-info -->
                        </div><!-- /.member -->
                        @endforeach
                    </div><!-- /.carousel -->
                </div><!-- /.col-12 -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.Team -->

 <!-- ======================
              มือถือ
    ========================= -->
<section class="team-layout2 pb-80 d-block d-md-none">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h3 class="heading__title">สมาชิกในบ้าน</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row ">
            <div class="col-12">
                <div class="slick-carousel"
                    data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": false, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                    <!-- Member #1 -->
                    @foreach ($member as $item)
                    <div class="member">
                        <div class="member__img">
                            @if(!empty($item->user->avatar) and empty($item->user->photo))
                                <div class="member__img ">
                                    <img src="{{ url('storage')}}/{{ $item->user->avatar }}" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif

                            @if(!empty($item->user->photo))
                                <div class="member__img ">
                                    <img src="{{ url('storage')}}/{{ $item->user->photo }}" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif

                            @if(empty($item->user->avatar) and empty($item->user->photo))
                                <div class="member__img ">
                                    <img src="{{ asset('/img/logo_mithcare/x-icon-2.png') }}" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif
                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <h5 class="member__name"><a href="">{{$item->user->name}}</a></h5>
                            @if ($item->status == 'owner')
                                <p class="member__job ">สถานะ : เจ้าของบ้าน</p>
                            @else
                                <p class="member__job ">สถานะ : สมาชิก</p>
                            @endif
                            <p class="member__desc">เลเวล</p>
                        </div><!-- /.member-info -->
                    </div><!-- /.member -->
                    @endforeach
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Team -->


{{-- <section class="team-layout2 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h3 class="heading__title">Meet Our Doctors</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="slick-carousel slick-initialized slick-slider" data-slick="{&quot;slidesToShow&quot;: 3, &quot;slidesToScroll&quot;: 1, &quot;autoplay&quot;: true, &quot;arrows&quot;: false, &quot;dots&quot;: false, &quot;responsive&quot;: [ {&quot;breakpoint&quot;: 992, &quot;settings&quot;: {&quot;slidesToShow&quot;: 2}}, {&quot;breakpoint&quot;: 767, &quot;settings&quot;: {&quot;slidesToShow&quot;: 1}}, {&quot;breakpoint&quot;: 480, &quot;settings&quot;: {&quot;slidesToShow&quot;: 1}}]}">
                    <div class="slick-list draggable">
                        <div class="slick-track" style="opacity: 1; width: 5070px; transform: translate3d(-780px, 0px, 0px);">
                            <div class="member slick-slide slick-cloned" style="width: 360px;" tabindex="-1" data-slick-index="-1" id="" aria-hidden="true">
                                <div class="member__img">
                                    <img src="assets/images/team/6.jpg" alt="member img">
                                </div><!-- /.member-img -->
                                <div class="member__info">
                                    <h5 class="member__name"><a href="doctors-single-doctor1.html" tabindex="-1">Kiano Barker</a></h5>
                                    <p class="member__job">Pathologist </p>
                                    <p class="member__desc">Barker help care for patients every day by providing their doctors with the
                                    information needed to ensure appropriate care. He also valuable resources for other physicians.</p>
                                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                                        <a href="doctors-single-doctor1.html" class="btn btn__secondary btn__link btn__rounded" tabindex="-1">
                                            <span>Read More</span>
                                            <i class="icon-arrow-right"></i>
                                        </a>
                                        <ul class="social-icons list-unstyled mb-0">
                                            <li><a href="#" class="facebook" tabindex="-1"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" class="twitter" tabindex="-1"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" class="phone" tabindex="-1"><i class="fas fa-phone-alt"></i></a></li>
                                        </ul><!-- /.social-icons -->
                                    </div>

                                </div>
                            </div><!-- /.member -->
                        </div><!-- /.slick-track -->
                    </div><!-- /.slick-list -->
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section> --}}




@endsection


<script>
    function Copy_Text_() {
      // Get the text field
      var copyText = document.getElementById("gen_id");

      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.innerText);

    //   Alert the copied text
      alert("Copied !!!" );
    }

</script>
