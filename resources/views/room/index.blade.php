@extends('layouts.mithcare')

@section('content')



<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">{{$user->name}}</h1>
                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้านของฉัน</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้านของฉัน</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->



<div class="container mt-3">
    <div class="row d-flex justify-content-end ">

        <!-- Button trigger modal -->
        <a class="btn btn-info btn-sm main-shadow main-radius mr-2" style="font-size: 20px; color:#ffffff;" id="btn_create_room" data-toggle="modal" data-target="#create_room">
            <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มบ้านใหม่
        </a>

        <a href="{{ url('/room_join') }}" class="btn btn-primary btn-sm main-shadow main-radius mr-2" style="font-size: 20px;" id="btn_find_room" data-toggle="modal" data-target="#join_room">
            <i class="fa-solid fa-right-to-bracket"></i>ขอเข้าร่วม</a>


        <!--/////// Modal หน้าสร้างบ้าน ///////////-->

        <div class="modal fade" id="create_room" tabindex="-1" role="dialog" aria-labelledby="create_roomTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="min-height: 100%">
                    <!-- หน้าสร้างบ้าน -->
                    <div class="container">
                        <div class="row">
                            <div class="contact-panel col-md-12 mb-2">

                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <div class="container">
                                <h3 ><i class="fa-solid fa-home"></i> สร้างบ้านใหม่</h3>
                                    <br />
                                    <br />
                                    @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @endif

                                    <form method="POST" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-horizontal h5" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        @include ('room.form_create')

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--///////End Modal หน้าสร้างบ้าน ///////////-->

        <!--/////// Modal เข้าร่วมบ้าน ///////////-->

        <div class="modal fade" id="join_room" tabindex="-1" role="dialog" aria-labelledby="join_roomTitle" aria-hidden="true">
            <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- หน้าเข้าร่วมบ้าน -->
                    <div class="container">
                        <div class="row">
                            <div class="contact-panel col-md-12 mb-2">
                                <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>


                                <div class="container">
                                    <h3><i class="fa-solid fa-right-to-bracket"></i> ค้นหาบ้าน</h3>
                                    <br />
                                    <br />
                                        {{-- @include ('room.form_join') --}}
                                        {{-- <input type="text" class="form-control" placeholder="Search..."> --}}
                                    <div class="form-group ">
                                        <label for="pass" class="control-label">{{ 'ชื่อบ้านหรือรหัสบ้าน' }}</label>
                                        <input id="user_login_fullname" type="text" class="form-control d-none" name="user_login_fullname" value="{{Auth::user()->id}}">
                                        <input id="input_search" type="text" class="form-control" name="find_room_search" value="" >


                                        <button class="btn btn-primary form-control mt-4" style="background-color: #3490dc; font-size: 25px; color: white;" onclick="Super_search()">
                                            ค้นหาบ้าน
                                        </button>
                                    </div>



                                    <div class="row">
                                        <div id="show_data_room" name="show_data_room" class="col-12 d-none" >

                                        </div><!--  col-md-4 col-sm-12 -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--///////End Modal เข้าร่วมบ้าน ///////////-->
    </div>
</div>

<section class="page-title page-title-layout5 p-3">
    <div class="container">
        <div class="row">

            <!--//////// Sidebar ////////-->

            <!--////// End Sidebar /////////-->


            <div class="contact-panel col-md-12 mb-2">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <h2>บ้านของฉัน</h2>
                    </div>
                    <div class=" col-md-4 col-12">
                        <div class="widget widget-search">
                            <div class="widget__content">
                                <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="widget__form-search">
                                    <input id="search" name="search" type="text" class="form-control" placeholder="Search...">
                                    <button class="btn" type="submit"><i class="icon-search"></i></button>
                                </form>
                            </div><!-- /.widget-content -->
                        </div>

                    </div>
                </div>
                <hr width="97%">
                <div class="row">


                    @foreach($my_room as $item)
                    <div class="col-md-4 col-sm-12">
                        <div class="card product-item ">
                        @if(!empty($item->room->home_pic))
                            <img class="card-img-top p-3 " src="{{ url('storage/'.$item->room->home_pic )}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                        @else
                            <img class="card-img-top p-3 " src="{{asset('/img/logo_mithcare/home-background.png')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                        @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ url('/room/' . $item->room->id) }}" class="btn-old btn-info btn-sm btn-block main-shadow main-radius">
                                            <!-- <i class="fa-solid fa-magnifying-glass"></i>  -->
                                            รายละเอียด
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        @if (!empty($type))
                                            <a href="{{ url('/appoint/') }}?room_id={{ $item->room->id }}&type={{$type}}" class="btn-old btn-primary btn-sm btn-block main-shadow main-radius">
                                                ตารางนัด
                                            </a>
                                        @else
                                            <a href="{{ url('/appoint/') }}?room_id={{ $item->room->id }}" class="btn-old btn-primary btn-sm btn-block main-shadow main-radius">
                                                ตารางนัด
                                            </a>
                                        @endif

                                    </div>
                                    <div class="col-12 mt-3">
                                        <a href="{{ url('/room_lobby/') }}?room_id={{ $item->room->id }}" class="btn-old btn-info btn-sm btn-block main-shadow main-radius">
                                            <!-- <i class="fa-solid fa-magnifying-glass"></i>  -->
                                            ห้องสนทนา
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                        <p class="pricing__title text-center mt-2 p-2 h3" style="color: #4170A2;">{{$item->room->name}}</p>
                                        @php
                                            $data_room = \App\Models\Room::where('id',$item->room_id)->first();
                                        @endphp
                                        <p style="font-size: 20px;">เจ้าของบ้าน : {{ $data_room->user->name }}</p>
                                        <hr>
                                    </div>
                                </div>



                                @if(Auth::user()->id == $item->room->owner_id)

                                <div class="row">


                                    <div class="col-12">
                                        <a data-toggle="collapse" href="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample{{$item->id}}" class="btn-old btn-info text-white" style="float: right;">
                                            เพิ่มเติม <i class="fa-solid fa-caret-down"></i>
                                        </a>

                                    </div>

                                    <div class="col-12 mt-5">
                                        <div class="collapse" id="collapseExample{{$item->id}}">
                                            <br>
                                            <div class="row">
                                                <div class="col-6 p-0">
                                                    <a href="{{ url('/room/' . $item->room->id . '/edit') }}" class="btn-old btn-primary btn-sm main-radius main-shadow">
                                                        <i class="fa-solid fa-pen-to-square"></i> แก้ไขบ้าน
                                                    </a>
                                                </div>
                                                <div class="col-6 p-0">
                                                    {{-- <form method="POST" action="{{ url('/room' . '/' . $item->room->id) }}" accept-charset="UTF-8">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn-old btn-danger btn-sm main-shadow main-radius" title="Delete Room" onclick="return confirm('ต้องการลบใช่หรือไม่')">
                                                            <i class="fa-solid fa-trash"></i> ยืนยัน
                                                        </button>
                                                    </form> --}}

                                                    <button data-toggle="modal" data-target="#room_delete"
                                                    class="btn-old btn-danger btn-sm main-shadow main-radius" title="Delete Room">
                                                        <i class="fa-solid fa-trash"></i> ลบบ้าน
                                                    </button>

                                                    <div class="modal fade" id="room_delete" tabindex="-1" role="dialog" aria-labelledby="room_delete" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <!-- หน้าสร้างบ้าน -->
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="contact-panel col-md-12 mb-2">

                                                                            <button  class="close " style="border-radius: 80%; " data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>

                                                                            <div class="container">
                                                                            <h5 class="text-warning"><i class="fa-solid fa-warning"></i> ท่านต้องการลบบ้านหรือไม่</h5>
                                                                            <br>
                                                                            <br>

                                                                            <div class="row justify-content-between">
                                                                                <form method="POST" action="{{ url('/room' . '/' . $item->room->id) }}" accept-charset="UTF-8">
                                                                                    {{ method_field('DELETE') }}
                                                                                    {{ csrf_field() }}
                                                                                    <button type="submit" class="btn-old btn-secondary btn-sm main-shadow main-radius" title="Delete Room" >
                                                                                        <i class="fa-solid fa-trash"></i> ยืนยัน
                                                                                    </button>
                                                                                </form>

                                                                                <button type="submit" class="btn-old btn-primary btn-sm main-shadow main-radius" data-dismiss="modal" aria-label="Close">
                                                                                    <i class="fa-solid fa-arrow"></i> ยกเลิก
                                                                                </button>
                                                                            </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div><!--  card-body -->
                        </div><!--  card -->
                    </div><!--  col-md-4 col-sm-12 -->
                    @endforeach
                </div>
                <div class="pagination-wrapper"> {!! $my_room->appends(['search' => Request::get('search')])->render() !!} </div>

            </div> <!-- contact-panel -->

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");

        if('{{$check_url}}' == 'create_room'){
            document.querySelector('#btn_create_room').click();
        }else if('{{$check_url}}' == 'find_room'){
            document.querySelector('#btn_find_room').click();
        }

    });
</script>

<script>
      function Super_search() {

        let search = document.querySelector("#input_search");
        let url = "{{ url('/api/find_room') }}?search=" + search.value ;
        // let test_insert = document.querySelector('#test_insert');
        let show_data_room = document.querySelector('#show_data_room');
            show_data_room.innerHTML = "";
        // console.log(search);

        if(search.value){
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    // console.log(result);

                    let user = document.querySelector('#user_login_fullname').value;
                    let user_in_room = [];
                    let class_color = [];
                    let html;
                    let xi = 0;
                    if(result.length != 0){
                        for(i=0; i<result.length; i++){
                            // console.log(result[i]['name']);
                            if(result[i]['user_id'] === '{{Auth::user()->id}}'){
                                user_in_room[xi] = result[i]['id'];
                                xi++;
                            }

                            let img_home_pic ;
                            if (result[i]['home_pic']) {
                                img_home_pic = '{{ url("storage") }}' + '/' + result[i]['home_pic'] ;
                            }else{
                                // ใส่รูปเวลาไม่มีรูปบ้าน รูปอะไรก็ได้
                                img_home_pic = 'http://localhost/mithcare/public/img/logo_mithcare/mithcare_nurse_1.png' ;
                            }

                            let div_data_add = document.createElement("div");
                            let id_div_data_add = document.createAttribute("id");
                            id_div_data_add.value = "dataid" + result[i]['id'];
                            div_data_add.setAttributeNode(id_div_data_add);
                            show_data_room.appendChild(div_data_add);
                            // console.log(id_div_data_add.value);
                            // if(user === result[i]['owner_id'])
                            // let photo_home_pic = 'www.mithcare.com/storage' + '/' + result[i]['home_pic'];

                            html =  '<form method="POST" action="{{ url("/room_find") }}" accept-charset="UTF-8" class="" enctype="multipart/form-data">' +
                                        '{{ csrf_field() }}' +
                                            '<div class="card product-item ">' +
                                                '<div class="card-body ">' +
                                                    '<div class="row d-flex justify-content-center align-items-center">' +
                                                        '<div class="col-12 col-md-3 col-lg-4">' +
                                                            //  if(result[i]['home_pic']){
                                                            //     '<div>' + 'ไม่มีภาพ' + '</div>' +
                                                            //  }else{
                                                            //     '<div>' + result[i]['home_pic'] + '</div>' +
                                                            //  }
                                                            // '<img class="card-img-top p-3 " src="'+ photo_home_pic[i] +'" width="100%" style="object-fit: cover;" alt="Card image cap">' +
                                                            // '<div>' + photo_home_pic[i] + '</div>' +
                                                            '<img height="182px" id="imgResource'+ result[i]['id'] +'" src="' + img_home_pic + '"  />'  +

                                                            // '<div id="imgResource'+result[i]['id']+'">' + '</div>' +

                                                        '</div>' +
                                                        '<div class="col-12 col-md-6 col-lg-4">' +
                                                            '<h5 id="div_name_room_join_room'+result[i]['id']+'" class="mt-2 text-primary">' + '<i class="fa-solid fa-house ">&nbsp;' + '</i>' + result[i]['name'] +'</h5>' +
                                                            '<p class="text-bold" style="font-weight: bold;">' + 'เจ้าของ' + '<br>' + result[i]['full_name_owner'] + '</p>' +
                                                            '<p class="text-bold" style="font-weight: bold;">' + '(' + result[i]['name_owner']+ ')' + '</p>' +
                                                        '</div>' +


                                                            '<div id="div_btn_join_room'+result[i]['id']+'" class="col-12 col-md-6 col-lg-4">' +
                                                                '<input class="form-control" type="password" name="pass_room" id="pass_room'+result[i]['id']+'" autocomplete="new-password" placeholder="พาสเวิร์ด">' +
                                                                '<input class="form-control d-none" name="id_select_room" id="id_select_room" value="'+ result[i]['id'] +'">' +

                                                                '<div id="div_submit_room'+result[i]['id']+'"></div>' +
                                                                '<span id="password_check'+result[i]['id']+'" class="btn btn-primary p-0 m-2" style="font-size: 20px; color: white;" onclick="Password_check_of_room('+result[i]['id']+')">' +
                                                                    'ขอเข้าร่วม' +
                                                                '</span>' +
                                                            '</div>' +

                                                            '<div id="div_btn_join_laew_room'+result[i]['id']+'" class="col-12 col-md-6 col-lg-4 d-none">' +
                                                                '<span class="btn btn-success p-0 m-2" style="font-size: 20px; color: white;" >' +
                                                                    'เข้าร่วมแล้ว' +
                                                                '</span>' +
                                                            '</div>' +


                                                    '</div>' +

                                                '</div>' +
                                            '</div>' +
                                    '</form>' ;

                            // document.querySelector('#imgResource' + result[i]['home_pic']).innerHTML = html;
                            document.querySelector('#dataid' + result[i]['id']).innerHTML = html;
                        }
                        document.querySelector('#show_data_room').classList.remove('d-none');
                        // console.log(user_in_room);
                        for(x=0; x<user_in_room.length; x++){
                            document.querySelector("#div_btn_join_room"+ user_in_room[x]).classList.add('d-none');
                            document.querySelector("#div_btn_join_laew_room"+ user_in_room[x]).classList.remove('d-none');

                            document.querySelector("#div_name_room_join_room"+ user_in_room[x]).classList.add('text-success');
                            document.querySelector("#div_name_room_join_room"+ user_in_room[x]).classList.remove('text-primary');
                            // console.log(user_in_room[x]);
                        }
                    }

                });
        }
        // console.log(url);


    }
</script>

<script>
    function Password_check_of_room(id){
        // console.log(id);
        let pass_room = document.querySelector('#pass_room'+ id);
        // console.log(pass_room);

        let url = "{{ url('/api/check_password_of_room') }}?password=" + pass_room.value + "&id=" + id;

        fetch(url)
            .then(response => response.text())
                .then(result => {

                    if(result === 'yes'){
                        let div_btn = document.querySelector('#div_submit_room'+ id);

                        let html = '<button id="password_check_match_exacly'+id+'" class="btn btn-primary p-0 m-2 d-none" style="background-color: #3490dc; font-size: 20px; color: white;" type="submit">' +
                                        'ขอเข้าร่วม5' +
                                    '</button>';
                            div_btn.innerHTML = html;
                        document.querySelector('#password_check_match_exacly'+id).click();
                    }else{
                        let div_btn = document.querySelector('#div_submit_room'+ id);
                        let html =
                                    '<a id="password_check_match_exacly'+id+'" class="text-danger p-0 m-2 alert-fade-password'+id+'" font-size: 20px; color: white;" >' +
                                        'รหัสผ่านไม่ถูกต้อง' +
                                    '</a>';
                            div_btn.innerHTML = html;

                            $(document).ready(function(){
                                $('.alert-fade-password'+id).fadeIn().delay(3000).fadeOut();
                            });
                    }
                });

    }
</script>


@endsection




