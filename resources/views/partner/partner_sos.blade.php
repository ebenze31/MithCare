@extends('layouts.admin.main')

@section('content')
<div class="container-partner-sos">
    <div class="row">
        <div class="item sos-map col-md-4 col-12 col-lg-4">
            <div class="row">
                <div class="col-6">
                    <a href="{{ url('/sos_partner') }}" style="float: left; background-color: rgb(1, 86, 156);" type="button" class="btn text-white" > <!-- onclick="initMap();" -->
                        <i class="fas fa-sync-alt"></i> คืนค่าแผนที่
                    </a>
                    <br><br>
                </div>
                <div class="col-6">
                    <h4 style="float: right;color: #007bff;"><b>ชื่อพื้นที่</b></h4>
                </div>
                <div class="col-12">
                    <input class="d-none" type="text" id="va_zoom" name="" value="6">
                    <input class="d-none" type="text" id="center_lat" name="" value="13.7248936">
                    <input class="d-none" type="text" id="center_lng" name="" value="100.4930264">
                    <input class="d-none" type="text" id="name_area" name="" value="{{ $name_area }}">
                    <input class="d-none" type="text" id="type_partner" name="" value="{{ $type_partner }}">
                    <input class="d-none" type="text" id="name_partner" name="" value="{{ $data_partner->name }}">

                    <div style="padding-right:15px ;">
                        <div class="card">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-8 d-none d-lg-block">
            <div class="row">
                <div class="col-3">
                    <!-- ตัวเลือกพื้นที่-->
                </div>
                <div class="col-9">
                    <div style="float: right;">
                        <a href="{{ url('/sos_detail_partner') }}" type="button" class="btn btn-primary text-white">ดูช่วงเวลา <i class="fas fa-chart-line"></i></a>
                        @if(Auth::check())
                            @if(Auth::user()->role == 'admin-partner')
                                <a href="{{ url('/sos_score_helper') }}" type="button" class="btn btn-primary text-white d-">
                                    คะแนนการช่วยเหลือ
                                </a>
                            @endif
                        @endif
                        <a type="button" data-toggle="modal" data-target="#Partner_gsos">
                            <button class="btn btn-success">
                                <i class="fas fa-info-circle"></i>วิธีใช้
                            </button>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="card radius-10 d-none d-lg-block col-12" style="font-family: 'Baloo Bhaijaan 2', cursive;font-family: 'Prompt', sans-serif;">
                    <div class="card-header border-bottom-0 bg-transparent" style="margin-top: 10px;">
                        <div class="d-flex align-items-center">
                            <div class="col-12">
                                <h5 class="font-weight-bold mb-0" style="margin-top:10px;">
                                    การขอความช่วยเหลือ
                                <span style="font-size: 15px; float: right; margin-top:-5px;">
                                    จำนวนทั้งหมด <b>{{ $count_data }}</b> ครั้ง
                                    &nbsp;&nbsp; | &nbsp;&nbsp;
                                    @if(!empty($average_per_minute))
                                        @if($average_per_minute['day'] != "0" && $average_per_minute['hr'] != "0" && $average_per_minute['min'] != "0")
                                            ระยะเวลาโดยเฉลี่ย <b> {{ $average_per_minute['day'] }} วัน {{ $average_per_minute['hr'] }} ชม. {{ $average_per_minute['min'] }} นาที </b> / เคส ({{ $average_per_minute['count_case'] }})
                                        @endif

                                        @if($average_per_minute['day'] == "0" && $average_per_minute['hr'] != "0" && $average_per_minute['min'] != "0")
                                            ระยะเวลาโดยเฉลี่ย <b> {{ $average_per_minute['hr'] }} ชม. {{ $average_per_minute['min'] }} นาที </b> / เคส ({{ $average_per_minute['count_case'] }})
                                        @endif

                                        @if($average_per_minute['day'] == "0" && $average_per_minute['hr'] == "0" && $average_per_minute['min'] != "0")
                                            ระยะเวลาโดยเฉลี่ย <b>{{ $average_per_minute['min'] }} นาที </b> / เคส ({{ $average_per_minute['count_case'] }})
                                        @endif

                                        @if($average_per_minute['day'] == "0" && $average_per_minute['hr'] == "0" && $average_per_minute['min'] == "0")
                                            ระยะเวลาโดยเฉลี่ย <b>น้อยกว่า 1 นาที</b> / เคส ({{ $average_per_minute['count_case'] }})
                                        @endif
                                    @endif
                                </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <hr style="color:black;background-color:black;height:2px;">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-3">
                                <b>ผู้ขอความช่วยเหลือ</b>
                            </div>
                            <div class="col-3">
                                <b>เวลาแจ้งเหตุ</b>
                            </div>
                            <div class="col-3">
                                <b>สถานะ</b>
                            </div>
                            <div class="col-2">
                                <b>ระยะเวลา</b>
                            </div>
                            <div class="col-1">
                                <b>ตำแหน่ง</b>
                            </div>

                            <br><br>
                            <hr style="color:black;background-color:black;height:2px;">
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                        $Number = 1 ;
                        @endphp

                        @foreach($view_maps as $item)

                        @php
                        $color_row = "" ;

                        if( $Number%2 == 0 ){
                            $color_row = "#FFEFD5" ;
                        }
                        @endphp
                        <div class="row text-center">
                            <div class="col-3">
                                <div style="margin-top: -10px;" >
                                    <h5 class="text-primary float-left">
                                        <span style="font-size: 15px;">
                                            <a target="break" href="{{ url('/').'/profile/'.$item->user_id }}">
                                            <i class="far fa-eye text-primary"></i>
                                            </a>
                                        </span>&nbsp;{{ $item->name_user }}<br>
                                    </h5>
                                    {{ $item->user->phone }}
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: -10px;">
                                    <p><b>
                                    {{ date("d/m/Y" , strtotime($item->created_at)) }} <br>
                                    {{ date("H:i" , strtotime($item->created_at)) }}
                                    </b></p>
                                    @if(!empty($item->photo))
                                    <br>
                                    <a href="{{ url('storage')}}/{{ $item->photo }}" target="bank">
                                        <img class="main-shadow" style="border-radius: 50%; object-fit:cover;" width="150px" height="150px" src="{{ url('storage')}}/{{ $item->photo }}">
                                    </a>
                                    <br>
                                    <a class="btn btn-sm btn-outline-info px-3 radius-30 mt-3" href="{{ url('storage')}}/{{ $item->photo }}" download>
                                        <i class="fa-solid fa-download"></i> ดาวน์โหลด
                                    </a>
                                    <br><br>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="margin-top: -10px;">
                                    @if( !empty($item->helper) and empty($item->help_complete) )
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-warning radius-30 dropdown-toggle" id="dropdown_status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fadeIn animated bx bx-message-rounded-error"></i>ระหว่างดำเนินการ
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdown_status">
                                                <a class="dropdown-item  btn" onclick="status_help_complete('{{ $item->id }}' , '{{ Auth::user()->id }}' );">
                                                    การช่วยเหลือเสร็จสิ้น
                                                </a>
                                            </div>
                                        </div>
                                    @elseif($item->name_helper == null)
                                        <a class="btn btn-sm btn-danger radius-30" >
                                            <i class="fadeIn animated bx bx-x"></i>ยังไม่ได้ดำเนินการ
                                        </a>
                                        <a type="button" style="margin-top: 10px;" class="btn btn-sm radius-30 notify_alert_gotohelp"
                                        onclick="go_to_help('{{ $item->id }}' , '{{ Auth::user()->id }}' )">
                                            <i class="fa-solid fa-truck-medical"></i> กำลังไปช่วยเหลือ
                                        </a>

                                    @elseif($item->help_complete == "Yes" && $item->name_helper != null)
                                        <a class="btn btn-sm btn-success radius-30" >
                                            <i class="bx bx-check-double"></i>ช่วยเหลือเสร็จสิ้น
                                        </a>
                                        @if(!empty($item->help_complete_time))
                                            <p style="margin-top:8px;">
                                                <b>
                                                    {{ date("d/m/Y" , strtotime($item->help_complete_time)) }} {{ date("H:i" , strtotime($item->help_complete_time)) }}
                                                </b>
                                            </p>
                                        @endif
                                        @if(!empty($item->photo_succeed))
                                        <a href="{{ url('storage')}}/{{ $item->photo_succeed }}" target="bank">
                                            <img class="main-shadow" style="border-radius: 50%; object-fit:cover;" width="150px" height="150px" src="{{ url('storage')}}/{{ $item->photo_succeed }}">
                                        </a>
                                        <br>
                                        <a class="btn btn-sm btn-outline-info px-3 radius-30 mt-3" href="{{ url('storage')}}/{{ $item->photo_succeed }}" download>
                                            <i class="fa-solid fa-download"></i> ดาวน์โหลด
                                        </a>
                                        <br><br>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-2">
                                @if( !empty($item->created_at) && !empty($item->help_complete_time) )
                                    <!-- ปี -->
                                    @if(\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%y') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%y')}} ปี <br>
                                    @endif
                                    <!-- เดือน -->
                                    @if(\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%m') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%m')}} เดือน <br>
                                    @endif
                                    <!-- วัน -->
                                    @if( \Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%d') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%d')}} วัน <br>
                                    @endif
                                    <!-- ชัวโมง -->
                                    @if(\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%h') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%h')}} ชั่วโมง <br>
                                    @endif
                                    <!-- นาที -->
                                    @if(\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%i') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%i')}} นาที <br>
                                    @endif
                                    <!-- วินาที -->
                                    @if( \Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%s') != 0 )
                                        {{\Carbon\Carbon::parse($item->help_complete_time)->diff(\Carbon\Carbon::parse($item->created_at))->format('%s')}} วินาที <br>
                                    @endif

                                @else
                                    <span>-</span>
                                @endif
                            </div>
                            <div class="col-1">
                                <div style="margin-top: -10px;">

                                    @if( $item->content == "help_by_partner" )
                                        <a id="tag_a_view_marker" class="link text-danger" href="#map" onclick="view_marker('{{ $item->lat }}' , '{{ $item->lng }}', '{{ $item->id }}');">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <br>
                                            ดูหมุด
                                        </a>
                                    @else
                                        <a class="link text-danger" href="#map" onclick="view_marker('{{ $item->lat }}' , '{{ $item->lng }}', '{{ $item->id }}', '{{ $item->name_user }}');">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <br>
                                            ดูหมุด
                                        </a>
                                    @endif

                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                @if(Auth::check())
                                    @if(Auth::user()->role == 'admin-partner' or Auth::user()->id == $item->helper_id)
                                        @if($item->help_complete == "Yes" and $item->score_total != null)
                                            <div class="col-12 text-left" style="margin-top:5px;">
                                                <h5>คะแนนการช่วยเหลือ</h5>
                                                <div class="row">
                                                    <div class="col-2" style="padding:0px">
                                                        <b>เจ้าหน้าที่ : </b><br>{{$item->name_helper}}
                                                    </div>
                                                    <div class="col-2" style="padding:0px">
                                                        @if($item->score_impression < 3)
                                                            <b>ความประทับใจ : </b><br>
                                                            <span class="text-danger">{{$item->score_impression}}</span>
                                                        @elseif($item->score_impression == 3)
                                                            <b>ความประทับใจ : </b><br>
                                                            <span class="text-warning">{{$item->score_impression}}</span>
                                                        @elseif($item->score_impression > 3)
                                                            <b>ความประทับใจ : </b><br>
                                                            <span class="text-success">{{$item->score_impression}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-2" style="padding:0px">
                                                        @if($item->score_period < 3)
                                                            <b>ระยะเวลา : </b><br>
                                                            <span class="text-danger">{{$item->score_period}}</span>
                                                        @elseif($item->score_period == 3)
                                                            <b>ระยะเวลา : </b><br>
                                                            <span class="text-warning">{{$item->score_period}}</span>
                                                        @elseif($item->score_period > 3)
                                                            <b>ระยะเวลา : </b><br>
                                                            <span class="text-success">{{$item->score_period}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-2" style="padding:0px">
                                                        @if($item->score_total < 3)
                                                            <b>ภาพรวม : </b><br>
                                                            <span class="text-danger">{{$item->score_total}}</span>
                                                        @elseif($item->score_total == 3)
                                                            <b>ภาพรวม : </b><br>
                                                            <span class="text-warning">{{$item->score_total}}</span>
                                                        @elseif($item->score_total > 3)
                                                            <b>ภาพรวม : </b><br>
                                                            <span class="text-success">{{$item->score_total}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-4" style="padding:0px">
                                                        <b>คำแนะนำ/ติชม : </b><br>{{$item->comment_help}}
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($item->help_complete == "Yes" and $item->score_total == null)
                                            <h5>คะแนนการช่วยเหลือ</h5>
                                            <div class="row">
                                                <div class="col-6" style="padding:0px">
                                                    <b>เจ้าหน้าที่ : </b>{{$item->helper}}
                                                </div>
                                                <div class="col-6" style="padding:0px">
                                                    <b>ไม่ได้ทำแบบประเมิน</b>
                                                </div>
                                            </div>
                                        @elseif(!empty($item->helper) and empty($item->help_complete))
                                            <h5>คะแนนการช่วยเหลือ</h5>
                                            <div class="row">
                                                <div class="col-12" style="padding:0px">
                                                    <b>เจ้าหน้าที่ : </b>{{$item->helper}}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <br>
                            </div>
                            @if(!empty($item->remark))
                            <div class="col-12">
                                <b>หมายเหตุจากเจ้าหน้าที่ : </b> {{ $item->remark }}
                                <br><br>
                            </div>
                            @endif
                            <hr>
                            <br><br>
                        </div>
                        @php
                            $Number = $Number + 1  ;
                        @endphp
                        @endforeach
                        <div style="float: right;">
                        </div>
                        <div class="table-responsive">
                            <div class="pagination round-pagination " style="margin-top:10px;"> {!! $view_maps->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

</div>




<!------------------------------------------------ mobile---------------------------------------------------------------------- -->
<div class="container-fluid card radius-10 d-block d-lg-none" style="font-family: 'Baloo Bhaijaan 2', cursive;font-family: 'Prompt', sans-serif;">
                        <div class="row">
                            <div class="card-header border-bottom-0 bg-transparent">
                                <div class="col-12"  style="margin-top:10px">
                                    <div>
                                        <h5 class="font-weight-bold mb-0">รถที่ถูกรายงานล่าสุด</h5>
                                    </div>
                                    <span style="font-size: 15px; float: right; margin-top:-40px;">จำนวนทั้งหมด {{ $count_data }}</span>
                                    <div class="d-flex justify-content-end" style="margin-top:10px">
                                        <a href="{{ url('/sos_score_helper') }}" type="button" class="btn btn-white radius-10" ><i class="fas fa-chart-line"></i>ดูช่วงเวลา</a>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0px 10px 0px 10px;">

                            @foreach($view_maps as $item)

                                    <div class="card col-12 d-block d-lg-none" style="font-family: 'Prompt', sans-serif;border-radius: 25px;border-bottom-color:#ffffff;margin-bottom: 10px;border-style: solid;border-width: 0px 0px 4px 0px;">
                                        <center>
                                        <div class="row col-12 card-body border border-bottom-0" style="padding:15px 0px 15px 0px ;border-radius: 25px;margin-bottom: -2px;">
                                                    <div class="col-2 align-self-center" style="vertical-align: middle;padding:0px" data-toggle="collapse" data-target="#Line_{{ $item->id }}" aria-expanded="false" aria-controls="form_delete_{{ $item->id }}" >
                                                        <a class="link text-danger" href="#map" onclick="view_marker('{{ $item->lat }}' , '{{ $item->lng }}' , '{{ $item->id }}');">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <br>
                                                            ดูหมุด
                                                        </a>
                                                        <br>
                                                        <a class="link text-info" href="https://www.google.co.th/maps/search/{{$item->lat}},{{$item->lng}}/{{ $text_at }}{{$item->lat}},{{$item->lng}},16z" target="bank">
                                                            <i class="fas fa-location-arrow"></i>
                                                            <br>
                                                            นำทาง
                                                        </a>
                                                    </div>
                                                    <div class="col-8 d-flex align-items-center" style="margin-bottom:0px;padding:0px" data-toggle="collapse" data-target="#Line_{{ $item->id }}" aria-expanded="false" aria-controls="form_delete_{{ $item->id }}" >
                                                        <center class="col-12">
                                                            <h5 style="margin-bottom:0px; margin-top:0px; ">
                                                            <a target="break" href="{{ url('/').'/profile/'.$item->id }}"><i class="far fa-eye text-primary"></i></a></span>
                                                                {{ $item->name_user }}
                                                            </h5>
                                                        </center>
                                                    </div>
                                                    <div class="col-2 align-self-center" style="vertical-align: middle;" data-toggle="collapse" data-target="#sos_{{ $item->id }}" aria-expanded="false" aria-controls="form_delete_{{ $item->id }}" >
                                                        <i class="fas fa-angle-down" ></i>
                                                    </div>
                                                    <div class="col-12 collapse" id="sos_{{ $item->id }}">
                                                        <hr>
                                                        <p style="font-size:18px;padding:0px"> เบอร์ :    </p> <hr>
                                                        <p style="font-size:18px;padding:0px">วันที่แจ้ง <br>

                                                            {{ date("l d F Y" , strtotime($item->created_at)) }}
                                                            <br>
                                                        </p>  <hr>
                                                        <p style="font-size:18px;padding:0px"> เวลา:  {{ date("H:i" , strtotime($item->created_at)) }}

                                                        </p>
                                                         <hr>
                                                        <p style="font-size:18px;padding:0px">รูปภาพ <br>

                                                        </p>
                                                    </div>
                                                </div>
                                            </center>
                                        </div>
                                    @endforeach
                                    <div class="pagination-wrapper"> {!! $view_maps->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>
                        </div>
                    </div>
                <!-------------------------------- end mobile--------------------------------------------- -->
<!------------------------------------------- Modal ให้ความช่วยเหลือ ------------------------------------------->
<div class="modal fade"  id="Partner_gsos" tabindex="-1" role="dialog" aria-labelledby="Partner_gsosTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" >
        <div class="modal-header" >
          <h5 class="modal-title" style="font-family: 'Prompt', sans-serif;" id="Partner_gsosTitle">ให้ความช่วยเหลือ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- <br>
          <section id="about2" class="about2" style="padding:0px;">
              <div style="border: 1px solid red; border-radius: 10px;" class="video-box d-flex justify-content-center align-items-stretch position-relative">
                  <a href="{{ asset('Medilab/video/VII Video v4.mp4') }}" class="glightbox play-btn mb-12"></a>
              </div>
          </section>
          <br>
          <hr>
          <br> -->
          <center><img src="{{ asset('/img/วิธีใช้งาน_p/7.png') }}" style="border: 2px solid #555;" width="100%" alt="Card image cap"></center><br>
          <div class="card col-12" style="font-family: 'Prompt', sans-serif; margin-bottom: 10px;" >
              <div class="row col-12 card-body" style="padding: 15px 0px 15px 0px ;">
                  <div class="col-10" style="margin-bottom:0px" data-toggle="collapse" data-target="#login" aria-expanded="false" aria-controls="login">
                      <h5 style="margin-bottom:0px;font-family: 'Prompt', sans-serif;">1.แผนที่</h5>
                  </div>
                  <div class="col-2 align-self-center text-center" style="vertical-align: middle;"  data-toggle="collapse" data-target="#login" aria-expanded="false" aria-controls="login" >
                      <i class="fas fa-angle-down"></i>
                  </div>
                  <div class="col-12 collapse" id="login">
                      <br>
                      <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">สำหรับแสดงตำแหน่งของผู้ขอความช่วยเหลือ</h5>
                  </div>
              </div>
          </div>
          <div class="card col-12" style="font-family: 'Prompt', sans-serif; margin-bottom: 10px;">
              <div class="row col-12 card-body" style="padding:15px 0px 15px 0px ;" >
                  <div class="col-10" style="margin-bottom:0px"data-toggle="collapse" data-target="#Social_login" aria-expanded="false" aria-controls="Social_login">
                          <h5 style="margin-bottom:0px;font-family: 'Prompt', sans-serif;">2.ตารางขอความช่วยเหลือ</h5>
                  </div>
                  <div class="col-2 align-self-center text-center" style="vertical-align: middle;" data-toggle="collapse" data-target="#Social_login" aria-expanded="false" aria-controls="Social_login" >
                      <i class="fas fa-angle-down" ></i>
                      </div>
                  <div class="col-12 collapse" id="Social_login">
                    <br>
                    <center><img src="{{ asset('/img/วิธีใช้งาน_p/8.png') }}" style="border: 2px solid #555;" width="100%" alt="Card image cap"></center>
                    <br>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">1.ชื่อ : แสดงชื่อและเบอร์ผู้ขอความช่วยเหลือ</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">2.เวลา : แสดงแวลาที่ขอความช่วยเหลือ</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">3.สถานะ : แสดงสถานะการช่วยเหลือ</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">4.รูปภาพ : แสดงรูปภาพ</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">5.ตำแหน่ง : แสดงตำแหน่งผู้ขอความช่วยเหลือบนแผนที่ด้านข้าง</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">6.คะแนนความช่วยเหลือ : แสดงคะแนนที่ผู้ขอความช่วยเหลือประเมิน ผู้ให้ความช่วยเหลือ</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">7.จำนวนทั้งหมด : แสดงจำนวนผู้ขอความช่วยเหลือบนพื้นที่บริการของท่านทั้งหมด</h5>

                  </div>
              </div>
          </div>
          <div class="card col-12" style="font-family: 'Prompt', sans-serif; margin-bottom: 10px;">
              <div class="row col-12 card-body" style="padding:15px 0px 15px 0px ;" >
                  <div class="col-10" style="margin-bottom:0px"data-toggle="collapse" data-target="#sos_detail" aria-expanded="false" aria-controls="sos_detail">
                          <h5 style="margin-bottom:0px;font-family: 'Prompt', sans-serif;">3.ดูช่วงเวลา</h5>
                  </div>
                  <div class="col-2 align-self-center text-center" style="vertical-align: middle;" data-toggle="collapse" data-target="#sos_detail" aria-expanded="false" aria-controls="sos_detail" >
                      <i class="fas fa-angle-down" ></i>
                      </div>
                  <div class="col-12 collapse" id="sos_detail">
                    <br>
                    <center><img src="{{ asset('/img/วิธีใช้งาน_p/9.png') }}" style="border: 2px solid #555;" width="100%" alt="Card image cap"></center>
                    <br>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">1.การค้นหา
                      <h5 style="font-family: 'Prompt', sans-serif;text-indent:40px;"> 1.1.เลือกปี : เลือกปีที่ต้องการค้นหารายการขอความช่วยเหลือ</h5>
                      <h5 style="font-family: 'Prompt', sans-serif;text-indent:40px;"> 1.2.เลือกเดือน : เลือกเดือนที่ต้องการค้นหารายการขอความช่วยเหลือ</h5>
                      <h5 style="font-family: 'Prompt', sans-serif;text-indent:40px;"> 1.3.ค้นหา : เมื่อกรอกข้อมูลครบถ้วนและถูกต้องให้คลิกที่ปุ่มค้นหา</h5>
                      <h5 style="font-family: 'Prompt', sans-serif;text-indent:40px;"> 1.4.ล้างการค้นหา : เมื่อต้องการยกเลิกการค้นหาให้คลิกที่ปุ่มล้างการค้นหา</h5>
                    </h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">2.ตารางขอความช่วยเหลือสำหรับกลางวัน : แสดงจำนวนจำนวนที่ถูกขอความช่วยเหลือ ตั้งแต่เวลา 1 A.M. - 12 A.M.</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">3.ตารางขอความช่วยเหลือสำหรับกลางคืน : แสดงจำนวนจำนวนที่ถูกขอความช่วยเหลือ ตั้งแต่เวลา 1 P.M. - 12 P.M.</h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">4.ขอความช่วยเหลือที่ค้นหาทั้งหมด : แสดงจำนวนการขอความช่วยเหลือตามช่วงเวลาที่ค้นหา </h5>
                    <h5 style="text-indent:20px;font-family: 'Prompt', sans-serif; margin-bottom: 10px;">5.ขอความช่วยเหลือทั้งหมด : แสดงจำนวนการขอความช่วยเหลือทั้งหมด</h5>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
  <!------------------------------------------- Modal ให้ความช่วยเหลือ------------------------------------------->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus"></script>
<style type="text/css">
    #map {
      height: calc(80vh);
    }

</style>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        let name_area = document.querySelector('#name_area').value;
        let type_partner = document.querySelector('#type_partner').value;

        if (type_partner != 'volunteer') {
            initMap();
        }else{
            initMap_not_Polygon('12.870032' , '100.992541','6');
        }


    });

    var test = 1;
    var draw_area ;
    var map ;
    var marker ;
    var all_lat_lng = [];



    function initMap() {
        var bounds = new google.maps.LatLngBounds();

        @foreach($view_maps_all as $latlng)
            @if(!empty($latlng->lat && $latlng->lng))
                // all_lat_lng.push(JSON.parse('{"lat": {{$latlng->lat}},"lng": {{$latlng->lng}} }'));
                bounds.extend(JSON.parse('{"lat": {{$latlng->lat}},"lng": {{$latlng->lng}} }'));
                // console.log(JSON.parse('{"lat": {{$latlng->lat}},"lng": {{$latlng->lng}} }'));
            @endif
        @endforeach


        // 13.7248936,100.4930264 lat lng ประเทศไทย
        map = new google.maps.Map(document.getElementById("map"), {
            // center: {lat: 13.7248936, lng: 100.4930264 },
            // zoom: 14,
        });

        map.fitBounds(bounds);

        let image = "{{url('/img/logo_mithcare/marker/Marker_mithcare50.png')}}";
        @foreach($view_maps_all as $view_map)
            @if(!empty($view_map->lat))
                marker = new google.maps.Marker({
                    position: {lat: {{ $view_map->lat }} , lng: {{ $view_map->lng }} },
                    map: map,
                    icon: image,
                    zIndex:5,
                });
            @endif
        @endforeach
    // console.log(all_lat_lng);


          //extend the bounds to include each marker's position
        // bounds.extend(marker.position);



        //ปักหมุด


    }

    // function initMap_not_Polygon(lat , lng , numZoom) {

    //     let m_lat = parseFloat(lat);
    //     let m_lng = parseFloat(lng);
    //     let m_numZoom = parseFloat(numZoom);
    //     // 13.7248936,100.4930264 lat lng ประเทศไทย
    //     map = new google.maps.Map(document.getElementById("map"), {
    //         center: {lat: m_lat, lng: m_lng },
    //         zoom: m_numZoom,
    //     });

    //     let all_lat = [];
    //     let all_lng = [];
    //     let all_lat_lng = [];

    //     let lat_average ;
    //     let lng_average ;

    //     let lat_sum = 0 ;
    //     let lng_sum = 0 ;

    //     //ปักหมุด
    //     let image = "https://www.viicheck.com/img/icon/flag_2.png";
    //     @foreach($view_maps_all as $view_map)
    //     @if(!empty($item->lat))
    //         marker = new google.maps.Marker({
    //             position: {lat: {{ $view_map->lat }} , lng: {{ $view_map->lng }} },
    //             map: map,
    //             icon: image,
    //             zIndex:5,
    //         });
    //     @endif
    //     @endforeach

    // }

    // function select_name_area(name_area){

    //     let name_partner = document.querySelector('#name_partner').value;

    //     fetch("{{ url('/') }}/api/area_current/"+name_partner  + '/' + name_area)
    //         .then(response => response.json())
    //         .then(result => {
    //             // console.log(result);

    //             var bounds = new google.maps.LatLngBounds();

    //             for (let ix = 0; ix < result.length; ix++) {
    //                 bounds.extend(result[ix]);
    //             }

    //         map = new google.maps.Map(document.getElementById("map"), {
    //             // zoom: 18,
    //         });
    //         map.fitBounds(bounds);

    //         // Construct the polygon.
    //         draw_area = new google.maps.Polygon({
    //             paths: result,
    //             strokeColor: "#008450",
    //             strokeOpacity: 0.8,
    //             strokeWeight: 1,
    //             fillColor: "#008450",
    //             fillOpacity: 0.25,
    //         });
    //         draw_area.setMap(map);

    //         //ปักหมุด
    //         let image = "https://www.viicheck.com/img/icon/flag_2.png";
    //         @foreach($view_maps_all as $view_map)
    //         @if(!empty($item->lat))
    //             marker = new google.maps.Marker({
    //                 position: {lat: {{ $view_map->lat }} , lng: {{ $view_map->lng }} },
    //                 map: map,
    //                 icon: image,
    //                 zIndex:5,
    //             });
    //         @endif
    //         @endforeach
    //     });

    // }


    function view_marker(lat , lng , sos_id ){

        let name_partner = document.querySelector('#name_partner').value;

        fetch("{{ url('/') }}/api/marker_current"+ "/" + name_partner)
            .then(response => response.json())
            .then(result => {
                // console.log(result);


            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: { lat: parseFloat(lat), lng: parseFloat(lng) },
            });


            let image = "{{url('/img/logo_mithcare/marker/Marker_mithcare50.png')}}";
            marker = new google.maps.Marker({
                position: {lat: parseFloat(lat) , lng: parseFloat(lng) },
                map: map,
                icon: image,
            });

        });

    }

</script>

@endsection
