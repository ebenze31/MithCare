@extends('layouts.mithcare')

@section('content')

<!-- verify(เครื่องหมายถูก)  -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<style>
    .owl-nav{
        display: flex;
        justify-content: space-between;

        /* position: relative; */
    }
    .owl-prev,.owl-next {
        position: absolute;
        top: 30%;
        transform: translateY(-50%);
        font-size: 40px !important;
    }

    .owl-prev {
        left: -1rem;

    }
    .owl-next {
        right: -1rem;

    }
    .close {
        float: right;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        opacity: 1;
    }
    .slick-arrow{
        /* background-color: #4170A2; */
        color: #4170A2;
        line-height: 40px;

    }
    /* ลูกศร */
    .slick-arrow.slick-next:before, .slick-arrow.slick-prev:before {
        font-family: 'icomoon';
        font-size: 40px;
        font-weight: bold;
    }
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

    .text_topright {
        position: absolute;
        top: 8px;
        right: 12px;
        font-size: 14px;
        color: #058d39;
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

                        {{-- <div class="header_edit_member">
                            <div class="header-line_edit_member">
                                <div class="col-9 text-center">
                                    <span class="header-name1_edit_member">(ชื่อผู้ป่วย)</span>
                                    <br>
                                    <span class="header-name1_edit_member">Name 2</span>
                                </div>
                                <div class="col-3">
                                    <button class="header-close_edit_member">ยกเลิก</button>
                                </div>
                            </div>
                            <hr class="m-1 p-1" style="border-color:#4170A2">
                            <div class="header-line_edit_member text-center">
                                <span class="header-name2_edit_member text-center">(ชื่อผู้ดูแลเก่า) <br> Name 2</span>
                                <div class="vhr" style="border-color:#4170A2"></div>
                                <span class="header-name3_edit_member text-center">(ชื่อผู้ดูแลใหม่)  <br> Name 3</span>
                            </div>
                        </div> --}}

                    </div><!-- /.feature__content -->

                </div><!-- /.feature-item -->
            </div><!-- /.col-lg-3 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Features Layout 1 -->

 <!-- =================================================================================================
              คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม คอม
    ================================================================================================== -->
<section class="team-layout2 pb-80 ">
    <div class="container">

        <div id="member_show_of_room" class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                    <h3 class="heading__title">สมาชิกในบ้าน {{$amount_member}} คน  </h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        @foreach ($member as $item)
          <!--====================
            Modal แก้ไขสถานะของสมาชิก
            ======================-->

            <!-- Modal -->
            <div class="modal fade modal-slick_edit_member" id="edit_memberModal{{ $item->id }}" tabindex="-50" role="dialog"
                aria-labelledby="edit_memberModal{{ $item->id}}Title" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-hidden="true" >

                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_sos_btn_userTitle">แก้ไขสถานะ {{ $item->user->name }}</h5>
                                <span  type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_edit_member(event); clear_value_member_edit({{$item->user_id}});">
                                    <i class="fa-solid fa-circle-xmark p-0 m-0 " style="color: #4170A2;"></i>
                                </span>
                            </div>
                            <!-- แก้ไขสถานะของสมาชิก -->
                            <div class="modal-body">
                                <div class="container " style="font-weight :bold;">
                                    <form method="POST" action="{{ url('/member_of_room_edit'.'/'.$item->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}

                                        @include ('room.edit_member')

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div><!-- modal -->
            <!--========================
            End Modal แก้ไขสถานะของสมาชิก
            ============================-->
        @endforeach
        <div class="row ">
            <div class="col-12">
                <div class="slick-carousel" id="slick_edit_member"
                    data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": true, "dots": false,
                    "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}},
                     {"breakpoint": 767, "settings": {"slidesToShow": 1}},
                     {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
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
                                    <img src="{{asset('/img/สติกเกอร์ Mithcare/18.png')}}" alt="member img" height="300px" width="100%">
                                </div><!-- /.member-img -->
                            @endif
                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <div class="row d-flex justify-content-between align-item-center m-1">
                                <h4 class="member__name">{{$item->user->name}}</h4>

                                <!-- Auth:id == ไอดีเจ้าของห้อง-->
                                @if (Auth::user()->id == $find_owner->user_id)
                                    <!-- ไอเท็มที่มีสถานะ ไอดีเจ้าของห้อง ไม่ต้องแสดงปุ่มแก้ไข-->
                                    @if ($item->status != 'owner')
                                        <a class="btn-old btn-primary" onclick="edit_member(event,{{$item->user_id}},'{{$item->status}}','{{$item->room_id}}');"

                                        data-toggle="modal" data-target="#edit_memberModal{{$item->id}}">
                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>

                            @if ($item->status == 'owner')
                                <p class="member__job h5">สถานะ : เจ้าของบ้าน</p>
                            @elseif($item->status == 'member')
                                <p class="member__job h5">สถานะ : สมาชิก</p>
                                <p class="member__desc h5">ดูแลผู้ป่วย : </p>
                            @else
                                <p class="member__job h5">สถานะ : ผู้ป่วย</p>
                                @if ($item->lv_of_caretaker == 1)
                                    <p class="member__desc h5">เลเวล : {{$item->lv_of_caretaker}} (กดยืนยันใช้ยาเองได้)</p>
                                @else
                                    <p class="member__desc h5">เลเวล : {{$item->lv_of_caretaker}} (ไม่สามารถกดยืนยันใช้ยาเองได้)</p>
                                @endif
                            @endif
                                <br>
                                <!-- แสดงเบอร์โทร ตามสถานะ-->
                                @if ($member_from_login->user_id == Auth::user()->id)
                                    @if ($member_from_login->status == 'owner')
                                        <p class="member__desc h5">เบอร์โทร : {{$item->user->phone}}</p>
                                    {{-- @elseif($member_from_login->status == 'member')
                                        @php
                                            $check_ouput = "";
                                            if($item->caregiver){
                                                if($item->sub_cargiver){
                                                    $care_sub = explode(",",$item->sub_caregiver);
                                                    for ($i=0; $i < count($care_sub); $i++) {
                                                        if($care_sub[$i] == $item->user_id ){
                                                            $check_ouput = "";
                                                        }
                                                    }
                                                }else{

                                                }
                                            }elseif ($item->sub_caregiver) {
                                                $care_sub = explode(",",$item->sub_caregiver);
                                                for ($i=0; $i < count($care_sub); $i++) {
                                                    if($care_sub[$i] == $item->user_id ){
                                                        $check_ouput = "";
                                                    }
                                                }
                                            }else{
                                                $check_ouput = "d-none";
                                            }
                                        @endphp
                                            @if($item->user_id == $member_from_login->user_id)
                                                <p class="member__desc h5 ">เบอร์โทร : {{$item->user->phone}}</p>
                                            @endif
                                        <p class="member__desc h5 {{$check_ouput}}">เบอร์โทร : {{$item->user->phone}}</p>
                                    @else
                                        @php
                                            $check_ouput2 = "";
                                            if($item->caregiver){
                                                $memtk2 = explode(",",$item->caregiver);
                                                for ($i=0; $i < count($memtk2); $i++) {
                                                        if($memtk2[$i] == $item->user_id ){
                                                            $check_ouput2 = "";
                                                        }
                                                }
                                            }else{
                                                $check_ouput2 = "d-none";
                                            }
                                        @endphp --}}

                                        <p class="member__desc h5 {{$check_ouput2}}">เบอร์โทร : {{$item->user->phone}}</p>
                                    @endif
                                @endif


                        </div><!-- /.member-info -->
                    </div><!-- /.member -->
                    @endforeach
                </div><!-- /.carousel -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->

        <!-- ======================
            TEST CARD EDIT V.2
        ========================= -->


        <!-- ======================
            TEST CARD EDIT V.1
        ========================= -->


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
        // let x = document.querySelector('#div_member_of_room_card');
        // for(i = 0; i<x.length; i++){
        //     document.getElementById('takecare_fr'+x).classList.add('d-none');
        //     document.getElementById('lv_caretaker_fr'+x).classList.add('d-none');
        // }

});

// function show_input_fr(user_id){
//     let select_takecare = document.getElementsByName("select_takecare"+ user_id);
//     //  console.log(show_input_fr(user_id));
//     if (document.getElementById("status_member_of_room"+ user_id).checked) {
//         let takecare_fr = document.querySelector('#takecare_fr'+user_id).classList ;
//             // console.log(div_date);
//             takecare_fr.remove('d-none');
//             // takecare_fr.add('col-12');
//         document.querySelector('#lv_caretaker_fr'+user_id).classList.add('d-none');
//         document.querySelector('#lv_caretaker_fr'+user_id).required = false ;


//         let radio_lv_takecare = document.getElementsByName('lv_of_caretaker'+user_id);
//             // document.querySelector('#select_takecare').value = "";

//         for (let i = 0; i < radio_lv_takecare.length; i++) {
//             radio_lv_takecare[i].checked = false ;
//             }
//     }else {
//          let lv_caretaker_fr = document.querySelector('#lv_caretaker_fr'+user_id).classList;
//             // console.log(div_date);
//             lv_caretaker_fr.remove('d-none');
//             // lv_caretaker_fr.add('col-12');
//             document.querySelector('#takecare_fr'+user_id).classList.add('d-none');
//             document.querySelector('#takecare_fr'+user_id).required = false ;
//             document.querySelector('.lv_of_caretaker'+user_id).required = true ;

//             let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare'+user_id);
//             document.querySelector('#select_takecare'+user_id).value = "";
//             console.log(checkbox_select_takecare);
//             console.log(document.querySelector('#select_takecare'+user_id).value );

//             for (let i = 0; i < checkbox_select_takecare.length; i++) {
//                 checkbox_select_takecare[i].checked = false ;
//             }
//     }
// }

</script>

<script>
    function edit_member(event,user_id_member_of_room,status,room_id) {
        console.log(user_id_member_of_room);
        if(status == 'member'){
            document.querySelector('#status_member_of_room'+user_id_member_of_room).click();
        }else{
            document.querySelector('#status_patient_of_room'+user_id_member_of_room).click();
        }

        const url = "{{ url('/') }}/api/member_for_checkbox" + "/" + room_id + "/" + user_id_member_of_room + "/" + status ;
        axios.get(url).then((response) => {
            console.log(response);
            // let result = JSON.stringify(response['data']);
            // console.log("user_id :"+user_id);
            // console.log("status :"+status);
            // console.log("lv_of_caretaker :"+lv_of_caretaker);
            // console.log("member_takecare :"+member_takecare);
            // console.log(JSON.stringify(member_takecare));
            // console.log(result);
            // const arr = member_takecare.split(",");

            if(status == 'member'){
                // console.log(result);
                document.getElementById('status_member_of_room'+user_id).click();

                // for (let index = 0; index < arr.length; index++) {
                //     // console.log(arr[index]);
                //     // console.log(result['user_id']);

                //     if(arr[index] === result['user_id']){

                //         document.getElementById('checkbox_select_member_takecare'+user_id).click();
                //     }


                // }

                // for (let i = 0; i < response['user_id'].length; i++) {

                //             console.log("deer");



                // }



            }else{
                console.log("else");

                document.getElementById('status_patient_of_room'+user_id).click();
            }

        }).catch((error) => {
            console.log(error);
        });






















      // Prevent the default behavior of the click event
      event.preventDefault();

      // Stop the autoplay of the carousel
    //   $('#slick_edit_member').slick('slickPause');
      $('#slick_edit_member').slick('slickSetOption', 'autoplay', false).slick('slickPause');
      // Open the modal or perform any other actions related to editing the member
      // ...

      // Once the editing is done, resume the autoplay of the carousel
    //   $('#slick_edit_member').slick('slickPlay');
    }

    function close_edit_member(event) {

        // console.log("slick Play")
        event.preventDefault();
        $('#slick_edit_member').slick('slickSetOption', 'autoplay', true).slick('slickPlay');
    }
  </script>




