<div class="row">

    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="type" class="control-label" style="font-size: 25px;">{{ 'ประเภท' }}</label>
        <select name="type" class="form-control type_edit" id="type" >
        <option selected disabled>กรุณาเลือกประเภท</option>
            @foreach (json_decode('{"นัดหมอ":"นัดหมอ","ทานยา":"ทานยา"}', true) as $optionKey => $optionvalue)
                <option value="{{ $optionKey }}" {{ (isset($appoint->type) && $appoint->type == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
        <input class="form-control title_edit" name="title" type="text" id="title" value="{{ isset($appoint->title) ? $appoint->title : ''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
    <!-- <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="type" class="control-label">{{ 'ประเภท' }}</label>
        <input class="form-control" name="type" type="text" id="type" value="{{ isset($appoint->type) ? $appoint->type : ''}}" >
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div> -->
    <div class="form-group {{ $errors->has('date_time') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="date_time" class="control-label">{{ 'วันที่/เวลา' }}</label>
        <input class="form-control date_time_edit" name="date_time" type="datetime-local" id="date_time" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" >
        {!! $errors->first('date_time', '<p class="help-block">:message</p>') !!}
    </div>
    <!-- <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="status" class="control-label">{{ 'สถานะ' }}</label>
        <input class="form-control" name="status" type="text" id="status" value="{{ isset($appoint->status) ? $appoint->status : ''}}" >
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div> -->
    <!-- <div class="form-group {{ $errors->has('sent_round') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="sent_round" class="control-label">{{ 'ส่งรอบที่' }}</label>
        <input class="form-control" name="sent_round" type="text" id="sent_round" value="{{ isset($appoint->sent_round) ? $appoint->sent_round : ''}}" >
        {!! $errors->first('sent_round', '<p class="help-block">:message</p>') !!}
    </div> -->
    <!-- <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="user_id" class="control-label">{{ 'รหัสผู้ใช้' }}</label>
        <input disabled class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($appoint->user_id) ? $appoint->user_id : ''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div> -->
</div>

<center>
    <div class="form-group col-12 col-md-6 ">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">แก้ไข</button>
    </div>
</center>
