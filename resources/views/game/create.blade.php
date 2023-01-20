@extends('layouts.mithcare')

@section('content')
<section>
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold h4">สร้างเกมใหม่</div>
                    <div class="card-body h5">
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/game') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('game.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
