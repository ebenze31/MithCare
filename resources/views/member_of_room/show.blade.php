@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Member_of_room {{ $member_of_room->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/member_of_room') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/member_of_room/' . $member_of_room->id . '/edit') }}" title="Edit Member_of_room"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('member_of_room' . '/' . $member_of_room->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Member_of_room" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $member_of_room->id }}</td>
                                    </tr>
                                    <tr><th> Status </th><td> {{ $member_of_room->status }} </td></tr><tr><th> Lv Of Caretaker </th><td> {{ $member_of_room->lv_of_caretaker }} </td></tr><tr><th> User Id </th><td> {{ $member_of_room->user_id }} </td></tr><tr><th> Room Id </th><td> {{ $member_of_room->room_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
