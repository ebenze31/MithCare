@extends('layouts.admin.main')

@section('content')
<div class="row">
    {{-- @include('admin.sidebar') --}}
    <div class="col-md-10">

        <div class="card mr-5">
            <div class="card-header">หน้าขอความช่วยเหลือ</div>
                <div class="card-body">
                    <section class="page-title page-title-layout5 p-3">

                            <a href="{{ url('/ask_for_help/create') }}" class="btn btn-success btn__rounded btn-sm main-radius main-shadow"  title="Add New Ask_for_help">
                                <i class="fa fa-plus" aria-hidden="true"></i>เพิ่มคำร้องขอความช่วยเหลือ
                            </a>

                            <form method="GET" action="{{ url('/room') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right d-block " role="search">
                                <input type="text" class="form-control" placeholder="Search...">
                                <!-- <button class="btn" type="submit"><i class="icon-search"></i></button> -->
                            </form>

                                <br />
                                <br />

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ชื่อผู้ใช้</th>
                                                <th>เนื้อหา</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ask_for_help as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name_user }}</td>
                                                    <td>{{ $item->content }}</td>

                                                    <td>
                                                        <a href="{{ url('/ask_for_help/' . $item->id) }}"
                                                            title="View Ask_for_help">
                                                            <button class="btn-old btn-info btn-sm">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> รายละเอียด
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('/ask_for_help/' . $item->id . '/edit') }}" title="Edit Ask_for_help">
                                                            <button class="btn-old btn-primary btn-sm">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> แก้ไข
                                                            </button>
                                                        </a>


                                                        <form method="POST"
                                                            action="{{ url('/ask_for_help' . '/' . $item->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn-old btn-danger btn-sm" title="Delete Ask_for_help" onclick="return confirm('ต้องการลบใช่หรือไม่')">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i> ลบ
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination-wrapper"> {!! $ask_for_help->appends(['search' => Request::get('search')])->render() !!} </div>
                                </div>


                    </section>
                </div>
                 {{-- ^^cardbody end^^ --}}
        </div>

    </div>
</div>
@endsection
