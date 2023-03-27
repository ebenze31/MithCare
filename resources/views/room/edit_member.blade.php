<style>
    .header_edit_member {
        background-color: transparent;
        padding: 7px;
        border-style: solid;
        border-width: 1px;
        border-radius: 25px;
        border-color: #4170A2;
    }

    .header-line_edit_member {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .header-name1_edit_member {
        font-size: 18px;
        font-weight: bold;
    }

    .header-name2_edit_member, .header-name3_edit_member {
        font-size: 18px;
        margin: 0 10px;
        font-weight: bold;
        /* padding-left: 3px; */
    }

    .header-close_edit_member {
        background-color: #ffffff !important;
        border-width: 1px;
        border-style: solid;
        border-radius: 5px;
        border-color: #eb0505 !important;
        padding: 3px;
        font-size: 16px;
        cursor: pointer;
        float: left;
    }

    .header-close_edit_member:hover {
        background-color: #eb0505 !important;
        color: #ffffff !important;
    }
    .vhr{
        border:         none;
        border-left:    1px solid hsla(200, 10%, 50%,100);
        height:         3rem;
        width:          1px;
    }
</style>
    <div class="row ">
        <div class="col-12 col-md-12 col-lg-12 from-group">
            <label for="status" class="control-label" style="font-size: 25px;">{{ 'เลือกสถานะ' }}</label>
        </div>
        <div class="col-6 col-md-6 col-lg-6 from-group">
            <label>
                <input class="card-input-element d-none" id="status_member_of_room{{$item->user_id}}" name="status_of_room" type="radio" onclick="show_input_fr({{$item->user_id}});" value="member" required>
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        สมาชิก
                    </span>
                </div>
            </label>
        </div>

        <div class="col-6 col-md-6 col-lg-6 from-group">
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
                                    <!-- กันให้ไม่สามารถเลือกดูแลตัวเองได้-->
                                    @if($item_room->user_id != $item->user_id)
                                    {{-- <div class="home-demo">
                                        <div class="owl-carousel patient_wait_for_takecare owl-theme"> --}}
                                            <div class="col-12 col-md-6 col-lg-6">
                                                @if (!empty($item_room->caregiver))
                                                   <!-- มีผู้ดูแลแล้ว-->
                                                    <label>
                                                        <input class="card-input-element check_checkbox_select_takecare d-none" id="checkbox_select_takecare{{$item->user_id}}" name="checkbox_select_takecare" type="checkbox" onclick="click_Select_Takecare({{$item->user_id}});" value="{{$item_room->user_id}}">
                                                        <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                            <i class="fa-duotone fa-user-nurse text_topright"></i>
                                                            <span>
                                                                {{$item_room->user->full_name}}
                                                            </span>
                                                        </div>
                                                    </label>
                                                @else
                                                    <!-- ยังไม่มีผู้ดูแล-->
                                                <label>
                                                    <input class="card-input-element check_checkbox_select_takecare d-none" id="checkbox_select_takecare{{$item->user_id}}" name="checkbox_select_takecare" type="checkbox" onclick="click_Select_Takecare({{$item->user_id}});" value="{{$item_room->user_id}}">
                                                    <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                                                        <span>
                                                            {{$item_room->user->full_name}}
                                                        </span>
                                                    </div>
                                                </label>
                                                @endif

                                            </div>
                                        {{-- </div><!-- owl-carousel-->
                                    </div><!-- home-demo--> --}}
                                    @endif
                                @endforeach
                        </div>

        {{-- <input class="form-control d-none" type="text" name="caregiver" id="caregiver" value="{{Auth::user()->id}}"> --}}
            <input class="form-control d-none" type="text" name="user_id" id="user_id" value="{{$item->user_id}}">
            <input class="form-control " type="text" name="select_takecare" id="select_takecare{{$item->user_id}}">
            <div id="alert_message_member_edit{{$item->user_id}}"></div>

    </div> <!--///  เลือกผู้ดูแล /// -->

        <!--====================
        Modal ยืนยันแก้ไขสถานะ
        ======================-->

            <!-- Modal -->
            <div class="modal fade modal-slick_edit_member" id="confirm_edit_memberModal{{ $item->user_id }}" tabindex="-50" role="dialog"
                aria-labelledby="confirm_edit_memberModal{{ $item->user_id}}Title" data-backdrop="static" data-keyboard="false" tabindex="-2"
                aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_sos_btn_userTitle">ผู้ป่วยต่อไปนี้มีผู้ดูแลอยู่แล้ว ต้องการเปลี่ยนหรือไม่</h5>
                                <span  type="button" class="close" onclick="close_this_modal({{ $item->user_id }});">
                                    <i class="fa-solid fa-circle-xmark p-0 m-0 " style="color: #4170A2;"></i>
                                </span>
                            </div>
                            <!-- รายชื่อผู้ดูแล -->
                            <div class="modal-body">
                                <div id="data_member_form_db{{ $item->user_id }}"></div>
                                <hr>
                                <button type="submit" id="confirm_submit_edit_member{{ $item->user_id }}" class="btn btn-primary d-block">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
            </div><!-- modal -->
        <!--========================
        End Modal ยืนยันแก้ไขสถานะ
        ============================-->

    {{-- <script>
        $(function() {
        // Owl Carousel
        var owl = $(".patient_wait_for_takecare");
        owl.owlCarousel({
            items: 2,
            margin: 10,
            loop: false,
            nav: true,
            });
        });
    </script> --}}
    <div id="lv_caretaker_fr{{$item->user_id}}" class="row p-0">
        <div class="col-12 col-md-12 col-lg-12 ">
            <label for="status" class="control-label" style="font-size: 25px;">{{ 'กรุณาเลือกระดับผู้ป่วย' }}</label>
        </div>

        <div class="col-12 col-md-6 col-lg-6 ">
            <label>
                <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_1_of_caretaker"  name="lv_of_caretaker" type="radio" value="1" >
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        ระดับ 1 (สามารถดูแลตัวเองได้)
                    </span>
                </div>
            </label>
        </div>

        <div class="col-12 col-md-6 col-lg-6 ">
            <label>
                <input class="card-input-element d-none lv_of_caretaker{{$item->user_id}}" id="lv_2_of_caretaker"  name="lv_of_caretaker" type="radio" value="2" >
                <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                    <span>
                        ระดับ 2 (ไม่สามารถดูแลตัวเองได้)
                    </span>
                </div>
            </label>
        </div>

    </div><!--.row -->

    <div class="form-group" id="from_btn_for_submit">
        <span class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" onclick="Check_before_submit({{$item->user_id}},{{$item->room_id}},{{$item->id}})" >
            บันทึก
        </span>
    </div>

<!--เรียกใช้ axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('takecare_fr{{$item->user_id}}').classList.add('d-none');
    document.getElementById('lv_caretaker_fr{{$item->user_id}}').classList.add('d-none');
});

function show_input_fr(user_id){

    // let select_takecare = document.getElementsByName("select_takecare"+user_id);
    //เลือกเป็น สมาชิก
    if (document.getElementById("status_member_of_room"+user_id).checked) {

        let takecare_fr = document.querySelector('#takecare_fr'+user_id).classList;
            takecare_fr.remove('d-none');
            takecare_fr.add('col-12');

        document.querySelector('#lv_caretaker_fr'+user_id).classList.add('d-none');

        let radio_lv_takecare = document.querySelectorAll('.lv_of_caretaker'+user_id);
            document.querySelector('#select_takecare'+user_id).value = "";

            radio_lv_takecare.forEach(radio_lv_takecare => {
                radio_lv_takecare.checked = false;
                radio_lv_takecare.required = false;
            });


    }else {
        //เลือกเป็น ผู้ป่วย
        console.log('เข้า else');
        let lv_caretaker_fr = document.querySelector('#lv_caretaker_fr'+user_id).classList;
            lv_caretaker_fr.remove('d-none');
            lv_caretaker_fr.add('col-12');

        document.querySelector('#takecare_fr'+user_id).classList.add('d-none');
        document.querySelector('#takecare_fr'+user_id).required = false ;
        document.querySelector('.lv_of_caretaker'+user_id).required = true ;

        document.querySelector('#select_takecare'+user_id).value = "";

        let checkbox_select_takecare = document.querySelectorAll('input[name="checkbox_select_takecare"]');
        for (let i = 0; i < checkbox_select_takecare.length; i++) {
            checkbox_select_takecare[i].checked = false;
        }
    }
}

</script>

<script>
function click_Select_Takecare(user_id){

    let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare');
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

<script>
    function Check_before_submit(user_id,room_id,id){
        let checkbox_select_takecare = document.getElementsByName('checkbox_select_takecare');
        let select_takecare = document.querySelector('#select_takecare'+user_id);
        let data_member_room = [];
        document.querySelector('#data_member_form_db'+user_id).innerHTML = "";
        document.querySelector('#select_takecare'+user_id).innerHTML = "";
        const url = "{{ url('/') }}/api/member_for_edit_status" + "/" + room_id + "?select_takecare=" + select_takecare.value + "&user_id=" + user_id;

        axios.get(url).then((response) => {
            console.log(response);
        if(response['data'] && response['data'].length > 0){
            for (let i = 0; i < response['data'].length; i++) {
                console.log(response['data'].length);

                    let patient_id = response['data'][i]['patient_id'];
                    let name_patient = response['data'][i]['name_patient'];
                    let caregiver_id = response['data'][i]['caregiver_id'];
                    let caregiver_name = response['data'][i]['caregiver_name'];
                    let caregiver_new = response['data'][i]['caregiver_new'];

                    html =  '<div id="item_data_member_form_db'+patient_id+'">' +
                                '<div class="header_edit_member mt-2">' +
                                    '<div class="header-line_edit_member">' +
                                        '<div class="col-9 text-center">' +
                                            '<span class="header-name1_edit_member">(ผู้ป่วย)</span>' +
                                            '<br>' +
                                            '<span class="header-name1_edit_member" style="color:#4170A2;">'+ name_patient +'</span>' +
                                        '</div>' +
                                        '<div class="col-3">' +
                                            '<span class="header-close_edit_member" onclick="cancel_caregiver('+ patient_id +','+ user_id +');">ยกเลิก</span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<hr class="m-1 p-1" style="border-color:#4170A2">' +
                                    '<div class="header-line_edit_member text-center">' +
                                        '<span class="header-name2_edit_member text-center">(ผู้ดูแลเก่า)<br><a style="color:#e3342f;">'+ caregiver_name +'</a></span>' +
                                        '<div class="vhr" style="border-color:#4170A2"></div>' +
                                        '<span class="header-name3_edit_member text-center">(ผู้ดูแลใหม่)<br><a style="color:#27864f;">'+ caregiver_new +'</a></span>' +

                                    '</div>' +
                                '</div>' +
                            '</div>';

                    document.querySelector('#data_member_form_db'+user_id).insertAdjacentHTML('beforeend', html); // แทรกล่างสุด

                    $('#confirm_edit_memberModal'+user_id).modal();
            }
        }
        else
        {
            document.querySelector('#confirm_submit_edit_member' + user_id).click();

            // if(select_takecare.value == null){
            //     let alert_message_member_edit = document.querySelector('#alert_message_member_edit'+user_id);
            //     let html =
            //                 '<a id="password_check_match_exacly'+user_id+'" class="text-danger p-0 m-2 alert-fade-password'+user_id+'" font-size: 20px;" >' +
            //                     'กรุณาเลือกผู้ดูแล' +
            //                 '</a>';
            //                 alert_message_member_edit.innerHTML = html;
            //                 $(document).ready(function(){
            //                     $('.alert-fade-password'+user_id).fadeIn().delay(3000).fadeOut();
            //                 });
            // }else{
            // }

        }

        })
        .catch((error) => {
            console.log(error);
        });



    }
</script>

<script>
    function cancel_caregiver(item_id,user_id){
        document.querySelector('#item_data_member_form_db'+item_id).innerHTML = "";

        console.log("item_id >> " + item_id);
        console.log("user_id >> " + user_id);
        console.log("เข้าcancel_caregiver");


        let checkbox_select_takecare = document.querySelectorAll('input[name="checkbox_select_takecare"]');
        checkbox_select_takecare.forEach(checkbox_select_takecare => {

            if(checkbox_select_takecare.value == item_id){

                checkbox_select_takecare.checked = false;
                click_Select_Takecare(user_id);

            }
        });

    }

</script>


<script>
    function close_this_modal(user_id){
      $('#confirm_edit_memberModal'+user_id).modal('hide');

    }
</script>

<script>
    function clear_value_member_edit(user_id){

        document.querySelector('#data_member_form_db'+user_id).innerHTML = "";
        document.querySelector('#select_takecare'+user_id).value = "";

        //clear radio เลือกสถานะ สมาชิกหรือผู้ป่วย
        let status_of_room = document.querySelectorAll('input[name="status_of_room"]');
        status_of_room.forEach(status_of_room => {
            status_of_room.checked = false;
        });
        document.querySelector('#lv_caretaker_fr'+user_id).classList.add('d-none');

        //clear checkbox ของ เมมเบอร์ตอนเลือกดูแลผู้ป่วย
        let checkbox_select_takecare = document.querySelectorAll('input[name="checkbox_select_takecare"]');
        for (let i = 0; i < checkbox_select_takecare.length; i++) {
            checkbox_select_takecare[i].checked = false;
        }
        document.querySelector('#takecare_fr'+user_id).classList.add('d-none');

        //clear radio ของ ผู้ป่วยตอนเลือกระดับผู้ป่วย
        let radio_lv_takecare = document.querySelectorAll('input[name="lv_of_caretaker"]');

        radio_lv_takecare.forEach(radio_lv_takecare => {
            radio_lv_takecare.checked = false;
        });

    }
    </script>


