@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5 p-3 ">
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="card product-item border border-info ">
                    <div class="card-header text-light" style="font-weight:bold;font-size : 25px; background-color: #3490dc;">ขอความช่วยเหลือ</div>

                    <form method="POST" action="{{ url('/ask_for_help') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('ask_for_help.form', ['formMode' => 'create'])
                    </form>

                </div>
            </div>
        </div>
    </div>
</section><!-- /.page-title -->




@endsection


