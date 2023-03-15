@extends('layouts.mithcare')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<style>


    label{
        width: 100%
    }

    .card-input-element+.card {
        height: calc(40px + 2*1rem);
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
        font-size: 12px;
    }

    .div_alert{
    position: fixed;
    top: -500px;
    left: 0;
    width: 100%;
    text-align: center;
    font-family: 'Kanit', sans-serif;
    z-index: 9999;
    display: flex;
    justify-content: center;
}
.div_alert i{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    max-width: 70px;
    height: 50px;
    background-color: #ffddde;
    border-radius: 50%;
    color: #ff5757;
    font-size: 1.5rem;
    margin-left: 1.5rem;

}

.up-down {
  animation-name: slideDownAndUp;
  animation-duration: 2s;
}

@keyframes slideDownAndUp {
  0% {
    transform: translateY(0);
  }

  10% {
    transform: translateY(520px);
  }

  90% {
    transform: translateY(520px);
  }

 100% {
    transform: translateY(0);
 }
}
.alert-child{
    background-color: #db2d2e;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 15px;
    height: 5rem;
    width: 90%;
    padding:20px 10px;
}.text-alert{
    color: #fff;
    float: left;
}

.hover-end{
    padding:0;
    margin:0;
    font-size:75%;
    text-align:center;
    position:absolute;
    bottom:0;
    width:100%;
    opacity:.8
}
</style>

<div id="alert_phone" class=" div_alert " role="alert">
    <div class="alert-child">
        <div >
            <span class="d-block  text-alert font-weight-bold">มีข้อผิดพลาด</span>
            <span class="d-block  text-alert">โปรดกรอกข้อมูลให้ครบถ้วน</span>
        </div>
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">{{ Auth::user()->name }}</h1>

                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a>
                            </li>


                        </ol>
                    </div>
                    <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน </a>
                            </li>


                        </ol>
                    </div>
                    <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->



<section id="head_content" class="page-title page-title-layout5">
    <div class="container">
        <div class="row">

            <div class="container mt-3">
                <div class="row d-flex justify-content-end ">
                    <!-- <a href="#" class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                        <i class="fa fa-plus"></i>เพิ่มตารางนัดหมอ/กินยา</a> -->
                    <a  class="btn btn-primary btn-sm main-shadow main-radius mr-2"
                        style="font-size: 20px; color:#ffffff;" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มตารางนัดหมอ/ใช้ยา
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- หน้าสร้างตารางนัด -->
                                <div class="container">
                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">
                                            {{-- <div class="lds-ring"><div></div><div></div><div></div><div></div></div> --}}
                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">
                                                <h3 class="heading__title"><i class="fa-solid fa-home "></i> เพิ่มตารางนัด</h3>
                                                <br />
                                                <br />
                                                @if ($errors->any())
                                                <ul class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif

                                                <form method="POST" name="appoint_create_form" id="appoint_create_form"
                                                    action="{{ url('/appoint/'. $room->id . '/create') }}"
                                                    accept-charset="UTF-8" class="form-horizontal h5"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                   <!--///  สถานะ ไม่ใช่ผู้ป่วย /// -->
                                                   <label for="title" class="control-label">{{ 'เลือกนัดหมายให้' }}</label>
                                                    @if ($check_status_member->status == 'member' || $check_status_member->lv_of_caretaker == '1')
                                                        <div class="home-demo">
                                                            <div class="owl-carousel aasdaa owl-theme">
                                                                <div class="col-12 p-0">
                                                                    <label>
                                                                        {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                                                    <input class="card-input-element d-none patient_id_create" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                            <span style="font-size:16px;">
                                                                                {{Auth::user()->name}}
                                                                            </span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                @foreach($patient_with_caregiver as $item)
                                                                    <div class="item">
                                                                        <!--///  เลือกผู้ป่วย /// -->

                                                                        <div class="col-12 p-0">
                                                                            <label>
                                                                            <input class="card-input-element d-none patient_id_create" id="radio_patient{{$item->id}}" name="patient_id" type="radio" value="{{$item->user_id}}" >
                                                                                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                    @switch($item->status)
                                                                                    @case('patient')
                                                                                        @if($item->lv_of_caretaker == '1')
                                                                                            <a class="text_topright" style="color:#383535">(ผู้ป่วย lv1)</a>
                                                                                        @else
                                                                                            <a class="text_topright" style="color:#383535">(ผู้ป่วย lv2)</a>
                                                                                        @endif
                                                                                        @break
                                                                                    @case('member')
                                                                                        <a class="text_topright" style="color:#383535">(สมาชิก)</a>
                                                                                        @break
                                                                                    @default

                                                                                @endswitch
                                                                                    <span style="font-size:16px;">
                                                                                        {{$item->user->full_name}}
                                                                                    </span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @elseif ($check_status_member->status == 'owner')
                                                        <div class="home-demo">
                                                            <div class="owl-carousel aasdaa owl-theme">
                                                                <div class="col-12 p-0">
                                                                    <label>
                                                                        {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                                                    <input class="card-input-element d-none patient_id_create" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                            <span style="font-size:16px;">
                                                                                {{Auth::user()->name}}
                                                                            </span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                @foreach($all_member_of_room as $item)
                                                                    <div class="item">
                                                                        <!--///  เลือกผู้ป่วย /// -->

                                                                        <div class="col-12 p-0">
                                                                            <label>
                                                                            <input class="card-input-element d-none patient_id_create" id="radio_patient{{$item->id}}" name="patient_id" type="radio" value="{{$item->user_id}}" >
                                                                                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                    @switch($item->status)
                                                                                        @case('patient')
                                                                                            @if($item->lv_of_caretaker == '1')
                                                                                                <a class="text_topright" style="color:#383535">(ผู้ป่วย lv1)</a>
                                                                                            @else
                                                                                                <a class="text_topright" style="color:#383535">(ผู้ป่วย lv2)</a>
                                                                                            @endif
                                                                                            @break
                                                                                        @case('member')
                                                                                            <a class="text_topright" style="color:#383535">(สมาชิก)</a>
                                                                                            @break
                                                                                        @default

                                                                                    @endswitch
                                                                                    {{-- <a class="text_topright" style="color:#383535">({{$item->status}})</a> --}}
                                                                                    <span style="font-size:16px;">
                                                                                        {{$item->user->full_name}}
                                                                                    </span>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="home-demo">
                                                            <div class="owl-carousel aasdaa owl-theme">
                                                                <div class="col-12 p-0">
                                                                    <label>
                                                                    <input class="card-input-element d-none patient_id_create" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                            <span style="font-size:16px;">
                                                                                {{Auth::user()->name}}
                                                                            </span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @include ('appoint.appoint_form_create')
                                                </form>

                                                <script>
                                                    $(function() {
                                                    // Owl Carousel
                                                    var owl = $(".aasdaa");
                                                    owl.owlCarousel({
                                                        items: 2,
                                                        margin: 10,
                                                        loop: false,
                                                        nav: false,
                                                    });
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- modal -->

                    <div class="modal fade" id="edit_Appoint" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- แก้ไขตารางนัด -->
                                <div class="container">

                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">

                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">

                                                    <h3><i class="fa-solid fa-calendar-days"></i> แก้ไขตารางนัด</h3>
                                                    <br />
                                                    <br />


                                                    @if ($errors->any())
                                                    <ul class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @endif


                                                    <form method="POST" action="{{ url('/appoint/edit') }}"
                                                        accept-charset="UTF-8" class="form-horizontal h5"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                         <!--///  สถานะ ไม่ใช่ผู้ป่วย /// -->
                                                        <label for="title" class="control-label">{{ 'เลือกนัดหมายให้' }}</label>
                                                        @if ($check_status_member->status != 'patient')
                                                            <div class="home-demo">
                                                                <div class="owl-carousel aasdaa owl-theme">
                                                                    <div class="col-12 p-0">
                                                                        <label>
                                                                            {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                                                        <input class="card-input-element d-none" id="radio_owner_edit" name="patient_id_edit" type="radio" value="{{Auth::user()->id}}">
                                                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                                <span style="font-size:16px;">
                                                                                    {{Auth::user()->name}}
                                                                                </span>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    @foreach($patient_with_caregiver as $item)
                                                                        <div class="item">
                                                                            <!--///  เลือกผู้ป่วย /// -->

                                                                            <div class="col-12 p-0">
                                                                                <label>
                                                                                <input class="card-input-element d-none" id="radio_patient{{$item->id}}" name="patient_id_edit" type="radio" value="{{$item->user_id}}">
                                                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                    @switch($item->status)
                                                                                        @case('patient')
                                                                                            @if($item->lv_of_caretaker == '1')
                                                                                                <a class="text_topright" style="color:#383535">(ผู้ป่วย lv1)</a>
                                                                                            @else
                                                                                                <a class="text_topright" style="color:#383535">(ผู้ป่วย lv2)</a>
                                                                                            @endif
                                                                                            @break
                                                                                        @case('member')
                                                                                            <a class="text_topright" style="color:#383535">(สมาชิก)</a>
                                                                                            @break
                                                                                        @default

                                                                                    @endswitch
                                                                                        <span style="font-size:16px;">
                                                                                            {{$item->user->full_name}}
                                                                                        </span>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        @elseif ($check_status_member->status == 'owner')
                                                            <div class="home-demo">
                                                                <div class="owl-carousel aasdaa owl-theme">
                                                                    <div class="col-12 p-0">
                                                                        <label>
                                                                            {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                                                        <input class="card-input-element d-none patient_id_create" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                                <span style="font-size:16px;">
                                                                                    {{Auth::user()->name}}
                                                                                </span>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    @foreach($all_member_of_room as $item)
                                                                        <div class="item">
                                                                            <!--///  เลือกผู้ป่วย /// -->

                                                                            <div class="col-12 p-0">
                                                                                <label>
                                                                                <input class="card-input-element d-none patient_id_create" id="radio_patient{{$item->id}}" name="patient_id" type="radio" value="{{$item->user_id}}" >
                                                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                        @switch($item->status)
                                                                                            @case('patient')
                                                                                                @if($item->lv_of_caretaker == '1')
                                                                                                    <a class="text_topright" style="color:#383535">(ผู้ป่วย lv1)</a>
                                                                                                @else
                                                                                                    <a class="text_topright" style="color:#383535">(ผู้ป่วย lv2)</a>
                                                                                                @endif
                                                                                                @break
                                                                                            @case('member')
                                                                                                <a class="text_topright" style="color:#383535">(สมาชิก)</a>
                                                                                                @break
                                                                                            @default

                                                                                        @endswitch
                                                                                        {{-- <a class="text_topright" style="color:#383535">({{$item->status}})</a> --}}
                                                                                        <span style="font-size:16px;">
                                                                                            {{$item->user->full_name}}
                                                                                        </span>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="home-demo">
                                                                <div class="owl-carousel aasdaa owl-theme">
                                                                    <div class="col-12 p-0">
                                                                        <label>
                                                                        <input class="card-input-element d-none" id="radio_owner_edit" name="patient_id_edit" type="radio" value="{{Auth::user()->id}}">
                                                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                <a class="text_topright" style="color:#383535">(ตัวเอง)</a>
                                                                                <span style="font-size:16px;">
                                                                                    {{Auth::user()->name}}
                                                                                </span>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <input type="hidden" name="appoint_id" id="appoint_id" value="" />
                                                        @include ('appoint.appoint_form_edit')

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button class="btn-old btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">บันทึก</button>
                                                        </div>
                                                    </form>
                                                        <div class="col-6">
                                                            <form id="appoint_delete" method="POST" action="" accept-charset="UTF-8">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                    <button type="submit" class="btn-old btn-primary form-control" style="background-color: #e3342f; font-size: 25px; color: white;" title="Delete Appoint" onclick="return confirm('ต้องการลบใช่หรือไม่')">
                                                                        <i class="fa-solid fa-trash"></i> ลบ
                                                                    </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            <!--container -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- modal -->

                </div>
            </div>
            <div class="contact-panel col-md-12 mb-2 mt-3">
                <h3>
                    <span class="text-dark">ตาราง</span>
                    @if ($type == 'doc')
                        <span class="text-success">นัดหมอ</span>
                    @elseif($type == 'pill')
                        <span class="text-info">ใช้ยา</span>
                    @else
                        <span class="text-dark">ทั้งหมด</span>
                    @endif
                </h3>

                @php
                    switch ($type) {
                        case 'doc':
                            $color_doc = "btn-success";
                            $color_pill = "btn-outline-info";
                            $color_all = "btn-outline-dark";
                            break;
                        case 'pill':
                            $color_doc = "btn-outline-success";
                            $color_pill = "btn-info";
                            $color_all = "btn-outline-dark";
                            break;
                        default:
                            $color_doc = "btn-outline-success";
                            $color_pill = "btn-outline-info";
                            $color_all = "btn-dark";
                            break;
                    }
                @endphp

                <div class="row" id="appoint_selector">
                    <div class="col-12 col-md-10 mt-2">
                        <a id="all" style="border: #000 solid 1px;" class="btn-old {{$color_all}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}#head_content">ทั้งหมด</a>
                        <a id="doc" style="border: #38c172 solid 1px;" class="btn-old {{$color_doc}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=doc#head_content">นัดหมอ</a>
                        <a id="pill" style="border: #21cdc0 solid 1px;" class="btn-old {{$color_pill}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=pill#head_content">ใช้ยา</a>
                    </div>
                    <div class="col-6 col-md-2 column mt-2">
                      <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #38c172;"></i> นัดหมอ</a><br>
                       <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #21cdc0;"></i> ใช้ยา</a>
                    </div>
                </div>

                <!-- ///////////////////////////////////////////
                //////////////// Calendar //////////////////////
                //////////////////////////////////////////////// -->

                <div class="mt-3" id='calendar' style="width: 100%;"></div>
                <div class="mt-3" id='event_mouseover'></div>
            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection

<script src="{{ asset('mithcare/js/fullcalendar/js/main.min.js') }}"></script>
<script>
const date_now_Y_m = Date.now('Y-m');



document.addEventListener('DOMContentLoaded', function() {
    //mobile check
    window.mobilecheck = function() {
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
        },
        // footerToolbar: {
        //     center:
        // },
        buttonText: {
            today:    'วันนี้',
            month:    'เดือน',
            week:     'สัปดาห์',
            day:      'วัน',
            list:     'รายการ'
        },
        initialView: window.mobilecheck() ? 'listWeek' : 'dayGridMonth',
        initialDate: date_now_Y_m,
        // height: 'auto',
        contentHeight: 'auto', //ความสูงอัติโนมัติ
        handleWindowResize: true,
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        editable: false, //ลากเพื่อเปลี่ยนตารางนัด
        selectable: true,
        businessHours: true,
        dayMaxEvents: true, // allow "more" link when too many events
        timeZone: 'Asia/Bangkok',
        locale: 'th',
        eventDisplay: 'block',
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },

        events: [
            @foreach($appoint as $ap) {
                id: '{{ $ap->id }}',
                title: '{{ $ap->title }}',

                @if(!empty($ap-> date_time))
                    // ใช้ยา
                    start: '{{ $ap->date }} {{ $ap->date_time }}',
                    color: '#21cdc0'
                @else
                    // นัดหมอ
                    start: '{{ $ap->date }}',
                    color: '#38c172'
                @endif

            },
            @endforeach

        ],

        // eventMouseover: function(event, jsEvent, view) {
        //     $('#event_mouseover', this).append('<div id="'+event.id+'">' + 'deer' + '</div>');
        // },

        // eventMouseout: function(event, jsEvent, view) {
        //     $('#'+event.id).remove();
        // },

        eventClick: function(calEvent, jsEvent, view) {

            let appoint_id = calEvent['event']['_def']['publicId'];

            document.querySelector('#appoint_id').value = appoint_id;

            document.querySelector('#appoint_delete').action = '{{ url("/appoint" ) }}' + '/' + appoint_id;

            fetch("{{ url('/') }}/api/get_data_appoint/" + appoint_id)
                //AppointController
                .then(response => response.json())
                .then(result => {
                    // console.log(result.type);

                    if (result.type === 'doc') {
                        document.querySelector('.date_edit').value = result.date;

                        let div_date = document.querySelector('#div_date_edit').classList ;
                            // console.log(div_date);
                            div_date.remove("col-md-6");
                            div_date.remove('d-none');
                            div_date.add('col-md-12');
                        document.querySelector('#div_datetime_edit').classList.add('d-none');
                        document.querySelector('#date_time_edit').required = false ;
                    } else {
                        document.querySelector('.date_edit').value = result.date;
                        document.querySelector('.date_time_edit').value = result.date_time;

                        let div_date = document.querySelector('#div_date_edit').classList;
                            // console.log(div_date);
                            div_date.remove("col-md-12");
                            div_date.remove('d-none');
                            div_date.add('col-md-6');
                        document.querySelector('#div_datetime_edit').classList.remove('d-none');
                        document.querySelector('#date_time_edit').required = true ;

                    }

                    document.querySelector('.title_edit').value = result.title;


                    //checked radio form patient_id
                    let patient_edit = document.getElementsByName('patient_id_edit');

                    for (let r = 0; r < patient_edit.length; r++) {
                        if(patient_edit[r].value === result.patient_id){
                            patient_edit[r].checked = true;
                        }
                    }

                    // let type_appoint_edit = document.querySelector('.type_appoint_edit');
                    console.log(result.type)
                    if(result.type === 'doc'){
                        document.querySelector('#type_doc_edit').checked = true;
                        document.querySelector('#type_pill_edit').checked = false;
                    }else{
                        document.querySelector('#type_pill_edit').checked = true;
                        document.querySelector('#type_doc_edit').checked = false;
                    }
                });

            $('#edit_Appoint').modal();


        },


    });
    calendar.render();
});

</script>

<script>

    function edit_type(type_edit) {
    //   let type = document.querySelector('.type_appoint_edit').value;
    console.log(type_edit);
      if (type_edit === 'doc') {
            let div_date = document.querySelector('#div_date_edit').classList ;
                // console.log(div_date);
                div_date.remove("col-md-6");
                div_date.remove('d-none');
                div_date.add('col-md-12');
            document.querySelector('#div_datetime_edit').classList.add('d-none');
            document.querySelector('#date_time_edit').required = false ;
        }else {
            let div_date = document.querySelector('#div_date_edit').classList;
                // console.log(div_date);
                div_date.remove("col-md-12");
                div_date.remove('d-none');
                div_date.add('col-md-6');
            document.querySelector('#div_datetime_edit').classList.remove('d-none');
            document.querySelector('#date_time_edit').required = true
        }
    }

</script>

<script>

    function select_takecare_lv2(id){
    switch(id){
        case "select_a":

            document.getElementById("select_a").classList.add('d-none');
            document.getElementById("select_b").classList.remove('d-none');

            document.getElementById("div_select_takecare_of_create_appoint").classList.remove('d-none');
            document.getElementById("input_patient_this_room").required = true;

            break;
        case "select_b":

            document.getElementById("select_a").classList.remove('d-none');
            document.getElementById("select_b").classList.add('d-none');

            document.getElementById("div_select_takecare_of_create_appoint").classList.add('d-none');
            document.getElementById("input_patient_this_room").required = false;
            document.getElementById("input_patient_this_room").value = "";
    }
}

    function check_input_appoint_create(){

            let title_appoint_create = document.querySelector('.title_appoint_create').value;
            let date_appoint_create = document.querySelector('.date_appoint_create').value;
            let time_appoint_create = document.querySelector('.time_appoint_create').value;

            let patient_id = document.querySelector(".patient_id_create:checked");
            let patient_id_value;
            if(patient_id){
                patient_id_value = patient_id.value;
            }else{
                patient_id_value = "";
            }

            let type_appoint_create = document.querySelector(".type_appoint_create:checked");
            let type_appoint_value;
            if(type_appoint_create){
                type_appoint_value = type_appoint_create.value;
            }else{
                type_appoint_value = "";
            }

            if(patient_id_value !== "" && type_appoint_value !== "" && title_appoint_create !== "" && date_appoint_create !== ""){
                if(type_appoint_value == 'pill' && time_appoint_create !== ""){
                    document.querySelector('#appoint_create_form').submit();
                }else if(type_appoint_value == 'doc'){
                    document.querySelector('#appoint_create_form').submit();
                }else{
                    document.querySelector('#alert_phone').classList.add('up-down');

                    const animated = document.querySelector('.up-down');
                    animated.onanimationend = () => {
                        document.querySelector('#alert_phone').classList.remove('up-down');
                    };
                }
            }else{

                document.querySelector('#alert_phone').classList.add('up-down');

                const animated = document.querySelector('.up-down');
                animated.onanimationend = () => {
                    document.querySelector('#alert_phone').classList.remove('up-down');
                };
            }


    }


</script>
