@extends('layouts.mithcare')

@section('content')

<style>
    .page-item{
        border-radius: 50%!important;
        padding: 5px;

    }
</style>

<section class="page-title page-title-layout5">
    <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">{{Auth::user()->name}}</h1>
                <nav>
                    <!-- แสดงเฉพาะคอม -->
                    <div class="d-none d-lg-block">
                        <ol class=" breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">GAME</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">GAME</a></li>
                        </ol>
                    </div> <!--d-block d-md-none -->
                </nav>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->


   {{--//////////////////
            Game
     //////////////// --}}

     <div class="container mt-3">
        <div class="row">
            <div class="col-6 ">
                @if(Auth::user()->role == 'isAdmin')
                    <!-- Button trigger modal -->
                    <a href="{{ url('/game/create') }}" class="btn btn-info btn-sm main-shadow main-radius mr-2 mt-3" style="font-size: 20px;">
                        <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มเกมใหม่
                    </a>
                @endif
            </div>
            <div class="col-6">
                <form method="GET" action="{{ url('/game') }}" accept-charset="UTF-8"
                class="form-inline my-2 my-lg-0 float-right " role="search">
                <div class="input-group mt-3">
                    <input type="text" class="form-control d" name="search" placeholder="ค้นหา"
                        value="{{ request('search') }}">

                    <span class="input-group-append">
                        <button class="btn-old btn-info"  type="submit"
                        style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px; border-color:#495057" >
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                </form>
            </div>
        </div>
        <hr>
    </div>



<section class="team-layout1 pb-40">
<div class="container">
    <div class="row">
        @foreach ($game as $item)
            <!-- Member #1 -->

                <div class="col-sm-6 col-md-4 col-lg-4" >
                    <a href="{{$item->link}}" target="_blank" onclick="click_game('{{$item->id}}')">
                    <div class="member" style="background-color: #c7e5e9" >
                        {{-- <form method="POST" id="click" action="{{ url('/game')}}"
                            accept-charset="UTF-8" style="display:inline">
                            {{ csrf_field() }} --}}
                            <div class="member__img">
                                    <img src="{{ url('storage/'.$item->img )}}" height="350px" width="100%" alt="member img" >
                                {{-- <div class="member__hover">

                                        <ul class="social-icons list-unstyled mb-0">
                                            <li><a href="{{ url('/game/'. $item->id . '/edit') }}" class="facebook"><i class="fa-solid fa-pen-to-square"></i></a></li>
                                            <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" class="phone"><i class="fas fa-phone-alt"></i></a></li>
                                        </ul><!-- /.social-icons -->

                                </div><!-- /.member-hover --> --}}
                            </div><!-- /.member-img -->
                            <div class="member__info">
                                <h4 class="member__name"><a href="{{$item->link}}" target="_blank" onclick="click_game('{{$item->id}}')">{{$item->name}}</a></h4>
                        {{-- </form> --}}
                                <p id="amount_id_{{$item->id}}" class="text-primary h5">จำนวนครั้งที่เล่น : {{$item->amount_click}}</p>
                                <hr>
                                <p class="h5">{{$item->detail_of_game}}</p>

                            </div><!-- /.member-info -->

                              {{-- //ปุ่ม เพิ่มเติม// --}}

                        {{-- /// เช็คว่าเป็นแอดมิน-> มองเห็นปุ่มสร้างเกม // --}}

                        @if(Auth::user()->role == 'isAdmin')
                        <div class="row">
                            <div class="col-12 ">
                                <a data-toggle="collapse" href="#game{{$item->id}}" aria-expanded="false" aria-controls="game{{$item->id}}"
                                    class="btn-old btn-info main-shadow main-radius mr-2 mt-3" style="float: right; ">
                                    เพิ่มเติม <i class="fa-solid fa-caret-down"></i>
                                </a>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="collapse" id="game{{$item->id}}">
                                    <br>
                                    <div class="row justify-content-around">
                                        <div class=" ml-2 mb-2">
                                            <a href="{{ url('/game/' . $item->id . '/edit') }}" class="btn-old btn-primary btn-sm main-radius main-shadow">
                                                <i class="fa-solid fa-pen-to-square"></i> แก้ไขเกม
                                            </a>
                                        </div>

                                        <div class=" ml-2 mb-2">

                                            <button data-toggle="modal" data-target="#delete{{$item->id}}"
                                            class="btn-old btn-danger btn-sm main-shadow main-radius" >
                                                <i class="fa-solid fa-trash"></i> ลบเกม
                                            </button>

                                            <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$item->id}}" aria-hidden="true">
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
                                                                        <h5 class="text-warning">
                                                                            <i class="fa-solid fa-warning"></i> ท่านต้องการลบเกมหรือไม่
                                                                        </h5>
                                                                        <br>
                                                                        <br>

                                                                        <div class="row justify-content-between">
                                                                            <form method="POST" action="{{ url('/game' . '/' . $item->id) }}" accept-charset="UTF-8">
                                                                                {{ method_field('DELETE') }}
                                                                                {{ csrf_field() }}
                                                                                <button type="submit" class="btn-old btn-secondary btn-sm main-shadow main-radius"  >
                                                                                    <i class="fa-solid fa-trash"></i> ยืนยัน
                                                                                </button>
                                                                            </form>
                                                                            <div>
                                                                                <button type="submit" class="btn-old btn-primary btn-sm main-shadow main-radius" data-dismiss="modal" aria-label="Close">
                                                                                    <i class="fa-solid fa-arrow-right"></i> ยกเลิก
                                                                                </button>
                                                                            </div>

                                                                        </div>


                                                                    </div><!-- container -->
                                                                </div><!-- contact-panel -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.collapse -->
                            </div><!-- /.col-12 mt-5 -->
                        </div><!-- /.row -->
                        @endif
                    </div><!-- /.member -->
                    </a>
                </div><!-- /.col-lg-4 -->


        @endforeach
    </div><!-- /.row -->
      <div class="pagination" > {!! $game->appends(['search' => Request::get('search')])->render() !!}  </div>

        <nav class="pagination-area">
            <ul class="pagination justify-content-center">
                {{-- <li><a href="#"><i class="icon-arrow-left"></i></a></li>
                <li><a class="current" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#"><i class="icon-arrow-right"></i></a></li> --}}
            </ul>
        </nav>

</div><!-- /.container -->
</section>
@endsection

<script>
    function click_game(id){
        // console.log(id)
        let url = "{{ url('/api/game') }}?from_click=" + id ;

        fetch(url)
            .then(response => response.text())
            .then(result => {
                // console.log(result);
                document.querySelector('#amount_id_' + id).innerHTML = "จำนวนครั้งที่เล่น : " + result;

            });
    }


    function showAmphoes() {
        let input_province = document.querySelector("#input_province");
        let url = "{{ url('/api/amphoes') }}?province=" + input_province.value;
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
</script>
