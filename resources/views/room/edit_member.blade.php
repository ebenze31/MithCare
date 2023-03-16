<form method="POST" action="{{ url('room_join') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row ">
        <div class="col-12 col-md-12 col-lg-12 from-group">
            <label for="status" class="control-label" style="font-size: 25px;">{{ 'เลือกสถานะ' }}</label>
        </div>
        <div class="col-12 col-md-6 col-lg-6 from-group">
            <label>
                <input class="card-input-element d-none" id="status_member_of_room{{$item->user_id}}" name="status_of_room" type="radio" onclick="show_input_fr({{$item->user_id}});" value="member" required>
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        สมาชิก
                    </span>
                </div>
            </label>
        </div>

        <div class="col-12 col-md-6 col-lg-6 from-group">
            <label>
                <input class="card-input-element d-none" id="status_patient_of_room{{$item->user_id}}" name="status_of_room" type="radio" onclick="show_input_fr({{$item->user_id}});" value="patient" required>
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        ผู้ป่วย
                    </span>
                </div>
            </label>
        </div>
    </div>



    <div id="takecare_fr{{$item->user_id}}" class="form-group ">
        <label for="status" class="control-label" style="font-size: 25px;">{{ 'กรุณาเลือกผู้ที่ต้องการดูแล' }}</label>
       <div class="row">
            @foreach($this_room as $item_room)
            <div class="col-12 col-md-4 col-lg-4">
                <label>
                    {{-- <input type="checkbox"  name="be_notified" value="วิธีอื่นๆ" class="card-input-element d-none" > --}}
                <input class="card-input-element d-none" id="checkbox_select_takecare{{$item_room->user_id}}" name="checkbox_select_takecare" type="checkbox" onclick="click_Select_Takecare();" value="{{$item_room->user_id}}">
                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                        <span>
                            {{$item_room->user->full_name}}
                        </span>
                    </div>
                </label>
            </div>
            @endforeach
       </div>
       {{-- <input class="form-control d-none" type="text" name="caregiver" id="caregiver" value="{{Auth::user()->id}}">
     <input class="form-control d-none" type="text" name="user_id" id="user_id" value="{{Auth::user()->id}}"> --}}
        <input class="form-control d-none" type="text" name="select_takecare" id="select_takecare{{$item->user_id}}">

    </div> <!--///  เลือกผู้ดูแล /// -->

    <div id="lv_caretaker_fr{{$item->user_id}}" class="row form-group col-12 col-md-12 ">
        <div class="col-12 col-md-12 col-lg-12 from-group p-0">
            <label for="status" class="control-label" style="font-size: 25px;">{{ 'กรุณาเลือกระดับผู้ป่วย' }}</label>
        </div>

        <div class="col-12 col-md-6 col-lg-6 from-group  @error('lv_1_of_caretaker') is-invalid @enderror">
            <label>
                <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_1_of_caretaker"  name="lv_of_caretaker" type="radio" value="1" >
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        ระดับ 1 (กดยืนยันใช้ยาเองได้)
                    </span>
                </div>
            </label>
        </div>
            @error('lv_1_of_caretaker')
                <span class="invalid-feedback" role="alert">
                    <strong>กรุณาเลือกระดับผู้ป่วยก่อน</strong>
                </span>
            @enderror

        <div class="col-12 col-md-6 col-lg-6 from-group   @error('lv_2_of_caretaker') is-invalid @enderror">
            <label>
                <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_2_of_caretaker"  name="lv_of_caretaker" type="radio" value="2" >
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        ระดับ 2 (ไม่สามารถกดยืนยันใช้ยาเองได้)(ผู้ดูแลกดให้)
                    </span>
                </div>
            </label>
        </div>
            @error('lv_2_of_caretaker')
                <span class="invalid-feedback" role="alert">
                    <strong>กรุณาเลือกระดับผู้ป่วยก่อน</strong>
                </span>
            @enderror
    </div>

    <div class="form-group">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">
            บันทึก
        </button>
    </div>

</form><!--///  end form /// -->

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('takecare_fr{{$item->user_id}}').classList.add('d-none');
    document.getElementById('lv_caretaker_fr{{$item->user_id}}').classList.add('d-none');
});

function show_input_fr(user_id){
    console.log(user_id);
    // let select_takecare = document.getElementsByName("select_takecare"+user_id);
    //เลือกเป็น สมาชิก
    if (document.getElementById("status_member_of_room"+user_id).checked) {
        console.log('if');
        console.log(user_id);
        let takecare_fr = document.querySelector('#takecare_fr'+user_id).classList;
            console.log(takecare_fr);
            takecare_fr.remove('d-none');
            takecare_fr.add('col-12');
        document.querySelector('#lv_caretaker_fr'+user_id).classList.add('d-none');
        // document.getElementsByName('lv_of_caretaker').required = false ;

        let radio_lv_takecare =  document.querySelector('.lv_of_caretaker'+user_id);
            // document.querySelector('#select_takecare').value = "";

        for (let i = 0; i < radio_lv_takecare.length; i++) {
            radio_lv_takecare[i].checked = false ;
            radio_lv_takecare[i].required = false ;
            }

    }else {
        //เลือกเป็น ผู้ป่วย
        // console.log('เข้า else');
         let lv_caretaker_fr = document.querySelector('#lv_caretaker_fr'+user_id).classList;
            console.log(lv_caretaker_fr);
            lv_caretaker_fr.remove('d-none');
            lv_caretaker_fr.add('col-12');
            document.querySelector('#takecare_fr'+user_id).classList.add('d-none');
            document.querySelector('#takecare_fr'+user_id).required = false ;
            document.querySelector('.lv_of_caretaker'+user_id).required = true ;

            let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare'+user_id);
            document.querySelector('#select_takecare'+user_id).value = "";

            for (let i = 0; i < checkbox_select_takecare.length; i++) {
                checkbox_select_takecare[i].checked = false ;
            }
    }
}

</script>

<script>
function click_Select_Takecare(){
    let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare'+user_id);
    let select_takecare = document.querySelector('#select_takecare'+user_id);

    select_takecare.value = "" ;
    for (let i = 0; i < checkbox_select_takecare.length; i++) {
        if (checkbox_select_takecare[i].checked) {
            if (select_takecare.value === "") {
                select_takecare.value = checkbox_select_takecare[i].value ;
            }else{
                select_takecare.value = select_takecare.value + "," +  checkbox_select_takecare[i].value ;
            }
        }
    }
}
</script>


