
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}} col-12">
        <label for="name" class="control-label">{{ 'ชื่อบ้าน' }}</label>
        <input required class="form-control" name="name" type="text" id="name" value="{{ isset($room->name) ? $room->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    {{-- <div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}} col-12">
        <label for="pass" class="control-label">{{ 'รหัสบ้าน' }}</label>
        <input class="form-control pw" name="pass" type="text" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}" >
        <i class="fa-solid fa-eye" onclick="data"></i> <i class="fa-sharp fa-solid fa-eye-slash d-none"></i>
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div> --}}

        <div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}} col-12">
            <label for="pass" class="control-label">{{ 'รหัสบ้าน' }}</label>
                <input class=" form-control pw " type="text" name="password" autocomplete="current-password" required="" id="password" value="{{ isset($room->pass) ? $room->pass : ''}}">
                <span class=" position-absolute"><i class="fa-sharp fa-solid fa-eye-slash" id="toggleEye" ></i></span>
            {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
        </div>


    {{-- <div class="form-group d-none {{ $errors->has('pass') ? 'has-error' : ''}}">
        <label for="pass" class="control-label">{{ 'สมาชิก' }}</label>

        <input disabled class="form-control" name="pass" type="text" id="pass" value="{{ isset($room->pass) ? $room->pass : ''}}" >
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div> --}}

<center>
    <div class="form-group col-12 col-md-6 ">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">สร้าง</button>
    </div>
</center>
