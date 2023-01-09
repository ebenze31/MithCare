<div class="row">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}} col-6">
        <label for="name" class="control-label">{{ 'ไอดีห้อง' }}</label>
        <input required class="form-control" name="name" type="text" id="name" value="{{ isset($room->name) ? $room->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}} col-6">
        <label for="pass" class="control-label">{{ 'รหัสห้อง' }}</label>
        <input class="form-control" name="pass" type="text" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}" >
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div>
 </div><!-- /row -->

 <div class="form-group">
    <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit" value="">   
        เข้าร่วมบ้าน
    </button>
</div>