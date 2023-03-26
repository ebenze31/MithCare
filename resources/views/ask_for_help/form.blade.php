<link href="{{ asset('mithcare/css/form_for_sos.css') }}" rel="stylesheet">
<style>
    #map_google_ask_for_help {
        height: calc(40vh);

        background-color: #3490dc;
    }
    #map_sos {
        height: calc(40vh);

        background-color: #80bbeb;
    }
    #map_select_location {
        height: calc(40vh);

        background-color: #abe2cb;
    }
    #map_select_location_from_address {
        height: calc(40vh);

        /* background-color: #c632eb; */
    }

/* แจ้งเตือนแบบเท่ */
    .div_alert{
        position: fixed;
        top: -500px;
        left: 0;
        width: 100%;
        text-align: center;
        font-family: 'Kanit', sans-serif;
        z-index: 9999;
        display: flex;
        justify-content: center;
    }
    .div_alert i{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        max-width: 70px;
        height: 50px;
        background-color: #ffddde;
        border-radius: 50%;
        color: #ff5757;
        font-size: 1.5rem;
        margin-left: 1.5rem;

    }
    .up-down {
        animation-name: slideDownAndUp;
        animation-duration: 2s;
    }

    @keyframes slideDownAndUp {
        0% {
            transform: translateY(0);
        }

        10% {
            transform: translateY(520px);
        }

        90% {
            transform: translateY(520px);
        }

        100% {
            transform: translateY(0);
        }
    }
    .alert-child{
        background-color: #db2d2e;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 15px;
        height: 5rem;
        width: 90%;
        padding:20px 10px;
    }
    .text-alert{
        color: #fff;
        float: left;
    }
    .hover-end{
        padding:0;
        margin:0;
        font-size:75%;
        text-align:center;
        position:absolute;
        bottom:0;
        width:100%;
        opacity:.8
    }
</style>

<div id="alert_phone" class=" div_alert " role="alert">
    <div class="alert-child">
        <div >
            <span class="d-block  text-alert font-weight-bold">มีข้อผิดพลาด</span>
            <span class="d-block  text-alert">โปรดกรอกข้อมูลให้ครบถ้วน</span>
        </div>
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>



    <!--===================
            Map
    =====================-->
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="col-12 p-0">
                <div class="d-none" id="map_google_ask_for_help"></div>
                <img class="rounded border border-secondary" src="{{ asset('img/สติกเกอร์ Mithcare/20.png')}}" width="100%" alt="background">
                <div id="message_sos"></div>

            </div>
        </div>
    </div>

        <div class="row p-2">
            <div class="col-6 mb-2 ">
                <input id="input_user_id" value="{{Auth::user()->id}}" class="d-none">
                <input id="partner_id" class="d-none">

                <!-- onclick="SOS_by_Phone()" -->
                <span id="sos_by_phone" name="sos_by_phone" class="btn btn-danger btn-block main-shadow main-radius p-0" >
                    <i class="fa-solid fa-phone"><br> 1669 (โทร)</i>
                </span>
            </div>

            <div class="col-6 mb-2 ">
                <span id="sos_by_btn"  onclick="locations_myhome(null);document.querySelector('#partner_id').value = '1';" name="sos_by_phone" class="btn btn-primary btn-block main-shadow main-radius p-0" data-toggle="modal" data-target="#modal_sos_btn_user"
                style="background-color: #3490dc;color: white;" >
                    <i class="fa-solid fa-truck-medical"> <br> ขอความช่วยเหลือ</i>
                </span>
                <!-- <span id="sos_by_viicheck"  onclick="locations_myhome(null);document.querySelector('#partner_id').value = '3';" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " data-toggle="modal" data-target="#modal_sos_btn_user"
                    style="background-color: #3490dc; font-size: 20px; color: white;" >
                        <i class="fa-solid fa-truck-medical"></i> ขอความช่วยเหลือ Viicheck
                </span>
                <span id="sos_by_peddyhub"  onclick="locations_myhome(null);document.querySelector('#partner_id').value = '2';" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " data-toggle="modal" data-target="#modal_sos_btn_user"
                style="background-color: #3490dc; font-size: 20px; color: white;" >
                    <i class="fa-solid fa-truck-medical"></i> ขอความช่วยเหลือ Peddyhub
                </span> -->
            </div>
        </div>

    <!--===============
            Modal
    =================-->
    <div class="modal fade" id="modal_sos_btn_user" tabindex="-1" role="dialog" aria-labelledby="modal_sos_btn_userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal_sos_btn_userTitle">เลือกพื้นที่</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-6 col-md-4 p-1 ">
                        <a id="btn_myHome" class="btn btn-primary btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="locations_myhome(null);">
                            <i class="fa-solid fa-house-user"></i> บ้านของฉัน
                        </a>
                    </div>
                    <div class="col-6 col-md-4 p-1 ">
                        <a id="btn_myLocation" class="btn btn-success btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="locations_current();">
                            <i class="fa-solid fa-location-dot"></i> เลือกตำแหน่ง
                        </a>
                    </div>
                </div>
                <div id="from_select_position" class="row d-flex justify-content-around ">
                    <div id="btn_select_map"></div>
                </div>

                <!-- บ้านของฉัน mode -->
                <div class="row d-flex justify-content-around">
                    <!-- province -->
                        <div id="div_province" class=" dear_form-group col-lg-4 col-6 p-1 m-0">
                            <label for="address" class="control-label">{{ 'จังหวัด' }}</label>
                            <select name="select_province" id="select_province" class="input-provice dear_form-control kanit d-none" onchange="select_A(); check_input_value_address(); show_location_latlng_province();" required>
                                <option value="" selected>- เลือกจังหวัด -</option>
                            </select>
                            <input type="text" name="input_province" id="input_province" class=" input-provice dear_form-control d-none" readonly>
                        </div>
                        <!-- amphoe -->
                        <div id="div_amphoe" class=" dear_form-group col-lg-4 col-6 p-1 m-0">
                            <label for="address" class="control-label">{{ 'อำเภอ' }}</label>
                            <select name="select_amphoe" id="select_amphoe" class="dear_form-control kanit input-provice d-none" onchange="select_T(); check_input_value_address(); show_location_latlng_amphoe();" required>
                                <option value="" selected>- เลือกอำเภอ -</option>
                            </select>
                            <input type="text" name="input_amphoe" id="input_amphoe" class="input-provice dear_form-control d-none" readonly>
                        </div>
                        <!-- tambon -->
                        <div id="div_tambon" class=" dear_form-group col-lg-4 col-6 p-1 m-0">
                            <label for="address" class="control-label">{{ 'ตำบล' }}</label>
                            <select name="select_tambon" id="select_tambon" class="dear_form-control kanit input-provice d-none" onchange="select_lat_lng(); check_input_value_address();" required required>
                                <option value="" selected>- เลือกตำบล -</option>
                            </select>
                            <input type="text" name="input_tambon" id="input_tambon" class="input-provice dear_form-control d-none" readonly >
                        </div>
                          <!-- address detail -->
                        <div id="div_address_detail" class="d-none dear_form-group col-6 col-md-4 p-1 m-0 ">
                            <label for="address" class="control-label">{{ 'รายละเอียดที่อยู่' }}</label>
                            <input class="dear_form-control" name="input_address" type="text" id="input_address" value="" onchange="check_input_value_address();" readonly required>
                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- phone -->
                        <div id="div_phone" class="d-none dear_form-group col-6 col-md-4 p-1 m-0">
                            <label for="phone" class="control-label">{{ 'เบอร์โทรศัพท์' }}</label>
                            <input class="dear_form-control" name="input_phone" type="text" id="input_phone" value="" onchange="check_input_value_address();" readonly required>
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- lat,lng -->
                        <div id="div_latlng" class="d-none dear_form-group col-12 col-md-4 p-1 m-0">
                            <label for="lng" class="control-label">{{ 'lat,lng' }}</label>
                            <input class="dear_form-control" name="latlng" type="text" id="latlng" value="" readonly>
                            {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- lat -->
                        <input class="dear_form-control d-none" name="lat" type="text" id="lat" value="" readonly>
                        <!-- lng -->
                        <input class="dear_form-control d-none" name="lng" type="text" id="lng" value="" readonly>

                        <input class="d-none" type="text" id="center_lat_map_show" name="" value="13.7248936">
                        <input class="d-none" type="text" id="center_lng_map_show" name="" value="100.4930264">
                        <input class="d-none" type="text" id="va_zoom" name="" value="6">
                        {{-- <div class="col-12 d-none" id="div_lat_lng">
                            <div id="div_form_{{ $count_position }}" class="form-group">
                                <label class="control-label">จุดที่ {{ $count_position }}</label>
                                <input class="form-control" name="position_{{ $count_position }}" type="text" id="position_{{ $count_position }}" value="" placeholder="คลิกที่แผนที่เพื่อรับโลเคชั่น">
                            </div>
                        </div> --}}

                </div><!--/.row -->
                <div class="col-12 p-0 mt-2">
                    <div class="main-radius main-shadow" id="map_select_location"></div>
                    <div class="d-none main-radius main-shadow" id="map_select_location_from_address"></div>
                </div>
            </div>

            <div class="col-12" id="div_image_sos">
                <label class="col-12" style="padding:0px;" for="photo_sos_by_officers" >
                    <div class="fill parent" style="border:dotted #db2d2e;border-radius:25px;padding:0px;object-fit: cover;">
                        @if(empty($data_sos->photo_sos_by_officers))
                            <div class="form-group p-3"id="add_select_img">
                                <input class="form-control d-none" name="photo_sos_by_officers" style="margin:20px 0px 10px 0px;" type="file" id="photo_sos_by_officers" value="{{ isset($data_sos->photo_sos_by_officers) ? $data_sos->photo_sos_by_officers : ''}}" accept="image/*" onchange="document.getElementById('show_photo_sos_by_officers').src = window.URL.createObjectURL(this.files[0]);check_add_img() ">
                                <div  class="text-center">
                                    <center>
                                        <img style=" object-fit: cover; border-radius:15px;max-width: 50%;" src="{{ asset('/img/สติกเกอร์ Mithcare/ขอเอกสาร14.png') }}" class="card-img-top center" style="padding: 10px;">
                                    </center>
                                    <br>
                                    <h3 class="text-center m-0">
                                        <b>กรุณาเลือกรูป "คลิก"</b>
                                    </h3>
                                </div>

                            </div>
                            <img class="full_img d-none" style="padding:0px ; border-radius:20px;" width="100%" alt="your image" id="show_photo_sos_by_officers" />
                        @else
                            <div class="form-group p-3 d-none" id="add_select_img">
                                <input class="form-control d-none" name="photo_sos_by_officers" style="margin:20px 0px 10px 0px;" type="file" id="photo_sos_by_officers" value="{{ isset($data_sos->photo_sos_by_officers) ? $data_sos->photo_sos_by_officers : ''}}" accept="image/*" onchange="document.getElementById('show_photo_sos_by_officers').src = window.URL.createObjectURL(this.files[0]);check_add_img() ">
                                <div  class="text-center">
                                    <center>
                                        <img style=" object-fit: cover; border-radius:15px;max-width: 50%;" src="{{ asset('/img/stickerline/PNG/37.2.png') }}" class="card-img-top center" style="padding: 10px;">
                                    </center>
                                    <br>
                                    <h3 class="text-center m-0">
                                        <b>กรุณาเลือกรูป "คลิก"</b>
                                    </h3>
                                </div>

                            </div>
                            <img class="full_img" style="padding:0px ; border-radius:20px;" width="100%" alt="your image" src="{{ url('storage')}}/{{ $data_sos->photo_sos_by_officers }}" id="show_photo_sos_by_officers" />

                        @endif
                        {{-- <div class="child">
                            <span>เลือกรูป</span>
                        </div> --}}
                    </div>
                </label>
            </div>

            <div class="form-group d-none">
                <input id="btn_submit_form_photo" class="btn btn-primary" type="submit">
            </div>

            <div id="modal-footer" class="modal-footer">
                <div class="row d-flex justify-content-between">

                    <span id="btn_confirm_sos" href="#heading" class="col-5 m-2 mt-0 btn btn__secondary btn-md  kanit btn-block text-white" width="100%"
                        style="width:100%;border-radius: 20px;" onclick="SOS_by_Btn();"> ยืนยัน
                    </span>
                    <span id="btn_change_address" class="col-5 m-2 mt-0 btn btn-info btn-md  kanit btn-block text-white" width="100%"
                        style="width:100%;border-radius: 20px;" onclick="edit_add_to_user();"> เปลี่ยนที่อยู่
                    </span>
                    <span id="btn_confirm_address" href="#" class="col-5 m-2 mt-0 btn btn-info btn-md d-none  kanit btn-block text-white" width="100%"
                        style="width:100%;border-radius: 20px;" disable> บันทึก
                    </span>
                    <span id="btn_cancel_change_add" href="#" class="col-5 m-2 mt-0 btn btn-dark btn-md d-none  kanit btn-block text-white" width="100%"
                        style="width:100%;border-radius: 20px;" onclick="locations_myhome(null);"> ยกเลิก
                    </span>

                </div>
            </div>
        </div>
        </div>
    </div>


<!--=============================================================================================================
                            JAVASCRIPT JAVASCRIPT JAVASCRIPT JAVASCRIPT JAVASCRIPT
===============================================================================================================-->

<script src="{{ asset('js/map_location.js')}}"></script>
<script src="{{ asset('js/map_from_myHome.js')}}"></script>

<script>

    document.addEventListener('DOMContentLoaded', (event) => {
            select_province();
            getLocation();

    });

</script>

<script>
    function SOS_by_Phone(user_id){

        let div_btn_sos_phone = document.querySelector('#sos_by_phone').classList;
        div_btn_sos_phone.add('btn-dark');
        div_btn_sos_phone.remove('btn-primary');
        div_btn_sos_phone.add('d-none');
        div_btn_sos_phone.disable = true;
        // console.log(result);

        let url = "{{ url('/api/sos_phone') }}?user_id=" + user_id;
        console.log(url);
        fetch(url)
            .then(response => response.json())
            .then(result => {

            });
    }

</script>


  <!--==========================================
                Google Map Api
  ============================================-->

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrxXDgk1tgXngalZF3eWtcTWI-LPdeus&language=th"></script>

<!--============================
        map จากการเลือกที่อยู่เอง
  ============================-->
  <script>
    var marker_select_location_from_address;
    var map_select_location_from_address;
    var marker_icon_mithcare = "{{url('/img/logo_mithcare/marker/Marker_mithcare50.png')}}";

    function Open_map_select_location_from_address(lat_from_select,lng_from_select)
    {
        let text_zoom = document.getElementById("va_zoom").value;
        let num_zoom = parseFloat(text_zoom);

        // let text_center_lat = document.getElementById("center_lat").value;
        // let num_center_lat = parseFloat(text_center_lat);

        // let text_center_lng = document.getElementById("center_lng").value;
        // let num_center_lng = parseFloat(text_center_lng);

        // 13.7248936,100.4930264 lat lng ประเทศไทย
        // const myLatlng = { lat: num_center_lat, lng: num_center_lng };

        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        let lat = parseFloat(lat_from_select) ;
        let lng = parseFloat(lng_from_select) ;

        // console.log(lat_from_select);
        // console.log(lng_from_select);

        map_select_location_from_address = new google.maps.Map(document.getElementById("map_select_location_from_address"), {
            center: {lat: lat, lng: lng },
            zoom: num_zoom,
        });

        if (marker_select_location_from_address) {
            marker_select_location_from_address.setMap(null);
        }
        marker_select_location_from_address = new google.maps.Marker({
            position: {lat: lat , lng: lng },
            map: map_select_location_from_address,
            icon: marker_icon_mithcare,
        });

        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
            // content: "คลิกที่แผนที่เพื่อรับโลเคชั่น",
            // position: myLatlng,
        });

        infoWindow.open(map_select_location_from_address);
        // Configure the click listener.
        map_select_location_from_address.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                // position: mapsMouseEvent.latLng,
            });

            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );

            let text_content = infoWindow.content ;

            // console.log(text_content)

            const contentArr = text_content.split(",");

            const lat_Arr = contentArr[0].split(":");

                let marker_lat = lat_Arr[1];

            const lng_Arr = contentArr[1].split(":");

                let marker_lng = lng_Arr[1].replace("\n}", "");

            // console.log(marker_lat)
            // console.log(marker_lng)

            let lat = parseFloat(marker_lat) ;
            let lng = parseFloat(marker_lng) ;



            let center_lat_map_show = document.querySelector('#center_lat_map_show') ;
            let center_lng_map_show = document.querySelector('#center_lng_map_show') ;
                center_lat_map_show.value = marker_lat ;
                center_lng_map_show.value = marker_lng ;

            addMarker_select_location_from_address(marker_lat , marker_lng);

            infoWindow.open(map_select_location_from_address);

        });
    }

    function addMarker_select_location_from_address(marker_lat , marker_lng) {

        if(marker_select_location_from_address){
            marker_select_location_from_address.setMap(null);
        }
        marker_select_location_from_address = new google.maps.Marker({
            position: {lat: parseFloat(marker_lat) , lng: parseFloat(marker_lng) },
            // label: {text: count_position.value, color: "white"},
            map: map_select_location_from_address,
            icon: marker_icon_mithcare,
        });

        document.querySelector("#lat").value = marker_lat;
        document.querySelector("#lng").value = marker_lng;
        document.querySelector("#latlng").value = marker_lat + ',' + marker_lng;
    }

</script>

  <!--==========================================
                Script   ที่อยู่
  ============================================-->

<script>

    function edit_add_to_user(){

        //ล้าง value
        document.getElementById("map_select_location_from_address").innerHTML = "";
        document.getElementById("map_select_location").innerHTML = "";

        // document.getElementById("photo_sos_by_officers").innerHTML = "";
        // document.getElementById("show_photo_sos_by_officers").innerHTML = "";
        document.getElementById('photo_sos_by_officers').value = '';
        document.getElementById("show_photo_sos_by_officers").value = '';
        //add
        document.querySelector('#map_select_location').classList.add('d-none');
        document.querySelector('#input_province').classList.add('d-none');
        document.querySelector('#input_amphoe').classList.add('d-none');
        document.querySelector('#input_tambon').classList.add('d-none');
        document.querySelector('#btn_change_address').classList.add('d-none');
        document.querySelector('#btn_confirm_sos').classList.add('d-none');
        document.querySelector('#div_image_sos').classList.add('d-none');
        // remove
        document.querySelector('#map_select_location_from_address').classList.remove('d-none');
        document.querySelector('#select_province').classList.remove('d-none');
        document.querySelector('#select_amphoe').classList.remove('d-none');
        document.querySelector('#select_tambon').classList.remove('d-none');
        document.querySelector('#div_address_detail').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');

        document.querySelector('#btn_cancel_change_add').classList.remove('d-none');
        document.querySelector('#btn_confirm_address').classList.remove('d-none');


        document.querySelector('#input_address').removeAttribute('readonly');
        document.querySelector('#input_phone').removeAttribute('readonly');
        // document.querySelector('#input_address').setAttribute('required',true);
        // document.querySelector('#input_phone').setAttribute('required',true);
        document.querySelector('#input_address').required = true;
        document.querySelector('#input_phone').required = true;

        let select_province = document.querySelector('#select_province');
        let select_amphoe = document.querySelector('#select_amphoe');
        let select_tambon = document.querySelector('#select_tambon');

        select_province.value = "";
        select_amphoe.value = "";
        select_tambon.value = "";

        let input_province = document.querySelector('#input_province');
        let input_amphoe = document.querySelector('#input_amphoe');
        let input_tambon = document.querySelector('#input_tambon');
        let input_address = document.querySelector('#input_address');
        let input_phone = document.querySelector('#input_phone');

        input_province.value = "";
        input_amphoe.value = "";
        input_tambon.value = "";
        document.querySelector('#input_address').value = "";
        document.querySelector('#input_phone').value = "";

    }

    function check_input_value_address(){
        let input_province = document.querySelector('#select_province').value;
        let input_amphoe = document.querySelector('#select_amphoe').value;
        let input_tambon = document.querySelector('#select_tambon').value;
        let input_address = document.querySelector('#input_address').value;
        let input_phone = document.querySelector('#input_phone').value;

        if(input_province != "" && input_amphoe != "" && input_tambon != "" && input_address != "" && input_phone != ""){
            document.querySelector('#btn_confirm_address').disable = false;
            document.querySelector('#btn_confirm_address').onclick = function() { update_add_to_user(); };
        }else{
            document.querySelector('#btn_confirm_address').disable = true;
            document.querySelector('#btn_confirm_address').onclick = function() {
                document.querySelector('#alert_phone').classList.add('up-down');

                const animated = document.querySelector('.up-down');
                animated.onanimationend = () => {
                    document.querySelector('#alert_phone').classList.remove('up-down');
                };
            };
        }

    }

    function locations_myhome(type) {

        document.getElementById("map_select_location").innerHTML = "";
        //add
        document.querySelector('#btn_myHome').classList.add('btn-primary');
        document.querySelector('#btn_myLocation').classList.add('btn-secondary');
        document.querySelector('#map_select_location_from_address').classList.add('d-none');
        document.querySelector('#btn_cancel_change_add').classList.add('d-none');
        document.querySelector('#btn_confirm_address').classList.add('d-none');

        document.querySelector('#input_address').setAttribute('readonly',true);
        document.querySelector('#input_phone').setAttribute('readonly',true);

        document.querySelector('#select_province').classList.add('d-none');
        document.querySelector('#select_amphoe').classList.add('d-none');
        document.querySelector('#select_tambon').classList.add('d-none');
        //remove
        document.querySelector('#btn_myHome').classList.remove('btn-secondary');
        document.querySelector('#btn_myLocation').classList.remove('btn-success');
        document.querySelector('#map_select_location').classList.remove('d-none');
        document.querySelector('#div_province').classList.remove('d-none');
        document.querySelector('#div_amphoe').classList.remove('d-none');
        document.querySelector('#div_tambon').classList.remove('d-none');
        document.querySelector('#div_address_detail').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');
        document.querySelector('#div_image_sos').classList.remove('d-none');

        document.querySelector('#btn_change_address').classList.remove('d-none');
        document.querySelector('#btn_confirm_sos').classList.remove('d-none');

        document.querySelector('#input_province').classList.remove('d-none');
        document.querySelector('#input_amphoe').classList.remove('d-none');
        document.querySelector('#input_tambon').classList.remove('d-none');

        document.querySelector('#div_address_detail').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');
        // document.querySelector('#div_latlng').classList.remove('d-none');


        let input_province = document.querySelector('#input_province');
        let input_amphoe = document.querySelector('#input_amphoe');
        let input_tambon = document.querySelector('#input_tambon');
        let input_address = document.querySelector('#input_address');
        let input_phone = document.querySelector('#input_phone');

        let lat_user;
        let lng_user;

        if(type === "edit_address"){
            input_province.value = document.querySelector('#select_province').value;
            input_amphoe.value = document.querySelector('#select_amphoe').value;
            input_tambon.value = document.querySelector('#select_tambon').value;

            lat_user = document.querySelector('#lat').value;
            lng_user = document.querySelector('#lng').value;

        }else{
            let select_province = document.querySelector('#select_province');
            let select_amphoe = document.querySelector('#select_amphoe');
            let select_tambon = document.querySelector('#select_tambon');

            select_province.value = "";
            select_amphoe.value = "";
            select_tambon.value = "";

            select_province.required = "";
            select_amphoe.required = "";
            select_tambon.required = "";

            lat_user = "{{ Auth::user()->lat }}";
            lng_user = "{{ Auth::user()->lng }}";

            document.querySelector('#lat').value = lat_user;
            document.querySelector('#lng').value = lng_user;
            document.querySelector('#latlng').value = lat_user + ',' + lng_user;

            input_province.value = "{{ Auth::user()->province }}";
            input_amphoe.value = "{{ Auth::user()->district }}";
            input_tambon.value = "{{ Auth::user()->sub_district }}";
            input_address.value = "{{ Auth::user()->address }}";
            input_phone.value = "{{ Auth::user()->phone }}";
        }



        //เช็ค lat,lng ใน db user
        if(lat_user && lng_user){
            // console.log("if")
            Open_map_select_location();
        }else{
            // console.log("else")
            getLocation_select();
        }

    }

    function getLocation_select() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition_select);
        // navigator.geolocation.getCurrentPosition(geocodeLatLng);
    } else {
        // x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition_select(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        latlng.value = position.coords.latitude+","+position.coords.longitude ;

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        Open_map_select_location();

    }

</script>


<script>

function select_province() {
        let select_province = document.querySelector('#select_province');

        try {
            fetch("{{ url('/') }}/api/select_province/")
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                select_province.innerHTML = "";
                // console.log(select_province);
                let option_select = document.createElement("option");
                option_select.text = "- เลือกจังหวัด -";
                option_select.value = "";
                select_province.add(option_select);

                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item.changwat_th;
                    option.value = item.changwat_th;
                    select_province.add(option);
                }

            });
            // show_location_latlng_province();
        }
        catch(err) {
            select_province();
            alert("ทำซ้ำ");
        }

    }

    function select_A() {

        let select_province = document.querySelector('#select_province');
        let select_amphoe = document.querySelector('#select_amphoe');
        fetch("{{ url('/') }}/api/select_amphoe" + "/" + select_province.value)
            .then(response => response.json())
            .then(result => {
                console.log(result);

                select_amphoe.innerHTML = "";

                let option_select = document.createElement("option");
                option_select.text = "- เลือกอำเภอ -";
                option_select.value = "";
                select_amphoe.add(option_select);

                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item.amphoe_th;
                    option.value = item.amphoe_th;
                    select_amphoe.add(option);
                }


        });
        show_location_latlng_amphoe();
    }

    function select_T() {
        let select_province = document.querySelector('#select_province');
        let select_amphoe = document.querySelector('#select_amphoe');
        let select_tambon = document.querySelector('#select_tambon');

        fetch("{{ url('/') }}/api/select_tambon" + "/" + select_province.value + "/" + select_amphoe.value)
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                select_tambon.innerHTML = "";

                let option_select = document.createElement("option");
                option_select.text = "- เลือกตำบล -";
                option_select.value = "";
                select_tambon.add(option_select);

                for (let item of result) {
                    let option = document.createElement("option");
                    option.text = item.tambon_th;
                    option.value = item.tambon_th;
                    select_tambon.add(option);
                }
            });

            select_lat_lng();
    }

    function show_location_latlng_province(){
        let select_province = document.querySelector('#select_province');

        if (select_province.value) {
                // console.log(select_province.value);

            fetch("{{ url('/') }}/api/select_lat_lng_province" + "/" + select_province.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result);

                    let lat = document.querySelector('#lat');
                    lat.value = result['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result['lng'];

                    let zoom = document.getElementById("va_zoom").value = "8";
                    document.getElementById("latlng").value = lat.value + ',' + lng.value;
                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);

                });
        } else {
            let input_province = document.querySelector('#input_province');

            fetch("{{ url('/') }}/api/select_lat_lng_province" + "/" + input_province.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "else");

                    let lat = document.querySelector('#lat');
                    lat.value = result['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result['lng'];

                    let zoom = document.getElementById("va_zoom").value = "8";
                    document.getElementById("latlng").value = lat.value + ',' + lng.value;
                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);

                });
        }
    }

    function show_location_latlng_amphoe(){

        let select_province = document.querySelector('#select_province');

        if (select_province.value) {
            let select_amphoe = document.querySelector('#select_amphoe');

            fetch("{{ url('/') }}/api/select_lat_lng_amphoe" + "/" + select_province.value + "/" + select_amphoe.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "if");

                    let lat = document.querySelector('#lat');
                    lat.value = result['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result['lng'];

                    let zoom = document.getElementById("va_zoom").value = "10";

                    document.getElementById("latlng").value = lat.value + ',' + lng.value;

                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);

                });
        } else {
            let input_province = document.querySelector('#input_province');
            let input_amphoe = document.querySelector('#input_amphoe');

            fetch("{{ url('/') }}/api/select_lat_lng_amphoe" + "/" + input_province.value + "/" + input_amphoe.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "else");

                    let lat = document.querySelector('#lat');
                    lat.value = result['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result['lng'];

                    let zoom = document.getElementById("va_zoom").value = "10";
                    document.getElementById("latlng").value = lat.value + ',' + lng.value;
                    // document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);


                });
        }

    }

    function select_lat_lng() {

        let select_province = document.querySelector('#select_province');

        if (select_province.value) {
            let select_amphoe = document.querySelector('#select_amphoe');
            let select_tambon = document.querySelector('#select_tambon');

                    //  console.log(select_province.value);
                    //  console.log(select_amphoe.value);
                    //  console.log(select_tambon.value);

            fetch("{{ url('/') }}/api/select_lat_lng" + "/" + select_province.value + "/" + select_amphoe.value + "/" + select_tambon.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "if");

                    let lat = document.querySelector('#lat');
                    lat.value = result[0]['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result[0]['lng'];

                    let zoom = document.getElementById("va_zoom").value = "11";
                    document.getElementById("latlng").value = lat.value + ',' + lng.value;
                    // document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);

                });
        } else {
            let input_province = document.querySelector('#input_province');
            let input_amphoe = document.querySelector('#input_amphoe');
            let input_tambon = document.querySelector('#input_tambon');

            fetch("{{ url('/') }}/api/select_lat_lng" + "/" + input_province.value + "/" + input_amphoe.value + "/" + input_tambon.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "else");

                    let lat = document.querySelector('#lat');
                    lat.value = result[0]['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result[0]['lng'];

                    let zoom = document.getElementById("va_zoom").value = "11";
                    document.getElementById("latlng").value = lat.value + ',' + lng.value;
                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    Open_map_select_location_from_address(lat.value,lng.value,zoom);


                });
        }


    }

    function update_add_to_user(){
        let user_id = document.querySelector('#input_user_id').value;

        //เช็คค่า จ. อ. ต. ว่ามาจาก select หรือ input
        let check_data = document.querySelector('#select_province').value;
        if(check_data){
            var province = document.querySelector('#select_province').value;
            var district = document.querySelector('#select_amphoe').value;
            var sub_district = document.querySelector('#select_tambon').value;
        }else{
            var province = document.querySelector('#input_province').value;
            var district = document.querySelector('#input_amphoe').value;
            var sub_district = document.querySelector('#input_tambon').value;
        }

        let address = document.querySelector('#input_address').value;
        let lat = document.querySelector('#lat').value;
        let lng = document.querySelector('#lng').value;
        let phone = document.querySelector('#input_phone').value;


        let url = "{{ url('/api/update_info_sos') }}?province=" + province + "&district=" + district + "&sub_district=" + sub_district +
        "&address=" + address + "&lat=" + lat + "&lng=" + lng + "&phone=" + phone + "&user_id=" + user_id;

        fetch(url)
            .then(response => response.json())
            .then(result => {

                alert('แก้ไขข้อมูล '+result['name'] +' เรียบร้อย');

            });


            locations_myhome("edit_address");
    }

</script>

<script>
    function SOS_by_Btn(){
        let partner_id = document.querySelector('#partner_id').value;
        //เช็คค่า จ. อ. ต. ว่ามาจาก select หรือ input
        let check_data = document.querySelector('#select_province').value;
        if(check_data){
            var province = document.querySelector('#select_province').value;
            var district = document.querySelector('#select_amphoe').value;
            var sub_district = document.querySelector('#select_tambon').value;
        }else{
            var province = document.querySelector('#input_province').value;
            var district = document.querySelector('#input_amphoe').value;
            var sub_district = document.querySelector('#input_tambon').value;
        }

        let address = document.querySelector('#input_address').value;
        // let phone = document.querySelector('#input_phone').value;
        let user_id = "{{ Auth::user()->id }}";
        let lat = document.querySelector('#lat').value;
        let lng = document.querySelector('#lng').value;



          // API UPLOAD IMG //
        let formData = new FormData();
        let imageFile = document.getElementById('photo_sos_by_officers').files[0];
            formData.append('photo_sos', imageFile);
        console.log(formData);

        let data_sos = {
                    "user_id" : user_id,
                    "lat" : lat,
                    "lng" : lng,
                    "province" : province,
                    "district" : district,
                    "sub_district" : sub_district,
                    "address" : address,
                }
                // console.log(data_sos);

        formData.append('user_id', data_sos.user_id);
        formData.append('lat', data_sos.lat);
        formData.append('lng', data_sos.lng);
        formData.append('province', data_sos.province);
        formData.append('district', data_sos.district);
        formData.append('sub_district', data_sos.sub_district);
        formData.append('address', data_sos.address);


        fetch("{{ url('/api/sos_btn') }}?user_id=" + user_id + "&partner_id=" + partner_id,{
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(result => {
            alert('บันทึกข้อมูล ขอความช่วยเหลือเรียบร้อย');
            // html = '<div> ได้รับข้อมูลขอความช่วยเหลือแล้ว </div>'
            // document.querySelector('#message_sos').innerHTML = html;
        }).catch(function(error){
            // console.error(error);
        });

    }
</script>

<script>
    function Select_Position(){

        document.getElementById("map_select_location").innerHTML = "";
        document.getElementById("map_select_location_from_address").innerHTML = "";
        //add
        document.querySelector('#map_select_location_from_address').classList.add('d-none');
        document.querySelector('#div_province').classList.add('d-none');
        document.querySelector('#div_amphoe').classList.add('d-none');
        document.querySelector('#div_tambon').classList.add('d-none');
        document.querySelector('#div_address_detail').classList.add('d-none');

    }

</script>

<script>
    function locations_current(){
        document.getElementById("map_select_location").innerHTML = "";
        document.getElementById("map_select_location_from_address").innerHTML = "";
        //add
        document.querySelector('#btn_myHome').classList.add('btn-secondary');
        document.querySelector('#btn_myLocation').classList.add('btn-success');
        document.querySelector('#map_select_location_from_address').classList.add('d-none');
        document.querySelector('#div_province').classList.add('d-none');
        document.querySelector('#div_amphoe').classList.add('d-none');
        document.querySelector('#div_tambon').classList.add('d-none');
        document.querySelector('#div_address_detail').classList.add('d-none');

        document.querySelector('#btn_change_address').classList.add('d-none');
        document.querySelector('#btn_cancel_change_add').classList.add('d-none');
        document.querySelector('#btn_confirm_address').classList.add('d-none');
        //remove
        document.querySelector('#btn_myHome').classList.remove('btn-primary');
        document.querySelector('#btn_myLocation').classList.remove('btn-secondary');
        document.querySelector('#map_select_location').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');
        document.querySelector('#btn_confirm_sos').classList.remove('d-none');

        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");
        let input_address = document.querySelector('#input_address');
        let input_phone = document.querySelector('#input_phone');

        input_phone.value = "{{ Auth::user()->phone }}";

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        // console.log(lat);
        // console.log(lng);

        getLocation_select();
    }
</script>

<script>
	function check_add_img(){
		document.getElementById('add_select_img').classList.add('d-none')
		document.getElementById('photo_sos_by_officers').classList.add('d-none');
		document.getElementById('show_photo_sos_by_officers').classList.remove('d-none');

	}
</script>


