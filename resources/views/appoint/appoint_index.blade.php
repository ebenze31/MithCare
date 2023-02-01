@extends('layouts.mithcare')

@section('content')

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
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">ตารางนัด</a></li>
                        </ol>
                    </div>
                    <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">ตารางนัด</a></li>
                        </ol>
                    </div>
                    <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->



<section class="page-title page-title-layout5">
    <div class="container">
        <div class="row">

            <div class="container mt-3">
                <div class="row d-flex justify-content-end ">
                    <!-- <a href="#" class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                        <i class="fa fa-plus"></i>เพิ่มตารางนัดหมอ/กินยา</a> -->
                    <a class="btn btn-primary btn-sm main-shadow main-radius mr-2"
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

                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">
                                                <h3><i class="fa-solid fa-home"></i> เพิ่มตารางนัด</h3>
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

                                                    @include ('appoint.appoint_form_create')
                                                </form>

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

                <h3>ตารางนัด</h3>

                <div class="row" id="appoint_selector">
                    <div class="col-12 col-md-10 mt-2">
                        <a  style="background-color: #848e9f;" class="btn-old btn-outline-dark  mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}">ทั้งหมด</a>
                        <a  style="background-color: #38c172;" class="btn-old btn-outline-dark  mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=doc">นัดหมอ</a>
                        <a  style="background-color: #21cdc0;" class="btn-old btn-outline-dark  mr-1" href="{{ url('/appoint')}}?room_id={{$room_id}}&type=pill">ใช้ยา</a>
                    </div>
                    <div class="col-6 col-md-2 column mt-2">
                      <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #38c172;"></i> นัดหมอ</a><br>
                       <a style="color: black; font-weight: bold;"><i class="fa-solid fa-circle" style="color: #21cdc0;"></i> ใช้ยา</a>
                    </div>
                </div>

                <!-- ///////////////////////////////////////////
                //////////////// Calendar //////////////////////
                //////////////////////////////////////////////// -->

                <div class="mt-3" id='calendar'></div>

            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
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
        editable: true,
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


        eventClick: function(calEvent, jsEvent, view) {

            let appoint_id = calEvent['event']['_def']['publicId'];

            document.querySelector('#appoint_id').value = appoint_id;

            document.querySelector('#appoint_delete').action = '{{ url("/appoint" ) }}' + '/' + appoint_id;

            fetch("{{ url('/') }}/api/get_data_appoint/" + appoint_id)
                .then(response => response.json())
                .then(result => {
                    // console.log(result.type);
                    // console.log(result);

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
                    let type_edit = document.querySelector('.type_edit');
                    type_edit.innerHTML = "";


                    let option_select = document.createElement("option");
                    option_select.text = result.type;
                    option_select.value = result.type;
                    option_select.selected = true;
                    option_select.disabled = true;
                    type_edit.add(option_select);

                    let option_1 = document.createElement("option");
                    option_1.text = "นัดหมอ";
                    option_1.value = "doc";
                    type_edit.add(option_1);

                    let option_2 = document.createElement("option");
                    option_2.text = "ใช้ยา";
                    option_2.value = "pill";
                    type_edit.add(option_2);

                });

            $('#edit_Appoint').modal();


        },


    });
    calendar.render();
});

</script>

<script>

    function edit_type() {
      let type = document.querySelector('#type_edit').value;

      if (type === 'doc') {
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
            document.querySelector('#date_time_edit').required = true ;
        }
    }
</script>

