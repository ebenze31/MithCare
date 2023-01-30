@extends('layouts.admin.main')

@section('content')
<section class="page-title page-title-layout5 p-3 d-none d-lg-block">
    <div class="container-fluid">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Ask_for_help #{{ $ask_for_help->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/ask_for_help') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/ask_for_help/' . $ask_for_help->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('ask_for_help.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End page-title -->
@endsection
