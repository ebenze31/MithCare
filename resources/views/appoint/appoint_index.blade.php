@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">deer </h1>

                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">ตารางนัด</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
                            <li class="breadcrumb-item"><a href="#">ตารางนัด</a></li>
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

            <div class="container mt-3">
                <div class="row d-flex justify-content-end ">
                    <!-- <a href="#" class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                        <i class="fa fa-plus"></i>เพิ่มตารางนัดหมอ/กินยา</a> -->
                    <a class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px; color:#ffffff;" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มตารางนัดหมอ/กินยา
                    </a>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- หน้าสร้างตารางนัด -->
                                <div class="container">
                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">

                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
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

                                                <form method="POST" action="{{ url('/appoint/'. $room->id . '/create') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
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

                    <div class="modal fade" id="edit_Appoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                <!-- แก้ไขตารางนัด -->
                                <div class="container">
                                    <div class="row">
                                        <div class="contact-panel col-md-12 mb-2">

                                            <button class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <div class="container">
                                                
                                                <h3><i class="fa-solid fa-home"></i>แก้ไขตารางนัด</h3>
                                                <br />
                                                <br />

                                                
                                                @if ($errors->any())
                                                <ul class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                                <!-- ?appoint_id=-->
                                                <form method="POST" action="{{ url('/appoint/edit') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input  name="appoint_id" id="appoint_id" value="" />
                                                    @include ('appoint.appoint_form_edit')
                                                </form>
                                             </div> <!--container -->

                                          
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
                    <select class="form-control col-md-2" id="appoint_selector">
                        <option value="all">ทั้งหมด</option>
                        <option value="นัดหมอ">นัดหมอ</option>
                        <option value="ทานยา">ทานยา</option>
                    </select>
             

                <div class="mt-3" id='calendar'></div>

            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection
{{$appoint}}
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
            eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
             // modal toggle 
            //  eventClick: function() {
				
			// 	$('#edit_Appoint').modal("show");	
    
			// },
           
            events: [
                @foreach($appoint as $ap) {
                    id: '{{ $ap->id }}', 
                    title: '{{ $ap->title }}',
                    start: '{{ $ap->date_time }}',  
            
                },
                @endforeach 
                // {
                //     title: 'กดได้เถอะครับ',
                //     start: '2023-01-14',  
                               
                   
                // },
            ], 
            eventClick: function(calEvent, jsEvent, view) {

                let appoint_id = calEvent['event']['_def']['publicId'] ;

                document.querySelector('#appoint_id').value = appoint_id;

                fetch("{{ url('/') }}/api/get_data_appoint/"+appoint_id )
                    .then(response => response.json())
                    .then(result => {

                        // console.log(result);
                        // console.log(result.date_time);
                        // console.log(result.title);
                        // console.log(result.type);

                        document.querySelector('.date_time_edit').value = result.date_time;
                        document.querySelector('.title_edit').value = result.title;

                        let type_edit = document.querySelector('.type_edit');
                            type_edit.innerHTML = "";

                        let option_select = document.createElement("option");
                            option_select.text = result.type;
                            option_select.value = result.type;
                            option_select.selected = true ;
                            option_select.disabled = true ;
                            type_edit.add(option_select);

                        let option_1 = document.createElement("option");
                            option_1.text = "นัดหมอ";
                            option_1.value = "นัดหมอ";
                            type_edit.add(option_1);
                        let option_2 = document.createElement("option");
                            option_2.text = "ทานยา";
                            option_2.value = "ทานยา";
                            type_edit.add(option_2);
                });

                // console.log(calEvent);
                // console.log(calEvent['event']['_def']['publicId']);
                
                $('#edit_Appoint').modal();
            },
           
            eventColor: '#378006'

          

        });
        calendar.render();
    });

</script>