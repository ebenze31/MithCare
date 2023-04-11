
<div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}" style="display: block">
    <label for="full_name" class="control-label" style="font-size: 25px;">{{ 'ชื่อ-สกุล' }}</label><span class="text-danger">*</span>
    <input class="form-control" name="full_name" type="text" id="full_name" maxlength="20" placeholder="" value="{{ isset($user->full_name) ? $user->full_name : ''}}" required>{!! $errors->first('name', '<p class="help-block">:ชื่อนี้ไม่สามารถใช้ได้</p>') !!}
</div> <!--///  ชื่อเล่น /// -->

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}" style="display: block">
    <label for="name" class="control-label" style="font-size: 25px;">{{ 'ชื่อเล่น' }}</label><span class="text-danger">*</span>
    <input class="form-control" name="name" type="text" id="name" maxlength="20" placeholder="กรุณาใส่ชื่อเล่น" value="{{ isset($user->name) ? $user->name : ''}}" required>{!! $errors->first('name', '<p class="help-block">:ชื่อนี้ไม่สามารถใช้ได้</p>') !!}
</div> <!--///  ชื่อเล่น /// -->

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" style="display: block">
    <label for="email" class="control-label" style="font-size: 25px;">{{ 'อีเมล' }}</label><span class="text-danger">*</span>
    <input class="form-control" name="email" type="text" id="email" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->email) ? $user->email : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!}
</div> <!--///  อีเมล /// -->

<div class="row">
    <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}} col-12 col-md-6">
        <label for="gender" class="control-label" style="font-size: 25px;">{{ 'เพศ' }}</label><span class="text-danger">*</span>
        <select name="gender" class="form-control" id="gender" required>
            <option selected disabled>กรุณาเลือกเพศ</option>
            @foreach (json_decode('{"ชาย":"ชาย","หญิง":"หญิง"}', true) as $optionKey => $optionvalue)
            <option value="{{ $optionKey }}" {{ (isset($user->gender) && $user->gender == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach
        </select>
    </div> <!--///  เพศ /// -->

    <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}} col-12 col-md-6">
        <label for="birthday" class="control-label" style="font-size: 25px;">{{ 'วันเกิด' }}</label><span class="text-danger">*</span>
        <input class="form-control input" name="birthday" type="date" id="birthday" value="{{ isset($user->birthday) ? $user->birthday : ''}}" required>
    </div> <!--///  วันเกิด /// -->
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}" style="display: block">
    <label for="phone" class="control-label" style="font-size: 25px;">{{ 'เบอร์โทร' }}</label><span class="text-danger">*</span>
    <input class="form-control" name="phone" type="text" id="phone" placeholder="กรุณาใส่เบอร์โทร" value="{{ isset($user->phone) ? $user->phone : ''}}" required>{!! $errors->first('name', '<p class="help-block">:รูปแบบเบอร์มือถือไม่ถูกต้อง</p>') !!}
</div> <!--///  เบอร์โทร /// -->


<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}" style="display: block">
    <label for="address" class="control-label" style="font-size: 25px;">{{ 'ที่อยู่' }}</label>



    <div class="row ">

        <div class="form-group col-12 col-md-4">
            <select id="input_province" name="province" onChange="showAmphoes();" value="{{ isset($user->province) ? $user->province : ''}}" class="form-control" required>

                @if(!empty($user->province))
                <option value="{{$user->province}}" selected disabled>{{$user->province}}</option>
                @else
                <option value="">กรุณาเลือกจังหวัด</option>
                @endif
                @foreach($provinces as $item)
                <option value="{{ $item->province }}">{{ $item->province }}</option>
                @endforeach
            </select>
        </div> <!--///  จังหวัด /// -->

        <div class="form-group col-12 col-md-4">
            <select id="input_amphoe" name="district" onChange="showTambons();" class="form-control" required>
                @if(!empty($user->district))
                <option value="{{$user->district}}" selected disabled>{{$user->district}}</option>
                @else
                <option value="">กรุณาเลือกเขต/อำเภอ</option>
                @endif
            </select>
        </div> <!--///  อำเภอ /// -->

        <div class="form-group col-12 col-md-4">
            <select id="input_tambon" name="sub_district" value="{{ isset($user->sub_district) ? $user->sub_district : ''}}" class="form-control" required>

                @if(!empty($user->sub_district))
                <option value="{{$user->sub_district}}" selected disabled>{{$user->sub_district}}</option>
                @else
                <option value="">กรุณาเลือกแขวง/ตำบล</option>
                @endif
            </select>
        </div> <!--///  ตำบล /// -->

        <div class="form-group col-12 col-md-12">
            <textarea class="form-control " name="address" id="" cols="30" rows="2" placeholder="ใส่รายละเอียดที่อยู่" required>
@if(!empty($user->address))
{{$user->address}}
@else
รายละเอียดที่อยู่
@endif
            </textarea>

        </div> <!--///  ที่อยู่ /// -->

        <!--  <div class="form-group col-12 col-md-12">
            <input class="form-control" id="input_zipcode" placeholder="รหัสไปรษณีย์" />
        </div> ///  ไปรษณีย์ /// -->
    </div>


</div>


<div class="form-group">
    <button style="background-color: #3490dc; font-size: 25px; color: white;" class="btn btn-primary form-control" type="submit">บันทึก</button>
</div>





<script>

    var count_select_a = 1;
    var count_select_t = 1;
    document.addEventListener('DOMContentLoaded', (event) => {
        // console.log("START");
        let old_province = document.querySelector("#input_province");
        // console.log(old_province.value);

        if (old_province.value) {
            showAmphoes();
        }
    });


    function showAmphoes() {
        let input_province = document.querySelector("#input_province");
        let url = "{{ url('/api/amphoes') }}?province=" + input_province.value;
        // console.log(url);

        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let input_amphoe = document.querySelector("#input_amphoe");
                let old_amphoe = input_amphoe.value;
                input_amphoe.innerHTML = "";

                if (old_amphoe && count_select_a === 1) {

                    let option_start = document.createElement("option");
                    option_start.value = old_amphoe;
                    option_start.text = old_amphoe;
                    option_start.selected = true;
                    option_start.disabled = true;
                    input_amphoe.appendChild(option_start);
                } else {

                    let option_start = document.createElement("option");
                    option_start.text = "กรุณาเลือกอำเภอ";
                    option_start.selected = true;
                    input_amphoe.appendChild(option_start);
                }

                for (let item of result) {
                    // console.log(item.amphoe);
                    let option = document.createElement("option");
                    option.text = item.amphoe;
                    option.value = item.amphoe;
                    input_amphoe.appendChild(option);
                }
                //QUERY AMPHOES
                count_select_a = count_select_a + 1;
                showTambons();
            });
    }

    function showTambons() {
        let input_province = document.querySelector("#input_province");
        let input_amphoe = document.querySelector("#input_amphoe");
        let url = "{{ url('/api/tambons') }}?province=" + input_province.value + "&amphoe=" + input_amphoe.value;
        // console.log(url);
        // if(input_province.value == "") return;
        // if(input_amphoe.value == "") return;
        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let input_tambon = document.querySelector("#input_tambon");
                let old_tambon = input_tambon.value;
                input_tambon.innerHTML = "";

                if (old_tambon && count_select_t === 1) {
                    let option_start = document.createElement("option");
                    option_start.value = old_tambon;
                    option_start.text = old_tambon;
                    option_start.selected = true;
                    option_start.disabled = true;
                    input_tambon.appendChild(option_start);
                } else {

                    let option_start = document.createElement("option");
                    option_start.text = "กรุณาเลือกตำบล";
                    option_start.selected = true;
                    input_tambon.appendChild(option_start);
                }

                for (let item of result) {
                    // console.log(item.tambon);
                    let option = document.createElement("option");
                    option.text = item.tambon;
                    option.value = item.tambon;
                    input_tambon.appendChild(option);
                }
                //QUERY AMPHOES
                count_select_t = count_select_t + 1;
            });
    }
</script>

{{--
<script>
    // รูปแบบวันที่ที่ต้องการแสดงผล เช่น "dd/mm/yyyy"
    const dateFormat = "dd/mm/yyyy";

    // ฟังก์ชันเพื่อเปลี่ยนแปลงรูปแบบวันที่
    function formatDate(date) {
        // หากไม่ได้รับวันที่เข้ามาให้ใช้วันปัจจุบัน
        // if (!date) {
        //     date = new Date();
        // }

        // แยกวัน เดือน ปี ออกจากวันที่
        const day = date.getDate().toString().padStart(2, "0");
        const month = (date.getMonth() + 1).toString().padStart(2, "0");
        const year = date.getFullYear();

        // คืนค่าวันที่ในรูปแบบที่ต้องการ
        return dateFormat.replace("dd", day).replace("mm", month).replace("yyyy", year);
    }

    // เมื่อ input มีการเปลี่ยนแปลงค่าให้เปลี่ยนรูปแบบวันที่และแสดงผลใหม่
    document.getElementById("birthday").addEventListener("change", function () {
        const date = new Date(this.value);
        this.value = formatDate(date);
    });

    // ให้แสดงผลวันเกิดในรูปแบบที่ต้องการเมื่อโหลดหน้าเว็บ
    const date = new Date(document.getElementById("birthday").value);
    document.getElementById("birthday").value = formatDate(date);
</script> --}}
