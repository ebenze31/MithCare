
<div class="row d-flex justify-content-between">
    <label for="title" class="control-label ml-3">{{ 'ประเภท' }}</label>
    <div class="col-6 p-2">
        <label>
        <input class="card-input-element d-none type_appoint_create" id="type_doc" name="type" type="radio" value="doc"
         onchange="show_input(); " required>
            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                <span style="font-size:16px;">
                    นัดหมอ
                </span>
            </div>
        </label>
    </div>
    <div class="col-6 p-2">
        <label>
        <input class="card-input-element d-none type_appoint_create" id="type_pill" name="type" type="radio" value="pill"
         onchange="show_input(); " required>
            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                <span style="font-size:16px;">
                   ใช้ยา
                </span>
            </div>
        </label>
    </div>
</div>

<div class="row">
    {{-- <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="type" class="control-label" style="font-size: 20px;">{{ 'นัดหมอ/ใช้ยา' }}</label>
        <select name="type" class="form-control" id="type" onchange="show_input();" required>
        <option selected disabled >กรุณาเลือกประเภทนัดหมาย</option>
            @foreach (json_decode('{"doc":"นัดหมอ","pill":"ใช้ยา"}', true) as $optionKey => $optionvalue)
                <option value="{{ $optionKey }}" {{ (isset($appoint->type) && $appoint->type == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div> --}}

    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
        <input class="form-control title_appoint_create" name="title" type="text" id="title" value="{{ isset($appoint->title) ? $appoint->title : ''}}"  required>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>

    {{-- //ส่ง room_id  --}}
    <input class="d-none" id="input_room_id" name="input_room_id" value="{{ isset($room_id) ? $room_id : ''}}">

    <div id="div_date" class="form-group col-md-6 col-12">
        <label id="label_date" for="date" class="control-label">{{ 'วันที่' }}</label>
        <input class="form-control date_appoint_create" name="date" type="date" id="date" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" required>
    </div>

    <div id="div_datetime" class="form-group col-md-6 col-12 ">
        <label id="label_datetime" for="date_time" class="control-label">{{ 'เวลา' }}</label>
        <input class="form-control time_appoint_create" name="date_time" type="time" id="date_time" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" >
    </div>

</div>

<center>
    <div class="col-12 col-md-12 p-0">
        <span class="btn btn-primary " id="btn_create_appoint" onclick="check_input_appoint_create();"
        style="background-color: #3490dc; font-size: 20px; color: white; border-radius:10px" >สร้าง</span>
    </div>
</center>



<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('div_date').classList.add('d-none');
        document.getElementById('div_datetime').classList.add('d-none');
    });

    // function show_input(){

    //     let type = document.querySelector('#type').value;

    //     if (type === 'doc') {
    //         let div_date = document.querySelector('#div_date').classList ;
    //             // console.log(div_date);
    //             div_date.remove("col-md-6");
    //             div_date.remove('d-none');
    //             div_date.add('col-md-12');
    //         document.querySelector('#div_datetime').classList.add('d-none');
    //         document.querySelector('#date_time').required = false ;
    //     }else {
    //          let div_date = document.querySelector('#div_date').classList;
    //             // console.log(div_date);
    //             div_date.remove("col-md-12");
    //             div_date.remove('d-none');
    //             div_date.add('col-md-6');
    //         document.querySelector('#div_datetime').classList.remove('d-none');
    //         document.querySelector('#date_time').required = true ;
    //     }
    // }

    function show_input(){

    if (document.getElementById("type_doc").checked) {
        let div_date = document.querySelector('#div_date').classList ;
            // console.log(div_date);
            div_date.remove("col-md-6");
            div_date.remove('d-none');
            div_date.add('col-md-12');
        document.querySelector('#div_datetime').classList.add('d-none');
        document.querySelector('#date_time').required = false ;
    }else {
        let div_date = document.querySelector('#div_date').classList;
            // console.log(div_date);
            div_date.remove("col-md-12");
            div_date.remove('d-none');
            div_date.add('col-md-6');
        document.querySelector('#div_datetime').classList.remove('d-none');
        document.querySelector('#date_time').required = true ;
    }
}

</script>


<script>
     function showMembers() {
        let input_room_id = document.querySelector("#input_room_id");
        let url = "{{ url('/api/member_of_this_room') }}?room_id=" + input_room_id.value;
        // console.log(url);

        fetch(url)
            .then(response => response.json())
            .then(result => {
                // console.log(result);
                //UPDATE SELECT OPTION
                let input_patient_this_room = document.querySelector("#input_patient_this_room");
                let old_input_patient_this_room = input_patient_this_room.value;
                input_patient_this_room.innerHTML = "";

                if (old_input_patient_this_room && count_select_a === 1) {

                    let option_start = document.createElement("option");
                    option_start.value = old_input_patient_this_room;
                    option_start.text = old_input_patient_this_room;
                    option_start.selected = true;
                    option_start.disabled = true;
                    input_patient_this_room.appendChild(option_start);
                } else {

                    let option_start = document.createElement("option");
                    option_start.text = "กรุณาเลือกผู้ป่วย";
                    option_start.selected = true;
                    input_patient_this_room.appendChild(option_start);
                }

                for (let item of result) {
                    // console.log(item.amphoe);
                    let option = document.createElement("option");
                    option.text = item.input_patient_this_room;
                    option.value = item.input_patient_this_room;
                    input_amphoe.appendChild(option);
                }
                //QUERY AMPHOES
                count_select_a = count_select_a + 1;

            });
    }


</script>

