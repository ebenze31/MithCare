@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Appoint {{ $appoint->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/appoint') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/appoint'.'/' . $appoint->id . '/edit') }}" title="Edit Appoint"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('appoint' . '/' . $appoint->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Appoint" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $appoint->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $appoint->title }} </td></tr><tr><th> Type </th><td> {{ $appoint->type }} </td></tr><tr><th> Date Time </th><td> {{ $appoint->date_time }} </td></tr><tr><th> Status </th><td> {{ $appoint->status }} </td></tr><tr><th> Sent Round </th><td> {{ $appoint->sent_round }} </td></tr><tr><th> User Id </th><td> {{ $appoint->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
