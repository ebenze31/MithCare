@extends('layouts.mithcare')

@section('content')

<style>
    .btn-circle{
        font-size: 20px;
        font-weight: 700;
        display: block;
        width: 60px;
        height: 60px;
        line-height: 46px;
        text-align: center;
        border-radius: 50%;
        color: #4170A2;
        border: 2px solid #e6e8eb;
        background-color: #ffffff;
        -webkit-transition: all 0.3s linear;
        transition: all 0.3s linear;
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
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 30px;">{{$room->name}}</a></li>
                        </ol>
                    </div> <!--d-none d-lg-block -->
                    <!-- แสดงเฉพาะมือถือ -->
                    <div class="d-block d-md-none">
                        <ol class=" breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้านของฉัน</a></li>
                            <li class="breadcrumb-item"><a href="#" style="font-size: 20px;">{{$room->name}}</a></li>
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
                <div class="row">
                    <h3>บ้าน {{ $room->name }} </h3>
                        {{-- เช็คว่าเป็น owner or admin -> มองเห็นปุ่มลบและแก้ไข  --}}
                    @if($room->owner_id == Auth::user()->id || Auth::user()->role == 'isAdmin')
                        <a href="{{ url('/room/' . $room->id . '/edit') }}" title="Edit Room">
                            <button class="btn-old btn-primary btn-sm main-shadow main-radius m-2">
                                <i class="fa-solid fa-pen-to-square"></i> แก้ไขบ้าน
                            </button>
                        </a>
                        <form method="POST" action="{{ url('room' . '/' . $room->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn-old btn-danger btn-sm main-shadow main-radius m-2" title="Delete Room" onclick="return confirm('ต้องการลบใช่ไหม')">
                                <i class="fa-solid fa-trash"></i> ลบบ้าน
                            </button>
                        </form>
                    @endif

                </div>
                <div class="h5">
                    <br />
                    <br />

                    <div class="col-12 col-md-12">
                        <div class="pricing-widget-layout2 mb-70 product-item">
                            {{-- แสดงเฉพาะคอม --}}
                            <ul class="d-none d-lg-block pricing__list list-unstyled mb-0">
                                <li>
                                    <span class="details__title" style="font-size: 25px;">รหัสค้นหาบ้าน</span>
                                    <p type="text" id="gen_id_computer"  class=" col-9" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" >{{ isset($room->gen_id) ? $room->gen_id : ''}}</p>&nbsp;&nbsp;
                                    <div class="input-group-append">
                                        <span class="input-group-append">
                                            <button class="btn-old btn-secondary btn-circle" onclick="Copy_Text_Computer()" type="submit"
                                            style="">
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <span class="details__title" style="font-size: 25px;">ชื่อบ้าน</span>
                                    <div class="details__content">
                                        <p class="mb-0" style="font-size: 25px;">{{ $room->name }}</p>
                                    </div>
                                </li>
                                <li>
                                    <span class="details__title" style="font-size: 25px;">เจ้าของบ้าน</span>
                                    <div class="details__content">
                                        <p class="mb-0" style="font-size: 25px;">{{ $room->user->name }}</p>
                                    </div>
                                </li>
                            </ul> {{--สิ้นสุด แสดงเฉพาะคอม --}}

                             {{-- แสดงเฉพาะมือถือ --}}
                            <ul class="d-block d-md-none pricing__list list-unstyled mb-0">
                                <li>
                                    <span class="details__title" style="font-size: 20px;">รหัสค้นหาบ้าน</span>
                                </li>
                                <li>
                                    <input type="text" id="gen_id_mobile"  class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ isset($room->gen_id) ? $room->gen_id : ''}}" readonly>&nbsp;&nbsp;
                                    <div class="input-group-append">
                                        <span class="input-group-append">
                                            <button class="btn-old btn-secondary btn-circle" onclick="Copy_Text_Mobile()" type="submit">
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <span class="details__title" style="font-size: 20px;">ชื่อบ้าน</span>
                                    <div class="details__content">
                                        <p class="mb-0" style="font-size: 20px;">{{ $room->name }}</p>
                                    </div>
                                </li>
                                <li>
                                    <span class="details__title" style="font-size: 20px;">เจ้าของบ้าน</span>
                                    <div class="details__content">
                                        <p class="mb-0" style="font-size: 20px;">{{ $room->user->name }}</p>
                                    </div>
                                </li>
                            </ul> {{-- สิ้นสุด แสดงเฉพาะมือถือ --}}
                        </div>
                    </div>

                    <div class="col-12 col-md-12 ">
                        <div class="pricing-widget-layout2 mb-70 product-item">
                            <h4>สมาชิกในบ้าน</h4>
                            @foreach ($member as $item)
                                <ul class="pricing__list list-unstyled mb-0">
                                    <li>
                                        <span>{{$loop->iteration}}</span>
                                        <span>{{$item->user->name}}</span>

                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <!-- <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>รหัสค้นหาบ้าน</th>
                                    <td>{{ $room->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                </tr>
                                <td> {{ $room->name }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                </div>
                <a class="btn-old btn-info btn-sm main-shadow main-radius" href="#" onclick="goBack()">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
                </a>
            </div>
        </div>
    </div>
</section><!-- กันสั่น -->
@endsection


<script>
    function Copy_Text_Computer() {
      // Get the text field
      var copyText = document.getElementById("gen_id_computer");

      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.innerText);

    //   Alert the copied text
      alert("Copied !!!" );
    }

    function Copy_Text_Mobile() {
      // Get the text field
      var copyText = document.getElementById("gen_id_mobile");

     // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.innerText);

    //   Alert the copied text
      alert("Copied !!!" );
    }
</script>
