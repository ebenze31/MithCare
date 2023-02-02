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

                    @foreach($find_room as $item)
                    <center>
                        <div class="col-md-4 col-sm-12">
                            <div class="card product-item ">
                            @if(!empty($item->home_pic))
                                <img class="card-img-top p-3 " src="{{ url('storage/'.$item->home_pic )}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                            @else
                                <img class="card-img-top p-3 " src="{{asset('/img/logo_mithcare/home-background.png')}}" width="100%" height="150px" style="object-fit: cover;" alt="Card image cap">
                            @endif
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <hr>
                                            <p class="pricing__title text-center mt-2 p-2 h3" style="color: #4170A2;">{{$item->name}}</p>

                                            <p style="font-size: 20px;">เจ้าของบ้าน : {{$item->user->name}}</p>
                                            <hr>
                                        </div>
                                    </div>

                                </div><!--  card-body -->
                            </div><!--  card -->
                        </div><!--  col-md-4 col-sm-12 -->
                    </center>
                    @endforeach

                    <div class="row">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}} col-12 col-md-12">
                            <label for="status" class="control-label" style="font-size: 25px;">{{ 'สถานะ' }}</label>
                            <select name="status" class="form-control" id="status" required>
                                <option selected disabled>กรุณาเลือกสถานะ</option>
                                @foreach (json_decode('{"member":"สมาชิก","patient":"ผู้ป่วย"}', true) as $optionKey => $optionvalue)
                                <option value="{{ $optionKey }}" {{ (isset($member->status) && $member->status == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
                                @endforeach
                            </select>
                        </div> <!--///  สถานะ /// -->
                     </div><!-- /row -->

                     <div class="row">
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}} col-12 col-md-12">
                            <label for="gender" class="control-label" style="font-size: 25px;">{{ 'เลือกผู้ป่วยเพื่อดูแล' }}</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option selected disabled>กรุณาเลือกสถานะ</option>
                                @foreach (json_decode('{"member":"สมาชิก","patient":"ผู้ป่วย"}', true) as $optionKey => $optionvalue)
                                <option value="{{ $optionKey }}" {{ (isset($member->gender) && $member->gender == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
                                @endforeach
                            </select>
                        </div> <!--///  เลือกผู้ดูแล /// -->
                     </div><!-- /row -->

                    <div class="row">
                        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}} col-12 col-md-12">
                            <label for="gender" class="control-label" style="font-size: 25px;">{{ 'ระดับ' }}</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option selected disabled>กรุณาเลือกระดับผู้ป่วย</option>
                                @foreach (json_decode('{"1":"ระดับ 1","2":"ระดับ 2"}', true) as $optionKey => $optionvalue)
                                <option value="{{ $optionKey }}" {{ (isset($member->lv_of_caretaker) && $member->lv_of_caretaker == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
                                @endforeach
                            </select>
                        </div> <!--///  เพศ /// -->
                     </div><!-- /row -->

                     <div class="form-group">
                        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit" value="">
                            บันทึก
                        </button>
                    </div>


            </div><!--  contact-panel -->
        </div><!--  row -->
    </div><!-- /container -->
</section><!-- กันสั่น -->
@endsection
