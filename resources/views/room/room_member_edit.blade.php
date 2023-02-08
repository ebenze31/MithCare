@extends('layouts.mithcare')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
{{-- Tab Content --}}
<style>

    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #21cdc0;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
    </style>





<section class="page-title page-title-layout5 mb-3 ">

    <div class="container card radius-10 " >

        <div class="row">
            <div class="col-12" style="margin-top:10px">
                <div class="card-header border-bottom-0 bg-transparent">

                        <h5 class="font-weight-bold mb-1 ">จัดการสมาชิก</h5>
                        <div class="tab col-12 col-md-4 col-lg-4">
                                <button class="tablinks col-6" onclick="openCity(event, 'Member')">สมาชิก</button>
                                <button class="tablinks col-6" onclick="openCity(event, 'Patient')">ผู้ป่วย</button>
                        </div>
                        <hr >
                        {{-- <form method="GET" action="{{ url('/health_check') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right " role="search">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control d" name="search" placeholder="ค้นหา"
                                    value="{{ request('search') }}">

                                <span class="input-group-append ">
                                    <button class="btn-old btn-info"  type="submit"
                                    style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px; border-color:#495057" >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form> --}}



                </div>
            </div>

            {{-- <div  class="tabcontent">
                <h3>Paris</h3>
                <p>Paris is the capital of France.</p>
            </div>

            <div id="Tokyo" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div> --}}

            <!--========================
                    MEMBER
            ========================-->

            <div id="Member" class="card-body tabcontent" style="padding: 0px 10px 0px 10px;">
                @foreach ($member as $item)
                    <div class="card col-12 "
                        style="font-family: 'Prompt', sans-serif;border-radius: 25px;border-bottom-color:;margin-bottom: 10px;border-style: solid;border-width: 0px 0px 4px 0px;">
                        <center>
                            <div class="row col-12 card-body "
                                style="padding:15px 0px 15px 0px ;border-radius: 25px;margin-bottom: -2px;">
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;padding:0px"
                                    data-toggle="collapse" data-target="member{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <i class="bx bx-line text-success"></i>
                                </div>
                                <div class="col-8 collapsed" style="margin-bottom:0px;padding:0px" data-toggle="collapse"
                                    data-target="#member{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <h5 style="margin-bottom:0px; margin-top:0px; ">
                                        <a target="break">
                                            <i class="fa-solid fa-user"></i>
                                        </a>&nbsp;&nbsp;  {{ $item->user->full_name }} {{-- // หัวข้อ // --}}
                                    </h5>
                                </div>
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;"
                                    data-toggle="collapse" data-target="#member{{ $item->id }}"
                                    aria-expanded="false" aria-controls="form_delete_11003308">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="col-12 collapse" id="member{{ $item->id }}" style="">
                                    <hr>
                                        <div class="row ">
                                            <div class="col-12 col-md-12 col-lg-12 from-group">
                                                <label for="status" class="control-label" style="font-size: 25px;">{{ 'สถานะ' }}</label>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 from-group">
                                                <label>
                                                    <input class="card-input-element d-none" id="status_member_of_room" name="status_of_room" type="radio" onclick="show_input_fr();" value="member" required>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            สมาชิก
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 from-group">
                                                <label>
                                                    <input class="card-input-element d-none" id="status_patient_of_room" name="status_of_room" type="radio" onclick="show_input_fr();" value="patient" required>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            ผู้ป่วย
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    <hr>
                                    <p style="font-size:18px;padding:0px"> รูป2

                                    </p>
                                    <hr>
                                    <p style="font-size:18px;padding:0px"> รูป3

                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </center>
                    </div>
                @endforeach

                <div class="pagination-wrapper"> </div>
            </div>
             <!--========================
                    END MEMBER
            ========================-->

            <!--========================
                     PATIENT
            ========================-->

            <div id="Patient" class="card-body tabcontent" style="padding: 0px 10px 0px 10px;">
                @foreach ($patient as $item)
                    <div class="card col-12 "
                        style="font-family: 'Prompt', sans-serif;border-radius: 25px;border-bottom-color:;margin-bottom: 10px;border-style: solid;border-width: 0px 0px 4px 0px;">
                        <center>
                            <div class="row col-12 card-body "
                                style="padding:15px 0px 15px 0px ;border-radius: 25px;margin-bottom: -2px;">
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;padding:0px"
                                    data-toggle="collapse" data-target="patient{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <i class="bx bx-line text-success"></i>
                                </div>
                                <div class="col-8 collapsed" style="margin-bottom:0px;padding:0px" data-toggle="collapse"
                                    data-target="#patient{{ $item->id }}" aria-expanded="false"
                                    aria-controls="form_delete_11003308">
                                    <h5 style="margin-bottom:0px; margin-top:0px; ">
                                        <a target="break">
                                            <i class="fa-solid fa-user"></i>
                                        </a>&nbsp;&nbsp;  {{ $item->user->full_name }} {{-- // หัวข้อ // --}}
                                    </h5>
                                </div>
                                <div class="col-2 align-self-center collapsed" style="vertical-align: middle;"
                                    data-toggle="collapse" data-target="#patient{{ $item->id }}"
                                    aria-expanded="false" aria-controls="form_delete_11003308">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="col-12 collapse" id="patient{{ $item->id }}" style="">
                                    <hr>
                                            {{-- สถานะ --}}
                                        <div class="row ">
                                            <div class="col-12 col-md-12 col-lg-12 from-group">
                                                <label for="status" class="control-label" style="font-size: 25px;">{{ 'สถานะ' }}</label>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 from-group">
                                                <label>
                                                    <input class="card-input-element d-none" id="status_member_of_room" name="status_of_room" type="radio" onclick="show_input_fr();" value="member" {{ (isset($item) && 'member' == $item->status) ? 'checked' : '' }} required>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            สมาชิก
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 from-group">
                                                <label>
                                                    <input class="card-input-element d-none" id="status_patient_of_room" name="status_of_room" type="radio" onclick="show_input_fr();" value="patient" {{ (isset($item) && 'patient' == $item->status) ? 'checked' : '' }} required>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            ผู้ป่วย
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    <hr>
                                                {{-- ระดับผู้ป่วย --}}
                                        <div id="lv_caretaker_fr" class="row form-group col-12 col-md-12">
                                            <div class="col-12 col-md-12 col-lg-12 from-group">
                                                <label for="status" class="control-label" style="font-size: 25px;">{{ 'ระดับผู้ป่วย' }}</label>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6 from-group @error('lv_1_of_caretaker') is-invalid @enderror">
                                                <label>
                                                    <input class="card-input-element d-none lv_of_caretaker" id="lv_1_of_caretaker" autocomplete="off" name="lv_of_caretaker" type="radio" value="1" {{ (isset($item) && 1 == $item->lv_of_caretaker) ? 'checked' : '' }}>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            ระดับ 1 (กดยืนยันใช้ยาเองได้)
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                                @error('lv_1_of_caretaker')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>กรุณาเลือกระดับผู้ป่วยก่อน</strong>
                                                    </span>
                                                @enderror

                                            <div class="col-12 col-md-6 col-lg-6 from-group @error('lv_2_of_caretaker') is-invalid @enderror">
                                                <label>
                                                    <input class="card-input-element d-none lv_of_caretaker" id="lv_2_of_caretaker" autocomplete="off" name="lv_of_caretaker" type="radio" value="2" {{ (isset($item) && 2 == $item->lv_of_caretaker) ? 'checked' : '' }}>
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            ระดับ 2 (ไม่สามารถกดยืนยันใช้ยาเองได้)(ผู้ดูแลกดให้)
                                                        </span>
                                                    </div>
                                                </label>
                                            </div>
                                                @error('lv_2_of_caretaker')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>กรุณาเลือกระดับผู้ป่วยก่อน</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    <hr>
                                    <p style="font-size:18px;padding:0px">
                                        <button type="submit" class="btn-old btn-secondary btn-sm main-shadow main-radius" title="Delete Room" >
                                            <i class="fa-solid fa-trash"></i> ยืนยัน
                                        </button>
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </center>
                    </div>
                @endforeach

                <div class="pagination-wrapper"> </div>
            </div>

            <!--========================
                    END PATIENT
            ========================-->

        </div>
    </div>
</section><!-- /.page-title -->
@endsection

<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>

