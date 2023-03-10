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
        font-size: 12px;
    }
</style>




<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/????????????????????????/????????????????????????-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">{{ Auth::user()->name }}</h1>

                <nav>
                    <!-- ???????????????????????????????????? -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">?????????????????????</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">????????????</a>
                            </li>


                        </ol>
                    </div>
                    <!--d-none d-lg-block -->
                    <!-- ????????????????????????????????????????????? -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">?????????????????????</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">???????????? </a>
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
                        <i class="fa fa-plus"></i>????????????????????????????????????????????????/???????????????</a> -->
                    <a  class="btn btn-primary btn-sm main-shadow main-radius mr-2"
                        style="font-size: 20px; color:#ffffff;" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus" aria-hidden="true"></i>????????????????????????????????????????????????/???????????????
                    </a>





                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- ??????????????????????????????????????????????????? -->
                                <div class="container">
                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">
                                            {{-- <div class="lds-ring"><div></div><div></div><div></div><div></div></div> --}}
                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">
                                                <h3 class="heading__title"><i class="fa-solid fa-home "></i> ???????????????????????????????????????</h3>
                                                <br />
                                                <br />
                                                @if ($errors->any())
                                                <ul class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif

                                                <form method="POST"
                                                    action="{{ url('/appoint/'. $room->id . '/create') }}"
                                                    accept-charset="UTF-8" class="form-horizontal h5"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                   <!--///  ??????????????? ??????????????????????????????????????? /// -->
                                                   <label for="title" class="control-label">{{ '?????????????????????????????????????????????' }}</label>
                                                    @if ($check_status_member->status != 'patient')
                                                        <div class="home-demo">
                                                            <div class="owl-carousel aasdaa owl-theme">
                                                                <div class="col-12 p-0">
                                                                    <label>
                                                                        {{-- <input type="checkbox"  name="be_notified" value="???????????????????????????" class="card-input-element d-none" > --}}
                                                                    <input class="card-input-element d-none" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <a class="text_topright" style="color:#383535">(??????????????????)</a>
                                                                            <span style="font-size:16px;">
                                                                                {{Auth::user()->name}}
                                                                            </span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                @foreach($patient_with_caregiver as $item)
                                                                    <div class="item">
                                                                        <!--///  ???????????????????????????????????? /// -->

                                                                        <div class="col-12 p-0">
                                                                            <label>
                                                                            <input class="card-input-element d-none" id="radio_patient{{$item->id}}" name="patient_id" type="radio" value="{{$item->user_id}}" >
                                                                                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">

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
                                                                    <input class="card-input-element d-none" id="radio_owner" name="patient_id" type="radio" value="{{Auth::user()->id}}" >
                                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                            <a class="text_topright" style="color:#383535">(??????????????????)</a>
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
                                <!-- ??????????????????????????????????????? -->
                                <div class="container">

                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">

                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">

                                                    <h3><i class="fa-solid fa-calendar-days"></i> ???????????????????????????????????????</h3>
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

                                                         <!--///  ??????????????? ??????????????????????????????????????? /// -->
                                                        <label for="title" class="control-label">{{ '?????????????????????????????????????????????' }}</label>
                                                        @if ($check_status_member->status != 'patient')
                                                            <div class="home-demo">
                                                                <div class="owl-carousel aasdaa owl-theme">
                                                                    <div class="col-12 p-0">
                                                                        <label>
                                                                            {{-- <input type="checkbox"  name="be_notified" value="???????????????????????????" class="card-input-element d-none" > --}}
                                                                        <input class="card-input-element d-none" id="radio_owner_edit" name="patient_id_edit" type="radio" value="{{Auth::user()->id}}">
                                                                            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                                                <a class="text_topright" style="color:#383535">(??????????????????)</a>
                                                                                <span style="font-size:16px;">
                                                                                    {{Auth::user()->name}}
                                                                                </span>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    @foreach($patient_with_caregiver as $item)
                                                                        <div class="item">
                                                                            <!--///  ???????????????????????????????????? /// -->

                                                                            <div class="col-12 p-0">
                                                                                <label>
                                                                                <input class="card-input-element d-none" id="radio_patient{{$item->id}}" name="patient_id_edit" type="radio" value="{{$item->user_id}}">
                                                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">

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
                                                                                <a class="text_topright" style="color:#383535">(??????????????????)</a>
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
                                                            <button class="btn-old btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">??????????????????</button>
                                                        </div>
                                                    </form>
                                                        <div class="col-6">
                                                            <form id="appoint_delete" method="POST" action="" accept-charset="UTF-8">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                    <button type="submit" class="btn-old btn-primary form-control" style="background-color: #e3342f; font-size: 25px; color: white;" title="Delete Appoint" onclick="return confirm('?????????????????????????????????????????????????????????')">
                                                                        <i class="fa-solid fa-trash"></i> ??????
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
                    <span class="text-dark">???????????????</span>
                    @if ($type == 'doc')
                        <span class="text-success">??????????????????</span>
                    @elseif($type == 'pill')
                        <span class="text-info">???????????????</span>
                    @else
                        <span class="text-dark">?????????????????????</span>
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
                        <a id="all" style="border: #000 solid 1px;" class="btn-old {{$color_all}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}#head_content">?????????????????????</a>
                        <a id="doc" style="border: #38c172 solid 1px;" class="btn-old {{$color_doc}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=doc#head_content">??????????????????</a>
                        <a id="pill" style="border: #21cdc0 solid 1px;" class="btn-old {{$color_pill}} mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=pill#head_content">???????????????</a>
                    </div>
                    <div class="col-6 col-md-2 column mt-2">
                      <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #38c172;"></i> ??????????????????</a><br>
                       <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #21cdc0;"></i> ???????????????</a>
                    </div>
                </div>

                <!-- ///////////////////////////////////////////
                //////////////// Calendar //////////////////////
                //////////////////////////////////////////////// -->

                <div class="mt-3" id='calendar'></div>

            </div>
        </div>
    </div>
</section><!-- ????????????????????? -->
@endsection

<script src="{{ asset('mithcare/js/fullcalendar/js/main.min.js') }}"></script>
<script>
const date_now_Y_m = Date.now('Y-m');

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth',
        initialDate: date_now_Y_m,
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        editable: false,
        selectable: true,
        businessHours: true,
        dayMaxEvents: true, // allow "more" link when too many events
        timeZone: 'Asia/Bangkok',
        locale: 'th',
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
                    // ???????????????
                    start: '{{ $ap->date }} {{ $ap->date_time }}',
                    color: '#21cdc0'
                @else
                    // ??????????????????
                    start: '{{ $ap->date }}',
                    color: '#38c172'
                @endif

            },
            @endforeach

        ],


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

    // function select_takecare_lv2() {
    //   let button_switch = document.querySelector('#select_takecare_patient_2').value;

    //   if (type === 'doc') {
    //         let div_date = document.querySelector('#div_date_edit').classList ;
    //             // console.log(div_date);
    //             div_date.remove("col-md-6");
    //             div_date.remove('d-none');
    //             div_date.add('col-md-12');
    //         document.querySelector('#div_datetime_edit').classList.add('d-none');
    //         document.querySelector('#date_time_edit').required = false ;
    //     }else {
    //         let div_date = document.querySelector('#div_date_edit').classList;
    //             // console.log(div_date);
    //             div_date.remove("col-md-12");
    //             div_date.remove('d-none');
    //             div_date.add('col-md-6');
    //         document.querySelector('#div_datetime_edit').classList.remove('d-none');
    //         document.querySelector('#date_time_edit').required = true
    //     }
    // }

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


</script>
