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
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room_join') }}" style="font-size: 30px;">เข้าร่วมบ้าน</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room_join') }}" style="font-size: 20px;">เข้าร่วมบ้าน</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="page-title page-title-layout5">
    <div class="container">
        <div class="row">

            <div class="contact-panel col-md-12 mb-2">

                <h3>เข้าร่วมบ้าน</h3>

                    <a href="#" onclick="goBack()"><button class="btn btn-info btn-sm main-shadow main-radius" style="font-size: 20px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ</button></a>
                    <br />
                    <br />


                    <center>
                        <div class="col-md-4 col-sm-12">
                            <div class="card product-item ">
                            @if(!empty($find_room->home_pic))
                                <img class="card-img-top p-3 " src="{{ url('storage/'.$find_room->home_pic )}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                            @else
                                <img class="card-img-top p-3 " src="{{asset('/img/logo_mithcare/home-background.png')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                            @endif
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <hr>
                                            <p class="pricing__title text-center mt-2 p-2 h3" style="color: #4170A2;">{{$find_room->name}}</p>

                                            <p style="font-size: 20px;">เจ้าของบ้าน : {{$find_room->user->name}}</p>
                                            <hr>
                                        </div>
                                    </div>

                                </div><!--  card-body -->
                            </div><!--  card -->
                        </div><!--  col-md-4 col-sm-12 -->
                    </center>


                    <form method="POST" action="{{ url('room_join') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}



                        <div id="status_fr" class="form-group {{ $errors->has('status') ? 'has-error' : ''}} col-12 col-md-12">
                            <label for="status" class="control-label" style="font-size: 25px;">{{ 'สถานะ' }}</label>
                            <select name="status" class="form-control" id="status" onchange="show_input_fr();" required>
                                <option selected disabled>กรุณาเลือกสถานะ</option>
                                @foreach (json_decode('{"member":"สมาชิก","patient":"ผู้ป่วย"}', true) as $optionKey => $optionvalue)
                                <option value="{{ $optionKey }}" {{ (isset($this_room->status) && $this_room->status == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
                                @endforeach
                            </select>
                        </div> <!--///  สถานะ /// -->

                        <div id="takecare_fr" class="form-group">
                            <label for="status" class="control-label" style="font-size: 25px;">{{ 'กรุณาเลือกผู้ที่ต้องการดูแล' }}</label>
                           <div class="row">
                                @foreach($this_room as $item)
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>
                                        {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                                    <input class="card-input-element d-none" id="checkbox_select_takecare{{$item->id}}" name="checkbox_select_takecare" type="checkbox" onclick="click_Select_Takecare();" value="{{$item->id}}">
                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                            <span>
                                                {{$item->user->full_name}}
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                           </div>
                            <input class="form-control d-none" type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                            <input class="form-control d-none" type="text" name="room_id" id="room_id" value="{{$find_room->id}}">
                            <input class="form-control d-none" type="text" name="select_takecare" id="select_takecare">
                            {{-- <select id="select_takecare" name="select_takecare" onchange="showMember_of_Room();" class="form-control" >
                               <option value="" selected disabled>กรุณาเลือกผู้ที่ต้องการดูแล</option>
                                @foreach($this_room as $item)
                                    <option value="{{ $item->user->full_name }}">{{ $item->user->full_name }}</option>
                                @endforeach
                            </select> --}}
                        </div> <!--///  เลือกผู้ดูแล /// -->

                        <div id="lv_caretaker_fr" class="form-group {{ $errors->has('lv_caretaker') ? 'has-error' : ''}} col-12 col-md-12">
                            <label for="lv_caretaker" class="control-label" style="font-size: 25px;">{{ 'ระดับ' }}</label>
                            <select name="lv_caretaker" class="form-control" id="lv_caretaker" >
                                <option id="oplv_caretaker_start" selected disabled>กรุณาเลือกระดับผู้ป่วย</option>
                                @foreach (json_decode('{"1":"ระดับ 1 (คนไข้สามารถกดยืนยันเองได้)","2":"ระดับ 2 (คนไข้ไม่สามารถกดยืนยันเองได้)"}', true) as $optionKey => $optionvalue)
                                <option value="{{ $optionKey }}" {{ (isset($requestData->lv_of_caretaker) && $requestData->lv_of_caretaker == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
                                @endforeach
                            </select>
                        </div> <!--///  เพศ /// -->




                        <div class="form-group">
                            <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">
                                เข้าร่วม
                            </button>
                        </div>
                    </form><!--///  end form /// -->


            </div><!--  contact-panel -->
        </div><!--  row -->
    </div><!-- /container -->
</section><!-- กันสั่น -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('takecare_fr').classList.add('d-none');
        document.getElementById('lv_caretaker_fr').classList.add('d-none');
    });

    function show_input_fr(){

        let status = document.querySelector('#status').value;
        let select_takecare = document.getElementsByName("select_takecare");

        if (status === 'member') {
            let takecare_fr = document.querySelector('#takecare_fr').classList ;
                // console.log(div_date);
                takecare_fr.remove('d-none');
                takecare_fr.add('col-12');
            document.querySelector('#lv_caretaker_fr').classList.add('d-none');
            document.querySelector('#lv_caretaker_fr').required = false ;
            document.querySelector('#oplv_caretaker_start').selected = true ;
        }else {
             let lv_caretaker_fr = document.querySelector('#lv_caretaker_fr').classList;
                // console.log(div_date);
                lv_caretaker_fr.remove('d-none');
                lv_caretaker_fr.add('col-12');
                document.querySelector('#takecare_fr').classList.add('d-none');
                document.querySelector('#takecare_fr').required = false ;

                let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare');
                document.querySelector('#select_takecare').value = "";

                for (let i = 0; i < checkbox_select_takecare.length; i++) {
                    checkbox_select_takecare[i].checked = false ;
                }
        }
    }

</script>

<script>
    function click_Select_Takecare(){
        let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare');
        let select_takecare = document.querySelector('#select_takecare');

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

{{-- <script>
     function showMember_of_Room() {
        let room_id = document
        let input_caretaker = document.querySelector("#select_takecare");
        let url = "{{ url('/api/caretaker_of_room') }}?caretaker=" + input_caretaker.value + "&room_id=" + ;
        // console.log(url);

        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let input_amphoe = document.querySelector("#input_amphoe");
                let old_amphoe = input_amphoe.value;
                input_amphoe.innerHTML = "";

                if (old_amphoe && count_select_a === 1) {

                    let option_start = document.createElement("option");
                    option_start.value = old_amphoe;
                    option_start.text = old_amphoe;
                    option_start.selected = true;
                    option_start.disabled = true;
                    input_amphoe.appendChild(option_start);
                } else {

                    let option_start = document.createElement("option");
                    option_start.text = "กรุณาเลือกอำเภอ";
                    option_start.selected = true;
                    input_amphoe.appendChild(option_start);
                }

                for (let item of result) {
                    // console.log(item.amphoe);
                    let option = document.createElement("option");
                    option.text = item.amphoe;
                    option.value = item.amphoe;
                    input_amphoe.appendChild(option);
                }
                //QUERY AMPHOES
                count_select_a = count_select_a + 1;
                showTambons();
            });
    }
</script> --}}


@endsection
