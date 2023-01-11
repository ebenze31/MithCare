
<!-- <div  class="form-group {{ $errors->has('category_type') ? 'has-error' : ''}}">
        <label for="category_type" class="control-label" style="font-size: 25px;">{{ 'ประเภท' }}</label>
        <select name="category_type" class="details__content" id="category_type" required>
        <option selected disabled>กรุณาเลือกประเภท</option>
        @foreach (json_decode('{"รายรับ":"รายรับ","รายจ่าย":"รายจ่าย"}', true) as $optionKey => $optionvalue)
            <option value="{{ $optionKey }}" {{ (isset($email->category_type) && $transaction->category_type == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
        @endforeach
    </select>
        {!! $errors->first('category_type', '<p class="help-block">:message</p>') !!}
    </div> -->

<div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}" style="display: block">
    <label for="full_name" class="control-label" style="font-size: 25px;">{{ 'ชื่อ-สกุล' }}</label>
    <input class="form-control" name="full_name" type="text" id="full_name" maxlength="20" placeholder="" value="{{ isset($user->full_name) ? $user->full_name : ''}}">{!! $errors->first('name', '<p class="help-block">:ชื่อนี้ไม่สามารถใช้ได้</p>') !!}
</div> <!--///  ชื่อเล่น /// -->

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}" style="display: block">
    <label for="name" class="control-label" style="font-size: 25px;">{{ 'ชื่อเล่น' }}</label>
    <input class="form-control" name="name" type="text" id="name" maxlength="20" placeholder="กรุณาใส่ชื่อเล่น" value="{{ isset($user->name) ? $user->name : ''}}">{!! $errors->first('name', '<p class="help-block">:ชื่อนี้ไม่สามารถใช้ได้</p>') !!}
</div> <!--///  ชื่อเล่น /// -->

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" style="display: block">
    <label for="email" class="control-label" style="font-size: 25px;">{{ 'อีเมล' }}</label>
    <input class="form-control" name="email" type="text" id="email" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->email) ? $user->email : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!}
</div> <!--///  อีเมล /// -->

<div class="row">
    <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}} col-12 col-md-6">
        <label for="gender" class="control-label" style="font-size: 25px;">{{ 'เพศ' }}</label>
        <!-- <input class="form-control" name="gender" type="text" id="gender" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->gender) ? $user->gender : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} -->
        <select name="gender" class="form-control" id="gender" required>
            <option selected disabled>กรุณาเลือกเพศ</option>
            @foreach (json_decode('{"ชาย":"ชาย","หญิง":"หญิง"}', true) as $optionKey => $optionvalue)
            <option value="{{ $optionKey }}" {{ (isset($user->gender) && $user->gender == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach
        </select>
    </div> <!--///  เพศ /// -->

    <div class="form-group {{ $errors->has('birthday') ? 'has-error' : ''}} col-12 col-md-6">
        <label for="birthday" class="control-label" style="font-size: 25px;">{{ 'วันเกิด' }}</label>
        <input class="form-control input" name="birthday" type="date" id="birthday" value="{{ isset($user->birthday) ? $user->birthday : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!}

    </div> <!--///  วันเกิด /// -->
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}" style="display: block">
    <label for="phone" class="control-label" style="font-size: 25px;">{{ 'เบอร์โทร' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" placeholder="กรุณาใส่เบอร์โทร" value="{{ isset($user->phone) ? $user->phone : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบเบอร์มือถือไม่ถูกต้อง</p>') !!}
</div> <!--///  เบอร์โทร /// -->


<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}" style="display: block">
    <label for="address" class="control-label" style="font-size: 25px;">{{ 'ที่อยู่' }}</label>



    <div class="row ">


        <div class="form-group col-12 col-md-4">
            <select id="input_province" name="province" onChange="showAmphoes();" value="{{ isset($user->province) ? $user->province : ''}}" class="form-control">

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
            <select id="input_amphoe" name="district" onChange="showTambons();" class="form-control">
                @if(!empty($user->district))
                <option value="{{$user->district}}" selected disabled>{{$user->district}}</option>
                @else
                <option value="">กรุณาเลือกเขต/อำเภอ</option>
                @endif
            </select>
        </div> <!--///  อำเภอ /// -->

        <div class="form-group col-12 col-md-4">
            <select id="input_tambon" name="sub_district" value="{{ isset($user->sub_district) ? $user->sub_district : ''}}" class="form-control">

                @if(!empty($user->sub_district))
                <option value="{{$user->sub_district}}" selected disabled>{{$user->sub_district}}</option>
                @else
                <option value="">กรุณาเลือกแขวง/ตำบล</option>
                @endif
            </select>
        </div> <!--///  ตำบล /// -->

        <div class="form-group col-12 col-md-12">
            <textarea class="form-control " name="address" id="" cols="30" rows="2" placeholder="ใส่รายละเอียดที่อยู่">
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
    <button style="background-color: #3490dc; font-size: 25px; color: white;" class="btn btn-primary form-control" type="submit">ยืนยันการแก้ไข</button>
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