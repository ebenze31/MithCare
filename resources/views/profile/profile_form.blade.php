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

    <div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}" style="display: block">
        <label for="gender" class="control-label" style="font-size: 25px;">{{ 'เพศ' }}</label>
            <input class="form-control" name="gender" type="text" id="gender" placeholder="กรุณาใส่อีเมล" value="{{ isset($user->gender) ? $user->gender : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} 
    </div>  <!--///  เพศ /// -->

    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}" style="display: block">
        <label for="address" class="control-label" style="font-size: 25px;">{{ 'ที่อยู่' }}</label>
            <input class="form-control" name="address" type="text" id="address" placeholder="กรุณาใส่ที่อยู่" value="{{ isset($user->address) ? $user->address : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบผิดพลาด</p>') !!} 
    </div>  <!--///  ที่อยู่ /// -->

    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}" style="display: block">
        <label for="phone" class="control-label" style="font-size: 25px;">{{ 'เบอร์โทร' }}</label>
            <input class="form-control" name="phone" type="text" id="phone" placeholder="กรุณาใส่เบอร์โทร" value="{{ isset($user->phone) ? $user->phone : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบเบอร์มือถือไม่ถูกต้อง</p>') !!} 
    </div>  <!--///  เบอร์โทร /// -->

    <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}" style="display: block">
        <label for="date" class="control-label" style="font-size: 25px;">{{ 'วันเกิด' }}</label>
            <input class="form-control input" name="date" type="date" id="date" value="{{ isset($user->date) ? $user->date : ''}}">{!! $errors->first('name', '<p class="help-block">:รูปแบบอีเมลไม่ถูกต้อง</p>') !!} 
        
    </div>  <!--///  วันเกิด /// -->

    <div class="form-group">
        <button style="background-color: #3490dc; font-size: 25px; color: white;" class="btn btn-primary form-control" type="submit">ยืนยันการแก้ไข</button>    
    </div>

 

   

<!-- 
    <div class="form-group {{ $errors->has('category_type') ? 'has-error' : ''}}">
        <label for="category_type" class="control-label">{{ 'ประเภทของรายการ' }}<font size="2" color="#FF0000">*</font></label>
        <select id="category_type" name="category_type" class="form-control" required>
        <option selected disabled>กรุณาเลือกประเภท</option>
            <option id="รายรับ" value="รายรับ">รายรับ</option>
            <option id="รายจ่าย" value="รายจ่าย">รายจ่าย</option>
        </select>
    </div> 


    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
        <label for="input_category" class="control-label">{{ 'หมวดหมู่ของรายการ' }}</label>
        <select id="input_category" name="category_id" class="form-control" required>
        <option value="" selected disabled>กรุณาเลือกหมวดหมู่</option>
        </select>
    </div>

    <div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
        <label for="comment" class="control-label">{{ 'รายละเอียด' }}</label>
        <input class="form-control" rows="5" name="comment" type="text" id="comment" placeholder="คำอธิบายหรือหมายเหตุเพิ่มเติม" value="{{ isset($transaction->comment) ? $transaction->comment : ''}}">{!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>

    


    <div id="inc" style="display: block" class="form-group {{ $errors->has('income') ? 'has-error' : ''}}">
        <label for="income" class="control-label">{{ 'จำนวนเงิน' }}</label>
        <input class="form-control" name="income" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="0.01" placeholder="0.00" id="income" value="{{ isset($transaction->income) ? $transaction->income : ''}}" >               
        {!! $errors->first('income', '<p class="help-block">:message</p>') !!}
    </div>

    <div id="exp" style="display: none" class="form-group  {{ $errors->has('expense') ? 'has-error' : ''}}">
        <label for="expense" class="control-label">{{ 'จำนวนเงิน' }}</label>
        <input class="form-control" name="expense" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="0.01" placeholder="0.00" id="expense" value="{{ isset($transaction->expense) ? $transaction->expense : ''}}" >
        {!! $errors->first('expense', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'อัพเดท' : 'Create' }}">
    </div> -->
    
<!-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log("START");
        });



        //ฟังก์ชันShow-Hide -----select = รายรับ->แสดงช่องบันทึกรายรับ, select = รายจ่าย->แสดงช่องบันทึกรายจ่าย
        document.getElementById('category_type').addEventListener("change", function(e) {
            if (e.target.value === 'รายรับ') {
                document.getElementById('exp').style.display = 'none';
                document.getElementById('expense').disabled = true;
                
                document.getElementById('inc').style.display = 'block';
                document.getElementById('income').required = true;
                document.getElementById('income').disabled = false;
                showTopicIncome();
            } else {
                document.getElementById('inc').style.display = 'none';
                document.getElementById('income').disabled = true;
              
                document.getElementById('exp').style.display = 'block'
                document.getElementById('expense').required = true;
                document.getElementById('expense').disabled = false;
                showTopicExpense();
            }
        });
        
        function showTopicIncome(){
            //PARAMETERS
            fetch("{{ url('/') }}/api/category_income")
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    //UPDATE SELECT OPTION
                    let input_category = document.querySelector("#input_category");
                    input_category.innerHTML = '<option value="" selected disabled>กรุณาเลือกหมวดหมู่</option>';
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item.topic;
                        option.value = item.category_id;
                        input_category.appendChild(option);
                    }
                });
        }
    
        function showTopicExpense(){
            //PARAMETERS
            fetch("{{ url('/') }}/api/category_expense")
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    //UPDATE SELECT OPTION
                    let input_category = document.querySelector("#input_category");
                    input_category.innerHTML = '<option value="" selected disabled>กรุณาเลือกหมวดหมู่</option>';
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item.topic;
                        option.value = item.category_id;
                        input_category.appendChild(option);
                    }
                });
        }

    

</script> -->

