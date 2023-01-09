<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input required class="form-control" name="name" type="text" id="name" value="{{ isset($room->name) ? $room->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}}">
    <label for="pass" class="control-label">{{ 'Pass' }}</label>
    <input class="form-control" name="pass" type="text" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}" >
    {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit"
     value="{{ $formMode === 'edit' ? 'แก้ไข' : 'สร้าง' }}">สร้าง</button>
</div>
