@extends('layouts.mithcare')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12 col-12 ">
                <div class="card product-item">
                    <div class="card-header" style="font-size: 25px">ขอความช่วยเหลือ</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <img src="{{asset('/img/พื้นหลัง/พื้นหลัง-05.png')}}" width="90%" alt="background">
                            </div>
                         </div>
                    </div>
                    {{-- justify-content end --}}
                    <div class="justify-content-center">
                        <div class="column">
                            <div class="col-12 mb-2">
                                <button class="btn btn-primary main-shadow main-radius " style="background-color: #3490dc; font-size: 30px; color: white;">
                                    <i class="fa-solid fa-truck-medical"></i> ขอความช่วยเหลือ
                                </button>
                            </div>
                            <div class="col-12 mb-2">
                                <button class="btn btn-primary main-shadow main-radius " style="background-color: #21CDC0; font-size: 20px; color: white;">
                                    <i class="fa-solid fa-phone"></i> โทรฉุกเฉิน
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-6 col-md-3 mb-2">
                        <a href="{{ url('/ask_for_help') }}" title="กลับ">
                            <button class="btn btn-warning btn-sm form-control" style="background-color: #21CDC0; font-size: 25px; color: white;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ
                            </button>
                        </a>
                    </div> --}}

                    <div class="card-body">
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/ask_for_help') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('ask_for_help.form', ['formMode' => 'create'])

                        </form>



                    </div>
                    {{-- card-body end --}}
                </div>
            </div>
        </div>
    </div>
@endsection
