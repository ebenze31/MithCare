@extends('layouts.mithcare')

@section('content')

<style>
    input[type="file"]::file-selector-button {
            border: 2px solid #00cec9;
            border-radius: 50%;
            padding: 0.3em 0.5em;
            border-radius: 0.8em;
            background-color: #81ecec;
            transition: 1s;
            margin-top: 0.8em;

        }

        input[type="file"]::file-selector-button:hover {
            background-color: #007bff;
            border: 2px solid #4170A2;
        }


</style>

     <!-- ========================
       page title
    =========================== -->
    <section class="page-title page-title-layout5">
      <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
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
                    <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">แก้ไขโปรไฟล์</a></li>
                  </ol>
                </div> <!--d-none d-lg-block -->

                <!-- แสดงเฉพาะมือถือ -->
                <div class="d-block d-md-none">
                  <ol class=" breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/profile') }}" style="font-size: 20px;">โปรไฟล์</a></li>
                    <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">แก้ไขโปรไฟล์</a></li>
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
                        <img src="{{ url('storage/'.$user->photo )}}" alt="member img" height="300px" width="100%">
                     @else
                        <img src="https://www.viicheck.com/Medilab/img/icon.png" alt="member img" height="300px" width="100%">
                    @endif --}}

                    <!-- รูปโปรไฟล์-->
                    <center>
                        <div id="img_profile_old" class="m-2">
                            @if(!empty($user->avatar) and empty($user->photo))
                                <img width="300" src="{{ $user->avatar }}" >
                            @endif
                            @if(!empty($user->photo))
                                <img  width="300" src="{{ url('storage')}}/{{ $user->photo }}" >
                            @endif
                            @if(empty($user->avatar) and empty($user->photo))
                                <img  width="300" src="https://www.viicheck.com/Medilab/img/icon.png" >
                            @endif
                        </div>
                        <div width="300" id="img_profile_new" class="m-2"></div>
                    </center>

                  </div><!-- /.member-img -->
                  <form method="POST" action="{{ url('/profile/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="member__info">
                        <div class="form-group ">
                            <input class="form-control" name="photo" type="file" id="photo" value="{{ url('storage/'.$user->photo )}}"
                            onchange="document.querySelector('#img_profile_old').classList.add('d-none');">
                        </div>
                        <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">{{$user->full_name}}</a></h2>
                    </div><!-- /.member-info -->
                </div><!-- /.member -->
              </div><!-- /.widget-member -->





                            <div class="widget-content">
                                <h2 class="widget__title text-center" style="font-size: 30px;">บัตร 1</h2>

                                <div id="health_card_1_old">
                                    @if (!empty($user->health_card_1))
                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                            <img class="main-radius" src="{{ url('storage')}}/{{ $user->health_card_1 }}" >
                                        </div>
                                    @else
                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                            <img class="main-radius" height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                        </div>
                                    @endif
                                </div>
                                <div class="main-radius" id="health_card_1_new" class="m-2"></div>
                                <div class="form-group mt-3">
                                    <input class="form-control" name="health_card_1" type="file" id="health_card_1" value="{{ url('storage/'.$user->health_card_1 )}}"
                                    onchange="document.querySelector('#health_card_1_old').classList.add('d-none');">
                                </div>

                            </div><!-- /.widget-content -->

                            <div class="widget-content">
                                <h2 class="widget__title text-center" style="font-size: 30px;">บัตร 2</h2>

                                <div id="health_card_2_old">
                                    @if (!empty($user->health_card_2))
                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                            <img class="main-radius" src="{{ url('storage')}}/{{ $user->health_card_2 }}" >
                                        </div>
                                    @else
                                        <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                            <img class="main-radius" height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                        </div>
                                    @endif
                                </div>
                                <div class="main-radius" id="health_card_2_new" class="m-2"></div>
                                <div class="form-group mt-3">
                                    <input class="form-control" name="health_card_2" type="file" id="health_card_2" value="{{ url('storage/'.$user->health_card_2 )}}"
                                    onchange="document.querySelector('#health_card_2_old').classList.add('d-none');" >
                                </div>
                            </div><!-- /.widget-content -->



                        <div class="widget-content">
                            <h2 class="widget__title text-center" style="font-size: 30px;">บัตร 3</h2>

                            <div id="health_card_3_old">
                                @if (!empty($user->health_card_3))
                                    <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                        <img class="main-radius" src="{{ url('storage')}}/{{ $user->health_card_3 }}" >
                                    </div>
                                @else
                                    <div class="main-radius" style="border-style: solid; border-width: 1px; color:#4170A2">
                                        <img class="main-radius" height="200px" width="100%" src="{{ asset('/img/logo_mithcare/nation_card.png') }}" >
                                    </div>
                                @endif
                            </div>
                            <div class="main-radius" id="health_card_3_new" class="m-2"></div>
                            <div class="form-group mt-3">
                                  <input class="form-control" name="health_card_3" type="file" id="health_card_3" value="{{ url('storage/'.$user->health_card_3 )}}"
                                  onchange="document.querySelector('#health_card_3_old').classList.add('d-none');" >
                            </div>
                        </div><!-- /.widget-content -->


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


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 {{-- กดอัพโหลดรูปโปรไฟล์->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#photo").change(function () {
            var img_profile_new = $("#img_profile_new");
            img_profile_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "300");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    img_profile_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>

{{-- กดอัพโหลดรูปบัตร 1->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_1").change(function () {
            var health_card_1_new = $("#health_card_1_new");
            health_card_1_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "300");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_1_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>

{{-- กดอัพโหลดรูปบัตร 2->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_2").change(function () {
            var health_card_2_new = $("#health_card_2_new");
            health_card_2_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "300");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_2_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>

{{-- กดอัพโหลดรูปบัตร 3->มองเห็นรูปที่เปลี่ยน --}}
<script type="text/javascript">
    $(function () {
        $("#health_card_3").change(function () {
            var health_card_3_new = $("#health_card_3_new");
            health_card_3_new.html("");
            $($(this)[0].files).each(function () {
                var file = $(this);
                var reader = new FileReader();
                reader.onload = function (e) {
                    var divImagePreview = $("<div/>");

                    var hiddenRotation = $("<input type='hidden' id='hfRotation' value='0' />");
                    divImagePreview.append(hiddenRotation);

                    var img = $("<img />");
                    // img.attr("style", "border-radius: 50%;");
                    // img.attr("class", "img-circle img-thumbnail isTooltip");
                    img.attr("width", "300");
                    img.attr("src", e.target.result);
                    divImagePreview.append(img);

                    health_card_3_new.append(divImagePreview);
                }
                reader.readAsDataURL(file[0]);
            });
        });
    });
</script>
