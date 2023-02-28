@extends('layouts.admin.main')

@section('content')

<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Partner</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-8 col-lg-8">
                                <a href="{{ url('/partner/create') }}" class="btn btn-success btn-sm" title="Add New Partner">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม พาร์ทเนอร์
                                </a>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <form method="GET" action="{{ url('/partner') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="input-group ">
                                        <input type="text" class="form-control " name="search" placeholder="Search..." value="{{ request('search') }}">
                                        <button class="input-group-append btn btn-secondary " type="submit">
                                                <i class="fa fa-search pt-3"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div><!--row -->

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th>โลโก้พาร์เนอร์</th><th>ชื่อพาร์เนอร์</th><th>การแสดงผล</th><th>###</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="pagination-wrapper"> {!! $partner->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- <hr> -->
                                @foreach($partner as $item)
                                <div class="row">
                                    <div class="col-2">
                                        <center>
                                            <img src="{{ url('storage')}}/{{ $item->logo }}" width="40%">
                                        </center>
                                    </div>
                                    <div class="col-5">
                                        <div>
                                            <h4 id="tag_h_name_{{ $item->id }}" class="text-center">
                                                <a >
                                                    <span class="text-success ">{{ $item->name }}</span>
                                                    <p>{{ $item->full_name }}</p>
                                                </a>
                                            </h4>
                                        </div>
                                        <div style="margin-top:20px;" class="text-center">
                                            <b>Phone : </b>{{ $item->phone }} &nbsp;&nbsp;&nbsp;
                                            <b>Mail : </b>{{ $item->mail }}&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="col-3">
                                            @if($item->show_homepage == "show")
                                                <label class="switch">
                                                    <input type="checkbox" checked class="checkbox" id="customSwitch1_{{ $item->id }}" onclick="document.querySelector('#input_show_homepage_' + {{ $item->id }}).value = 'no',submit_show_homepage('{{ $item->id }}');">
                                                    <span class="slider round"></span>
                                                </label>
                                            @else
                                                <label class="switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1_{{ $item->id }}" onclick="document.querySelector('#input_show_homepage_' + {{ $item->id }}).value = 'show',submit_show_homepage('{{ $item->id }}');">
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                            {{-- @if($item->show_homepage == "show")
                                                <div class="custom-control custom-switch">
                                                    <br><br>
                                                    <input type="checkbox" checked class="custom-control-input" id="customSwitch1_{{ $item->id }}" onclick="document.querySelector('#input_show_homepage_' + {{ $item->id }}).value = 'no',submit_show_homepage('{{ $item->id }}');">
                                                    <label class="custom-control-label" for="customSwitch1_{{ $item->id }}"></label>
                                                </div>
                                            @else
                                                <div class="custom-control custom-switch">
                                                    <br><br>
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1_{{ $item->id }}" onclick="document.querySelector('#input_show_homepage_' + {{ $item->id }}).value = 'show',submit_show_homepage('{{ $item->id }}');">
                                                    <label class="custom-control-label" for="customSwitch1_{{ $item->id }}"></label>
                                                </div>
                                            @endif --}}
                                            <input class="d-none" type="text" name="input_show_homepage_{{ $item->id }}" id="input_show_homepage_{{ $item->id }}" value="">
                                    </div>
                                    <div class="col-2">
                                        <div style="float: right;">
                                            <a href="{{ url('/partner'. '/'.$item->id) }}" class="btn btn-sm btn-primary">
                                                ดูข้อมูล
                                            </a>
                                            <a href="{{ url('/partner'. '/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning text-white">
                                                แก้ไข
                                            </a>
                                            <form method="POST" action="{{ url('/partner_viicheck' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Not_comfor" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt"></i> ลบ</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                            <!-- Button trigger modal -->
                            <button id="btn_confirm_change" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#confirm_change">
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirm_change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">กรุณายืนยันการเปลี่ยนแปลง</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div>
                                        <center id="div_content">

                                        </center>
                                        <br>
                                        <div id="input_disapproved" class="d-none">
                                            <input type="radio" name="reason" id="reason_1" value="1" onclick="document.querySelector('#reason_other').classList.add('d-none'),document.querySelector('#answer_reason').value = '1',document.querySelector('#btn_submit_change').classList.remove('d-none')"> มีพื้นที่บางส่วนทับซ้อนหรือมีผู้ให้บริการพื้นที่นี้อยู่แล้ว <br>
                                            <input type="radio" name="reason" id="reason_2" value="2" onclick="document.querySelector('#reason_other').classList.add('d-none'),document.querySelector('#answer_reason').value = '2',document.querySelector('#btn_submit_change').classList.remove('d-none')">
                                            พื้นที่บริการไม่สมเหตุสมผลกับองค์กรของท่าน <br>
                                            <input type="radio" name="reason" id="reason_3" value="3" onclick="document.querySelector('#reason_other').classList.remove('d-none'),document.querySelector('#reason_other').focus(),document.querySelector('#answer_reason').value = '3',document.querySelector('#btn_submit_change').classList.remove('d-none')">
                                            อื่นๆ
                                            <br><br>
                                            <input class="form-control d-none" type="text" name="reason_other" id="reason_other" value="">
                                            <input type="hidden" id="answer_reason" value="">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button id="btn_submit_change" type="button" class="btn btn-primary" >ตกลง</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------------- end pc ----------------------------------------------->
    </div>
@endsection

<script>
    function submit_show_homepage(partner_id)
       {
           let input_show_homepage = document.querySelector('#input_show_homepage_' + partner_id).value ;
           // console.log(input_show_homepage);
           // console.log(partner_id);

           fetch("{{ url('/') }}/api/submit_show_homepage/" + partner_id + "/" + input_show_homepage)
               .then(response => response.text())
               .then(result => {
                   // console.log(result);
           });
       }
</script>
