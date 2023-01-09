@extends('layouts.mithcare')

@section('content')
    <div class="container">
        <div class="row">
                <!--//////// Sidebar ////////-->
            <div class="contact-panel col-md-3 mb-2">
                <div class="contact-panel__form">
                    <div class="contact-panel__title h4" style="color: black;">
                        เมนู
                    </div>

                    <div class="ontact-panel__desc">
                        <ul class="nav" role="tablist">
                            <li role="presentation">
                                <a href="{{ url('/room') }}" class="h5 " >
                                    บ้านของฉัน
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--////// End Sidebar /////////-->

            <div class="contact-panel col-md-9 mb-2">
             
                    <h2 >สร้างบ้านใหม่</h2>
                    <div class="container">
                        <a href="{{ url('/room') }}" ><button class="btn btn-warning btn-sm main-shadow main-radius" style="font-size: 20px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('room.form', ['formMode' => 'create'])

                        </form>

                    </div>
            
            </div>
        </div>
    </div>
@endsection
