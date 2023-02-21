@extends('layouts.mithcare')

@section('content')

<section class="page-title page-title-layout5 p-3 ">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-12 ">
                <div class="card product-item">
                    <div class="card-header" style="font-size: 25px">ขอความช่วยเหลือ</div>


                    {{-- justify-content end --}}

                    <form method="POST" action="{{ url('/ask_for_help') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="card-body">
                            <br />
                            <br />

                        @include ('ask_for_help.form', ['formMode' => 'create'])

                    </form>



                    </div>
                    {{-- card-body end --}}
                </div>
            </div>
        </div>
    </div>
</section><!-- /.page-title -->




@endsection


