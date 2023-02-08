
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}} col-12">
        <label for="name" class="control-label">{{ 'ชื่อบ้าน' }}</label>
        <input required class="form-control" name="name" type="text" id="name" value="{{ isset($room->name) ? $room->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group col-12">
        <div class="input-group mb-3">
            <input type="text" class="form-control pw" id="pass" name="pass" placeholder="รหัสห้อง" autocomplete="new-pass" required>
            <div class="input-group-append" >
                <span class="input-group-text" id="basic-addon2" style="border-top-right-radius: 50px 50px; border-bottom-right-radius: 50px 50px;"
                onclick="document.querySelector('#toggleEye_2').classList.toggle('d-none');
                document.querySelector('#toggleEyeOpen_2').classList.toggle('d-none');
                document.querySelector('#pass').classList.toggle('pw');">
                    <i class="fa-sharp fa-solid fa-eye-slash" id="toggleEye_2" ></i>
                    <i class="fa-sharp fa-solid fa-eye d-none" id="toggleEyeOpen_2"></i>
                </span>
            </div>
        </div>
    </div>

<center>
    <div class="form-group col-12 col-md-6 ">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">บันทึก</button>
    </div>
</center>
