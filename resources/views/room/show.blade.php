@extends('layouts.mithcare')

@section('content')

<!-- verify(เครื่องหมายถูก)  -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

<!-- Checkbox and Radio CSS -->
<style>
    label{
        width: 100%
    }
    .card-input-element+.card {
    height: calc(36px + 2*1rem);
    color: #0d6efd;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 2px solid transparent;
    border-radius: 10px;
    }

    .card-input-element+.card:hover {
    cursor: pointer;
    }

    .card-input-element:checked+.card {
    border: 2px solid #0d6efd;
    color: #4170A2 !important;
    background-color: #ffffff !important;
    -webkit-transition: border .3s;
    -o-transition: border .3s;
    transition: border .3s;
    }

    .card-input-element:checked+.card::after {
    content: '\e5ca';
    color: #AFB8EA;
    font-family: 'Material Icons';
    font-size: 24px;
    -webkit-animation-name: fadeInCheckbox;
    animation-name: fadeInCheckbox;
    -webkit-animation-duration: .5s;
    animation-duration: .5s;
    -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    @-webkit-keyframes fadeInCheckbox {
    from {
    opacity: 0;
    -webkit-transform: rotateZ(-20deg);
    }
    to {
    opacity: 1;
    -webkit-transform: rotateZ(0deg);
    }
    }

    @keyframes fadeInCheckbox {
    from {
    opacity: 0;
    transform: rotateZ(-20deg);
    }
    to {
    opacity: 1;
    transform: rotateZ(0deg);
    }
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

 <!-- =================================================================================================
              คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม
    ================================================================================================== -->
<section class="team-layout2 pb-80 d-none d-lg-block">
    <div class="container">

        <div id="member_show_of_room" class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h3 class="heading__title">สมาชิกในบ้าน {{$amount_member}} คน
                        @if (Auth::id() == $room->owner_id)
                            <a class="btn-old btn-primary " href="{{ url('member_of_room_edit')}}?room_id={{$room->id}}"><i class="fa-solid fa-pen-to-square text-white"></i></a>
                        @endif

                        <!--====================
                        Modal แก้ไขสถานะของสมาชิก
                        ======================-->

                        {{-- <div class="modal fade" id="edit_member_of_room" tabindex="-1" role="dialog" aria-labelledby="edit_member_of_roomTitle" aria-hidden="true">
                            <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <!-- Modal แก้ไขสถานะของสมาชิก -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="contact-panel col-md-12 mb-2">

                                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <div class="container">
                                                <h3 ><i class="fa-solid fa-pen-to-square "></i> จัดการสมาชิก</h3>
                                                    <br />
                                                    <br />
                                                    @if ($errors->any())
                                                    <ul class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                    <form method="POST" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        @include ('room.form_create')

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!--========================
                        End Modal แก้ไขสถานะของสมาชิก
                        ============================-->

                    </h3>
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
                                    <img src="https://www.viicheck.com/Medilab/img/icon.png" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif
                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <h5 class="member__name"><a href="">{{$item->user->name}}</a></h5>
                            @if ($item->status == 'owner')
                                <p class="member__job ">สถานะ : เจ้าของบ้าน</p>
                            @elseif($item->status == 'member')
                                <p class="member__job ">สถานะ : สมาชิก</p>
                                <p class="member__job ">ดูแลผู้ป่วย : </p>
                            @else
                                <p class="member__job ">สถานะ : ผู้ป่วย</p>
                                @if ($item->lv_of_caretaker == 1)
                                    <p class="member__desc">เลเวล : {{$item->lv_of_caretaker}} (กดยืนยันใช้ยาเองได้)</p>
                                @else
                                    <p class="member__desc">เลเวล : {{$item->lv_of_caretaker}} (ไม่สามารถกดยืนยันใช้ยาเองได้)</p>
                                @endif
                            @endif

                        </div><!-- /.member-info -->
                    </div><!-- /.member -->
                    @endforeach
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->

        <!-- ======================
            TEST CARD EDIT V.1
        ========================= -->
        <div id="member_edit_of_room" class="row d-none">
            <div class="col-12">
                <div class="slick-carousel"
                    data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": false, "arrows": false, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                    <!-- Member #1 -->
                    @foreach ($member as $item)
                    <div  class="member">
                        <input id="div_member_of_room_card" class="d-none" value="{{$item->user_id}}" disabled>
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
                                    <img src="https://www.viicheck.com/Medilab/img/icon.png" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif
                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <h5 class="member__name"><a href="">{{$item->user->name}}</a></h5>
                                {{-- สถานะ --}}
                                <div class="row ">
                                    <div class="col-12 col-md-12 col-lg-12 from-group">
                                        <label for="status" class="control-label" style="font-size: 20px;">{{ 'สถานะ' }}</label>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 from-group">
                                        <label>
                                            <input class="card-input-element d-none" id="status_member_of_room{{$item->user_id}}" name="status_of_room{{$item->user_id}}" type="radio" onclick="show_input_fr({{$item->user_id}});" value="member" {{ (isset($item) && 'member' == $item->status) ? 'checked' : '' }} required>
                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                <span>
                                                    สมาชิก : {{$item->user_id}}
                                                </span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 from-group">
                                        <label>
                                            <input class="card-input-element d-none" id="status_patient_of_room{{$item->user_id}}" name="status_of_room{{$item->user_id}}" type="radio" onclick="show_input_fr({{$item->user_id}});" value="patient" {{ (isset($item) && 'patient' == $item->status) ? 'checked' : '' }} required>
                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                <span>
                                                    ผู้ป่วย : {{$item->user_id}}
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <hr>


                                <div id="takecare_fr{{$item->user_id}}" class="row ">
                                    <label for="status" class="control-label" style="font-size: 20px;">{{ 'เลือกผู้ที่ต้องการดูแล' }}</label>
                                    <div class="col-12">
                                        <div class="slick-carousel"
                                            data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "autoplay": false, "arrows": true, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                                            <!--///  เลือกผู้ดูแล /// -->
                                            <div id="" class="form-group">
                                                <div class="row">
                                                    @foreach($this_room as $item)
                                                    <div class="col-6">
                                                        <label>
                                                            {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                                        <input class="card-input-element d-none" id="checkbox_select_takecare{{$item->user_id}}" name="checkbox_select_takecare{{$item->user_id}}" type="checkbox" onclick="click_Select_Takecare({{$item->user_id}});" value="member_takecare" {{ (isset($item) && 'member_takecare' == $item->member_takecare) ? 'checked' : '' }} value="{{$item->user_id}}">
                                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center"
                                                                <span>
                                                                    {{$item->user->name}}
                                                                </span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <input class="form-control d-none" type="text" name="select_takecare{{$item->user_id}}" id="select_takecare{{$item->user_id}}">
                                            </div>
                                        </div><!-- /.slick-carousel -->
                                        <div class="home-demo">
                                                            <div class="owl-carousel aasdaa owl-theme">
                                                                <div class="col-12 p-0">
                                                                    <label>
                                                                    <input class="card-input-element d-none" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}">
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <span style="font-size:16px;">
                                                                                {{Auth::user()->name}}
                                                                            </span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                    </div> <!-- /.col-12 -->
                                </div><!-- /.row -->

                                <div id="lv_caretaker_fr{{$item->user_id}}" class="row ">
                                    <div class="col-12 col-md-12 col-lg-12 from-group">
                                        <label for="status" class="control-label" style="font-size: 20px;">{{ 'กรุณาเลือกระดับผู้ป่วย' }}</label>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 from-group">
                                        <label>
                                            <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_1_of_caretaker{{$item->user_id}}"  name="lv_of_caretaker{{$item->user_id}}" type="radio" value="1" {{ (isset($item) && '1' == $item->lv_of_caretaker) ? 'checked' : '' }}>
                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                <span>
                                                    ระดับ 1
                                                </span>
                                            </div>
                                        </label>
                                    </div>


                                    <div class="col-12 col-md-6 col-lg-6 from-group">
                                        <label>
                                            <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_2_of_caretaker{{$item->user_id}}" name="lv_of_caretaker{{$item->user_id}}" type="radio" value="2" {{ (isset($item) && '2' == $item->lv_of_caretaker) ? 'checked' : '' }}>
                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                <span>
                                                    ระดับ 2
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                        </div><!-- /.member-info -->
                    </div><!-- /.member -->
                    @endforeach
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->

    </div><!-- /.container -->
</section><!-- /.Team -->


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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let x = document.querySelector('#div_member_of_room_card');
        for(i = 0; i<x.length; i++){
            document.getElementById('takecare_fr'+x).classList.add('d-none');
            document.getElementById('lv_caretaker_fr'+x).classList.add('d-none');
        }

});

function show_input_fr(user_id){
    let select_takecare = document.getElementsByName("select_takecare"+ user_id);
    //  console.log(show_input_fr(user_id));
    if (document.getElementById("status_member_of_room"+ user_id).checked) {
        let takecare_fr = document.querySelector('#takecare_fr'+user_id).classList ;
            // console.log(div_date);
            takecare_fr.remove('d-none');
            // takecare_fr.add('col-12');
        document.querySelector('#lv_caretaker_fr'+user_id).classList.add('d-none');
        document.querySelector('#lv_caretaker_fr'+user_id).required = false ;


        let radio_lv_takecare = document.getElementsByName('lv_of_caretaker'+user_id);
            // document.querySelector('#select_takecare').value = "";

        for (let i = 0; i < radio_lv_takecare.length; i++) {
            radio_lv_takecare[i].checked = false ;
            }

    }else {
         let lv_caretaker_fr = document.querySelector('#lv_caretaker_fr'+user_id).classList;
            // console.log(div_date);
            lv_caretaker_fr.remove('d-none');
            // lv_caretaker_fr.add('col-12');
            document.querySelector('#takecare_fr'+user_id).classList.add('d-none');
            document.querySelector('#takecare_fr'+user_id).required = false ;
            document.querySelector('.lv_of_caretaker'+user_id).required = true ;

            let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare'+user_id);
            document.querySelector('#select_takecare'+user_id).value = "";

            for (let i = 0; i < checkbox_select_takecare.length; i++) {
                checkbox_select_takecare[i].checked = false ;
            }
    }
}

</script>

<script>
function click_Select_Takecare(user_id){
    let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare'+ user_id);
    let select_takecare = document.querySelector('#select_takecare'+ user_id);
    // console.log(checkbox_select_takecare);
    select_takecare.value = "" ;
    for (let i = 0; i < checkbox_select_takecare.length; i++) {
        if (checkbox_select_takecare[i].checked) {
            if (select_takecare.value === "") {
                select_takecare.value = checkbox_select_takecare[i].value ;
            }else{
                select_takecare.value = select_takecare.value + "," +  checkbox_select_takecare[i].value ;
            }
        }
    }
}
</script>
