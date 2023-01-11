@extends('layouts.mithcare')

@section('content')

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
                    <!-- <a class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px; color:#ffffff;" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่
                    </a> -->
                    <a href="#section" class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มตารางนัดหมอ</a>
                    <a href="#" class="btn btn-success btn-sm main-shadow main-radius mr-2" style="font-size: 20px;">
                        <i class="fa fa-plus"></i>เพิ่มตารางนัดกินยา</a>
                </div>
            </div>
            <div class="contact-panel col-md-12 mb-2 mt-3">

                <h3>ตารางนัด</h3>

                <br />
                <br />
               
	            <div id='calendar'></div>  

            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection

<script src="{{ asset('mithcare/js/fullcalendar/js/main.min.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
				},
				initialView: 'dayGridMonth',
				initialDate: '2023-01',
				navLinks: true, // can click day/week names to navigate views
				selectable: true,
				nowIndicator: true,
				dayMaxEvents: true, // allow "more" link when too many events
				editable: true,
				selectable: true,
				businessHours: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: [{
					title: 'All Day Event',
					start: '2020-09-01',
				}, {
					title: 'Long Event',
					start: '2020-09-07',
					end: '2020-09-10'
				}, {
					groupId: 999,
					title: 'Repeating Event',
					start: '2020-09-09T16:00:00'
				}, {
					groupId: 999,
					title: 'Repeating Event',
					start: '2020-09-16T16:00:00'
				}, {
					title: 'Conference',
					start: '2020-09-11',
					end: '2020-09-13'
				}, {
					title: 'Meeting',
					start: '2020-09-12T10:30:00',
					end: '2020-09-12T12:30:00'
				}, {
					title: 'Lunch',
					start: '2020-09-12T12:00:00'
				}, {
					title: 'Meeting',
					start: '2020-09-12T14:30:00'
				}, {
					title: 'Happy Hour',
					start: '2020-09-12T17:30:00'
				}, {
					title: 'Dinner',
					start: '2020-09-12T20:00:00'
				}, {
					title: 'Birthday Party',
					start: '2020-09-13T07:00:00'
				}, {
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2020-09-28'
				}]
			});
			calendar.render();
		});
	</script>