<div class="row h5">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}} col-6">
        <label for="name" class="control-label">{{ 'ชื่อบ้าน' }}</label>
        <input required class="form-control" name="name" type="text" id="name" value="{{ isset($room->name) ? $room->name : ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}} col-6">
        <label for="pass" class="control-label">{{ 'รหัสบ้าน' }}</label>
        <input class="form-control" name="pass" type="password" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}">
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    <div class="form-group ">
        <label for="pass" class="control-label">{{ 'ภาพพื้นหลังบ้าน' }}</label>
        <input class="form-control" name="home_pic" type="file" id="home_pic" value="">
    </div>

    <div class="form-group d-none {{ $errors->has('pass') ? 'has-error' : ''}}">
        <label for="pass" class="control-label">{{ 'สมาชิก' }}</label>

        <input disabled class="form-control" name="pass" type="text" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}">
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div>

<center>
    <div class="form-group col-12 col-md-6 ">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">แก้ไข</button>
    </div>
</center>