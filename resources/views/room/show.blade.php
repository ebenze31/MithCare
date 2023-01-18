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

                    <div class="collg-12 col-md-9">
                        <div class="pricing-widget-layout2 mb-70 product-item">
                            <ul class="pricing__list list-unstyled mb-0">
                                <li><span>รหัสค้นหาบ้าน</span><span class="price">#sdfgfhad4155ET51858#848FDFSdfgd</span></li>
                                <li><span>ชื่อบ้าน</span><span class="price">{{ $room->name }}</span></li>
                                <li><span>เจ้าของบ้าน</span><span class="price">{{ $room->user->name }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="collg-12 col-md-9 ">
                        <div class="pricing-widget-layout2 mb-70 product-item">
                            <h4>สมาชิกในบ้าน</h4>
                            <ul class="pricing__list list-unstyled mb-0">
                                <li><span>1</span><span class="price">คุณ ..........</span></li>
                                <li><span>2</span><span class="price">คุณ ..........</span></li>
                                <li><span>3</span><span class="price">คุณ ..........</span></li>
                            </ul>
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
