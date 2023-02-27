@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Group_line {{ $group_line->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/group_line') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/group_line/' . $group_line->id . '/edit') }}" title="Edit Group_line"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('group_line' . '/' . $group_line->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Group_line" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $group_line->id }}</td>
                                    </tr>
                                    <tr><th> Group Id </th><td> {{ $group_line->group_id }} </td></tr><tr><th> Group Name </th><td> {{ $group_line->group_name }} </td></tr><tr><th> Picture Url </th><td> {{ $group_line->picture_url }} </td></tr><tr><th> Owner </th><td> {{ $group_line->owner }} </td></tr><tr><th> Partner Id </th><td> {{ $group_line->partner_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
