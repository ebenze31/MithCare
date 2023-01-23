@extends('layouts.mithcare')

@section('content')

    <section class="page-title page-title-layout5">
        <div class="bg-img"><img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <nav>
                        <!-- แสดงเฉพาะคอม -->
                        <div class="d-none d-lg-block">
                            <ol class=" breadcrumb mb-0 ">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 30px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 30px;">บ้าน</a></li>
                            </ol>
                        </div> <!--d-none d-lg-block -->
                        <!-- แสดงเฉพาะมือถือ -->
                        <div class="d-block d-md-none">
                            <ol class=" breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="font-size: 20px;">หน้าแรก</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/room') }}" style="font-size: 20px;">บ้าน</a></li>
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header h4 font-weight-bold bg-transparent">รายละเอียดเอกสาร {{ $health_check->title }}</div>
                    <div class="card-body h5">

                        <div class="col-6 ">
                            <a href="{{ url('/health_check') }}" title="Back">
                                <span class="btn-old btn-info btn-sm main-shadow main-radius">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
                                </span>
                            </a>
                        </div>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ไอดี</th><td>{{ $health_check->id }}</td>
                                    </tr>
                                    <tr><th> เรื่อง </th><td> {{ $health_check->title }} </td></tr>
                                    {{-- <tr><th> รูปเอกสาร 1</th><td> {{ $health_check->img_1 }} </td></tr>
                                    <tr><th> รูปเอกสาร 2</th><td> {{ $health_check->img_2 }} </td></tr>
                                    <tr><th> รูปเอกสาร 3</th><td> {{ $health_check->img_3 }} </td></tr> --}}

                                </tbody>
                            </table>
                        </div>


                            <div class="row justify-content-around">

                                <div class="widget widget-help bg-overlay bg-overlay-primary-gradient main-radius main-shadow">
                                        <!-- /.zoom_picture-only-pc -->
                                    <div class="product__img d-none d-lg-block">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 1</h2>
                                        <img src="{{ url('storage/'.$health_check->img_1 )}}" width="250px" height="250px" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->
                                        <!-- /.-only-mobile -->
                                    <div class="d-block d-md-none">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 1</h2>
                                        <img src="{{ url('storage/'.$health_check->img_1 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->
                                </div><!-- /.widget-help -->

                                <div class="widget widget-help bg-overlay bg-overlay-primary-gradient main-radius main-shadow">
                                    <!-- /.zoom_picture-only-pc -->
                                    <div class="product__img d-none d-lg-block">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 2</h2>
                                        <img src="{{ url('storage/'.$health_check->img_2 )}}" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->

                                    <!-- /.-only-mobile -->
                                    <div class="d-block d-md-none">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 2</h2>
                                        <img src="{{ url('storage/'.$health_check->img_2 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->
                                </div><!-- /.widget-help -->

                                <div class="widget widget-help bg-overlay bg-overlay-primary-gradient main-radius main-shadow">
                                    <!-- /.zoom_picture-only-pc -->
                                    <div class="product__img d-none d-lg-block">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 3</h2>
                                        <img src="{{ url('storage/'.$health_check->img_3 )}}" alt="background" class="zoomin" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->

                                    <!-- /.-only-mobile -->
                                    <div class="d-block d-md-none">
                                        <h2 class="text-secondary" style="font-size: 30px;">บัตร 3</h2>
                                        <img src="{{ url('storage/'.$health_check->img_3 )}}" alt="background" class="main-radius" loading="lazy" style="visibility: visible;">
                                    </div><!-- /.product__img -->
                                </div><!-- /.widget-help -->

                            </div> <!-- /.row -->

                            <div class="row justify-content-around">
                                <a href="{{ url('/health_check/' . $health_check->id . '/edit') }}" title="Edit Health_check">
                                    <button class="btn-old btn-primary btn-sm main-radius main-shadow">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                                    </button>
                                </a>

                                <form method="POST" action="{{ url('health_check' . '/' . $health_check->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn-old btn-danger btn-sm main-radius main-shadow" title="Delete Health_check"
                                    onclick="return confirm('ต้องการลบใช่หรือไม่')"><i class="fa fa-trash-o" aria-hidden="true"></i> ลบ</button>
                                </form>
                            </div>
                    </div><!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-12 -->






            {{-- <div class="col-sm-12 col-md-12 col-lg-4">

                  <div class="widget widget-member">
                    <div class="member mb-0">
                      <div class="member__img">
                        <img src="{{asset('/img/logo_mithcare/portrait-volunteer-who-organized-donations-charity.jpg')}}" alt="member img" height="300px" width="100%">
                      </div><!-- /.member-img -->
                      <div class="member__info">
                        <h2 class="member__name text-center"><a href="#" style="font-size: 30px;">{{$health_check->name}}</a></h2>
                        <button class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10 main-shadow ">
                          <a style="font-size: 20px; color:#ffffff;" href="{{ url('/profile/'. $health_check->id . '/edit') }}">แก้ไขโปรไฟล์</a>
                        </button>

                      </div><!-- /.member-info -->
                    </div><!-- /.member -->
                  </div><!-- /.widget-member -->




              </div><!-- /.col-lg-4 --> --}}

         </div>{{-- row --}}
     </div>{{--container --}}
</section><!-- /.page-title -->
@endsection
