@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Partner {{ $partner->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/partner') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/partner/' . $partner->id . '/edit') }}" title="Edit Partner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('partner' . '/' . $partner->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Partner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $partner->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $partner->name }} </td></tr><tr><th> Full Name </th><td> {{ $partner->full_name }} </td></tr><tr><th> Type </th><td> {{ $partner->type }} </td></tr><tr><th> Phone </th><td> {{ $partner->phone }} </td></tr><tr><th> Mail </th><td> {{ $partner->mail }} </td></tr><tr><th> Name Line Group </th><td> {{ $partner->name_line_group }} </td></tr><tr><th> Show Homepage </th><td> {{ $partner->show_homepage }} </td></tr><tr><th> Line Group Id </th><td> {{ $partner->line_group_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
