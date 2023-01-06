<style>
.form-control input {
    border: none;
    box-sizing: border-box;
    outline: 0;
    padding: .75rem;
    position: relative;
    width: 100%;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
</style>

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

    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}" style="display: block">
        <label for="name" class="control-label" style="font-size: 25px;">{{ 'ชื่อเล่น' }}</label> 
            <input class="form-control" name="name" type="text" id="name" maxlength="20" placeholder="กรุณาใส่ชื่อเล่น" value="{{ isset($user->name) ? $user->name : ''}}">{!! $errors->first('name', '<p class="help-block">:ชื่อนี้ไม่สามารถใช้ได้</p>') !!} 
    </div>  <!--///  ชื่อเล่น /// -->
      
    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}" style="display: block">
        <label for="email" class="control-label" style="font-size: 25px;">{{ 'อีเมล' }}</label>
            <input class="form-control" name="email" type="text" id="email" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->email) ? $user->email : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} 
    </div>  <!--///  อีเมล /// -->

    <div class="row">     
        <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}} col-12 col-md-6" >
            <label for="gender" class="control-label" style="font-size: 25px;">{{ 'เพศ' }}</label>
                <input class="form-control" name="gender" type="text" id="gender" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->gender) ? $user->gender : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} 
        </div>  <!--///  เพศ /// --> 
        
        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}} col-12 col-md-6" >
            <label for="date" class="control-label" style="font-size: 25px;">{{ 'วันเกิด' }}</label>
                <input class="form-control input" name="date" type="date" id="date" value="{{ isset($user->date) ? $user->date : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} 
            
        </div>  <!--///  วันเกิด /// -->
    </div>

    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}" style="display: block">
        <label for="phone" class="control-label" style="font-size: 25px;">{{ 'เบอร์โทร' }}</label>
            <input class="form-control" name="phone" type="text" id="phone" placeholder="กรุณาใส่เบอร์โทร" value="{{ isset($user->phone) ? $user->phone : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบเบอร์มือถือไม่ถูกต้อง</p>') !!} 
    </div>  <!--///  เบอร์โทร /// -->

    
    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}" style="display: block">
        <label for="address" class="control-label" style="font-size: 25px;">{{ 'ที่อยู่' }}</label>

        <div class="row ">  
            <div class="form-group {{ $errors->has('province') ? 'has-error' : ''}} col-12 col-md-4" >
                    <input class="form-control" name="province" type="text" id="province" placeholder="กรุณาใส่จังหวัด" value="{{ isset($user->province) ? $user->province : ''}}">{!! $errors->first('province', '<p class="help-block">:รูปแบบไม่ถูกต้อง</p>') !!} 
            </div>  <!--///  จังหวัด /// -->

            <div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}col-12 col-md-4" >
                    <input class="form-control" name="district" type="text" id="district" placeholder="กรุณาใส่อำเภอ" value="{{ isset($user->district) ? $user->district : ''}}">{!! $errors->first('district', '<p class="help-block">:รูปแบบไม่ถูกต้อง</p>') !!} 
            </div>  <!--///  อำเภอ /// -->

            <div class="form-group {{ $errors->has('sub_district') ? 'has-error' : ''}}col-12 col-md-4" >
                    <input class="form-control" name="sub_district" type="text" id="sub_district" placeholder="กรุณาใส่ตำบล" value="{{ isset($user->sub_district) ? $user->sub_district : ''}}">{!! $errors->first('sub_district', '<p class="help-block">:รูปแบบไม่ถูกต้อง</p>') !!} 
            </div>  <!--///  ตำบล /// -->
        </div>

        <textarea class="form-control" name="" id="" cols="30" rows="2" placeholder="ใส่รายละเอียดที่อยู่"></textarea>
    </div>  <!--///  ที่อยู่ /// -->

    <div>
    <select id="input_province" onChange="showAmphoes();" class="form-control">
        <option value="">กรุณาเลือกจังหวัด</option>
        @foreach($provinces as $item)
        <option value="{{ $item->province }}">{{ $item->province }}</option>
        @endforeach
    </select>
</div>
<div>
    <select id="input_amphoe">
        <option value="">กรุณาเลือกเขต/อำเภอ</option>
        @foreach($amphoes as $item)
        <option value="{{ $item->amphoe }}">{{ $item->amphoe }}</option>
        @endforeach
    </select>
</div>
<div>
    <select id="input_tambon">
        <option value="">กรุณาเลือกแขวง/ตำบล</option>
        @foreach($tambons as $item)
        <option value="{{ $item->tambon }}">{{ $item->tambon }}</option>
        @endforeach
    </select>
</div>
<div>
    <input id="input_zipcode" placeholder="รหัสไปรษณีย์" />
</div>


    <div class="form-group">
        <button style="background-color: #3490dc; font-size: 25px; color: white;" class="btn btn-primary form-control" type="submit">ยืนยันการแก้ไข</button>    
    </div>

 

   


    
<script>   

document.addEventListener('DOMContentLoaded', (event) => {
    // console.log("START");
    showProvinces();    
});


    function showAmphoes() {
        let input_province = document.querySelector("#input_province");
        let url = "{{ url('/api/show_amphoes') }}" + "/" + input_province.value;
        console.log(input_province.value);
        // if(input_province.value == "") return;
        fetch("{{ url('/') }}api/show_amphoes/" + input_province.value)
            .then(response => response.text())
            .then(result => {
                console.log(result);
                //UPDATE SELECT OPTION
                // let input_amphoe = document.querySelector("#input_amphoe");
                // input_amphoe.innerHTML = '<option value="">กรุณาเลือกเขต/อำเภอ</option>';
                // for (let item of result) {
                //     let option = document.createElement("option");
                //     option.text = item.amphoe;
                //     option.value = item.amphoe;
                //     input_amphoe.appendChild(option);
                // }
                //QUERY AMPHOES
                // showTambons();
                
            });
    }
function showTambons() {
        let input_province = document.querySelector("#input_province");
        let input_amphoe = document.querySelector("#input_amphoe");
        let url = "{{ url('/api/tambons') }}?province=" + input_province.value + "&amphoe=" + input_amphoe.value;
        console.log(url);        
        // if(input_province.value == "") return;        
        // if(input_amphoe.value == "") return;
        fetch(url)
            .then(response => response.json())
            .then(result => {
                console.log(result);
                //UPDATE SELECT OPTION
                let input_tambon = document.querySelector("#input_tambon");
                input_tambon.innerHTML = '<option value="">กรุณาเลือกแขวง/ตำบล</option>';
                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item.tambon;
                    option.value = item.tambon;
                    input_tambon.appendChild(option);
                }
                //QUERY AMPHOES
                showZipcode();
            });
    }
function showZipcode() {
        let input_province = document.querySelector("#input_province");
        let input_amphoe = document.querySelector("#input_amphoe");
        let input_tambon = document.querySelector("#input_tambon");
        let url = "{{ url('/api/zipcodes') }}?province=" + input_province.value + "&amphoe=" + input_amphoe.value + "&tambon=" + input_tambon.value;
        console.log(url);        
        // if(input_province.value == "") return;        
        // if(input_amphoe.value == "") return;     
        // if(input_tambon.value == "") return;
        fetch(url)
            .then(response => response.json())
            .then(result => {
                console.log(result);
                //UPDATE SELECT OPTION
                let input_zipcode = document.querySelector("#input_zipcode");
                input_zipcode.value = "";
                for (let item of result) {
                    input_zipcode.value = item.zipcode;
                    break;
                }
            });
}
//EVENTS
    document.querySelector('#input_province').addEventListener('change', (event) => {
        showAmphoes();
    });
    document.querySelector('#input_amphoe').addEventListener('change', (event) => {
        showTambons();
    });
    document.querySelector('#input_tambon').addEventListener('change', (event) => {
        showZipcode();
    });
</script>
