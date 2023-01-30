@extends('layouts.admin.main')

@section('content')
<section class="page-title page-title-layout5 p-3 d-none d-lg-block">
    <div class="container-fluid">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ask_for_help {{ $ask_for_help->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/ask_for_help') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/ask_for_help/' . $ask_for_help->id . '/edit') }}" title="Edit Ask_for_help"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('ask_for_help' . '/' . $ask_for_help->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Ask_for_help" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $ask_for_help->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> ชื่อผู้ใช้ </th>
                                        <td> {{ $ask_for_help->name_user }}</td>
                                    </tr>
                                    <tr>
                                        <th> เนื้อหา </th>
                                        <td> {{ $ask_for_help->content }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End page-title -->
@endsection
