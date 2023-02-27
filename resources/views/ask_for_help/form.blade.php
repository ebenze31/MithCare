
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

        background-color: #c632eb;
    }
</style>

        <!--===================
            Select Address
        =====================-->



    <!--===================
            Map
    =====================-->
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="col-12 p-0">
                <div class="d-" id="map_google_ask_for_help"></div>
                <div id="message_sos"></div>

            </div>
        </div>
    </div>
    <div id="location_users">

    </div>

    <div class="justify-content-center">
        <div class="column">
            <div class="col-12 mb-2">
                <span id="sos_by_btn" value="{{Auth::user()->id}}" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " data-toggle="modal" data-target="#modal_sos_btn_user"
                style="background-color: #3490dc; font-size: 20px; color: white;" >
                    <i class="fa-solid fa-truck-medical"></i> ขอความช่วยเหลือ
                </span>
            </div>
            <div class="col-12 mb-2">
                <input id="input_user_id" value="{{Auth::user()->id}}" class="d-none">
                <span id="sos_by_phone" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " onclick="SOS_by_Phone()" >
                    <i class="fa-solid fa-phone"></i> โทรฉุกเฉิน
                </span>
            </div>
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
                        <a href="#heading" class="btn btn-primary btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="locations_myhome(null);">
                            <i class="fa-solid fa-house-user"></i> บ้านของฉัน
                        </a>
                    </div>
                    <div class="col-6 col-md-4 p-1 ">
                        <a href="#heading" class="btn btn-success btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="locations_current();">
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
                        <div id="div_province" class=" form-group col-lg-4 col-12 p-1 m-0">
                            <label for="address" class="control-label">{{ 'จังหวัด' }}</label>
                            <select name="select_province" id="select_province" class="input-provice form-control kanit" onchange="select_A(); check_input_value_address();" required>
                                <option value="" selected>- เลือกจังหวัด -</option>
                            </select>
                            <input type="text" name="input_province" id="input_province" class=" input-provice form-control d-none" readonly>
                        </div>
                        <!-- amphoe -->
                        <div id="div_amphoe" class=" form-group col-lg-4 col-12 p-1 m-0">
                            <label for="address" class="control-label">{{ 'อำเภอ' }}</label>
                            <select name="select_amphoe" id="select_amphoe" class="form-control kanit input-provice " onchange="select_T(); check_input_value_address();" required>
                                <option value="" selected>- เลือกอำเภอ -</option>
                            </select>
                            <input type="text" name="input_amphoe" id="input_amphoe" class="input-provice form-control d-none" readonly>
                        </div>
                        <!-- tambon -->
                        <div id="div_tambon" class=" form-group col-lg-4 col-12 p-1 m-0">
                            <label for="address" class="control-label">{{ 'ตำบล' }}</label>
                            <select name="select_tambon" id="select_tambon" class="form-control kanit input-provice " onchange="select_lat_lng(); check_input_value_address();" required required>
                                <option value="" selected>- เลือกตำบล -</option>
                            </select>
                            <input type="text" name="input_tambon" id="input_tambon" class="input-provice form-control d-none" readonly >
                        </div>
                          <!-- address detail -->
                        <div id="div_address_detail" class="d-none form-group col-12 col-md-4">
                            <label for="address" class="control-label">{{ 'รายละเอียดที่อยู่' }}</label>
                            <input class="form-control" name="input_address" type="text" id="input_address" value="" onchange="check_input_value_address();" readonly required>
                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- phone -->
                        <div id="div_phone" class="d-none form-group col-12 col-md-4">
                            <label for="phone" class="control-label">{{ 'เบอร์โทรศัพท์' }}</label>
                            <input class="form-control" name="input_phone" type="text" id="input_phone" value="" onchange="check_input_value_address();" readonly required>
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- lat,lng -->
                        <div id="div_latlng" class=" form-group col-12 col-md-4">
                            <label for="lng" class="control-label">{{ 'lat,lng' }}</label>
                            <input class="form-control" name="latlng" type="text" id="latlng" value="" readonly>
                            {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
                        </div>
                        <!-- lat -->
                        <input class="form-control d-none" name="lat" type="text" id="lat" value="" readonly>
                        <!-- lng -->
                        <input class="form-control d-none" name="lng" type="text" id="lng" value="" readonly>

                        <input class="d-none" type="text" id="center_lat_map_show" name="" value="13.7248936">
                        <input class="d-none" type="text" id="center_lng_map_show" name="" value="100.4930264">

                        {{-- <div class="col-12 d-none" id="div_lat_lng">
                            <div id="div_form_{{ $count_position }}" class="form-group">
                                <label class="control-label">จุดที่ {{ $count_position }}</label>
                                <input class="form-control" name="position_{{ $count_position }}" type="text" id="position_{{ $count_position }}" value="" placeholder="คลิกที่แผนที่เพื่อรับโลเคชั่น">
                            </div>
                        </div> --}}

                </div><!--/.row -->
                <div class="col-12 p-0">
                    <div class="" id="map_select_location"></div>
                    <div class="d-none" id="map_select_location_from_address"></div>
                </div>
            </div>
            <div id="modal-footer" class="modal-footer">
                <div class="row d-flex justify-content-between">

                    <span id="btn_confirm_sos" href="#heading" class="col-5 m-2 mt-0 btn btn__secondary btn-md  kanit btn-block text-white" width="100%"
                        style="width:100%;border-radius: 20px;" onclick="SOS_by_Btn();"> ยืนยันขอความช่วยเหลือ
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
    var marker_icon_mithcare = "{{url('/img/logo_mithcare/marker/Marker_mithcare.png')}}";

    function map_select_location_from_address(lat_from_select,lng_from_select)
    {
        // 13.7248936,100.4930264 lat lng ประเทศไทย
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        let lat = parseFloat(lat_from_select) ;
        let lng = parseFloat(lng_from_select) ;

        // console.log(lat_from_select);
        // console.log(lng_from_select);

        map_select_location_from_address = new google.maps.Map(document.getElementById("map_select_location_from_address"), {
            center: {lat: lat, lng: lng },
            zoom: 14,
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

        //add
        document.querySelector('#map_select_location').classList.add('d-none');
        document.querySelector('#input_province').classList.add('d-none');
        document.querySelector('#input_amphoe').classList.add('d-none');
        document.querySelector('#input_tambon').classList.add('d-none');
        document.querySelector('#btn_change_address').classList.add('d-none');
        document.querySelector('#btn_confirm_sos').classList.add('d-none');
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

        // html =  '<div class="row d-flex justify-content-between">' +
        //             '<a id="btn_cancel_change_add" href="#heading" class="col-5 m-2 mt-0 btn btn__secondary btn-md  kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" >' +
        //                  'ยกเลิก' +
        //             '</a>' +
        //             '<a id="btn_confirm_address" href="#heading" class="col-5 m-2 mt-0 btn btn-info btn-md  kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" >' +
        //                  'บันทึก'่ +
        //             '</a>' +
        //         '</div>' ;

        // document.querySelector('#modal-footer').innerHTML = html;

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

        let select_province = document.querySelector('#select_province');
        let select_amphoe = document.querySelector('#select_amphoe');
        let select_tambon = document.querySelector('#select_tambon');



    }

    function check_input_value_address(){
        let input_province = document.querySelector('#select_province').value;
        let input_amphoe = document.querySelector('#select_amphoe').value;
        let input_tambon = document.querySelector('#select_tambon').value;
        let input_address = document.querySelector('#input_address').value;
        let input_phone = document.querySelector('#input_phone').value;
        console.log(input_province);
        console.log(input_amphoe);
        console.log(input_tambon);
        console.log(input_address);
        console.log(input_phone);
        if(input_province != "" && input_amphoe != "" && input_tambon != "" && input_address != "" && input_phone != ""){
            document.querySelector('#btn_confirm_address').disable = false;
            document.querySelector('#btn_confirm_address').onclick = function() { update_add_to_user(); };
        }else{
            document.querySelector('#btn_confirm_address').disable = true;
            document.querySelector('#btn_confirm_address').onclick = function() { alert("กรุณากรอกข้อมูลให้ครบก่อน"); };
        }

    }

    function locations_myhome(type) {

        document.getElementById("map_select_location").innerHTML = "";
        //add
        document.querySelector('#map_select_location_from_address').classList.add('d-none');
        document.querySelector('#btn_cancel_change_add').classList.add('d-none');
        document.querySelector('#btn_confirm_address').classList.add('d-none');

        document.querySelector('#input_address').setAttribute('readonly',true);
        document.querySelector('#input_phone').setAttribute('readonly',true);

        document.querySelector('#select_province').classList.add('d-none');
        document.querySelector('#select_amphoe').classList.add('d-none');
        document.querySelector('#select_tambon').classList.add('d-none');
        //remove
        document.querySelector('#map_select_location').classList.remove('d-none');
        document.querySelector('#div_province').classList.remove('d-none');
        document.querySelector('#div_amphoe').classList.remove('d-none');
        document.querySelector('#div_tambon').classList.remove('d-none');
        document.querySelector('#div_address_detail').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');

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

        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);

        // select_lat_lng();

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
        // console.log(lat);
        // console.log(lng);

        //   let location_users = document.querySelector("#location_user");
        //       location_users.innerHTML = '<a class=" shadow-box text-white btn btn-primary shadow" style="position:absolute;margin-top:-100px;margin-left:10px;border-radius:10px" id="submit"><i class="fas fa-search-location"></i></a>';
        //   check_area(lat,lng);
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
                // console.log(result);

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

    function select_lat_lng() {

        let select_province = document.querySelector('#select_province');

        if (select_province.value) {
            let select_amphoe = document.querySelector('#select_amphoe');
            let select_tambon = document.querySelector('#select_tambon');

            fetch("{{ url('/') }}/api/select_lat_lng" + "/" + select_province.value + "/" + select_amphoe.value + "/" + select_tambon.value)
                .then(response => response.json())
                .then(result => {
                    // console.log(result + "if");

                    let lat = document.querySelector('#lat');
                    lat.value = result[0]['lat'];

                    let lng = document.querySelector('#lng');
                    lng.value = result[0]['lng'];

                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    map_select_location_from_address(lat.value,lng.value);

                    // console.log("if");
                    // console.log(lat);
                    // console.log(lng);

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

                    document.querySelector('#map_select_location_from_address').classList.remove('d-none');
                    map_select_location_from_address(lat.value,lng.value);

                    // console.log("else");
                    // console.log(lat);
                    // console.log(lng);
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
        let phone = document.querySelector('#input_phone').value;
        let user_id = "{{ Auth::user()->id }}";
        let lat = document.querySelector('#lat').value;
        let lng = document.querySelector('#lng').value;


        let url = "{{ url('/api/sos_btn') }}?province=" + province + "&district=" + district + "&sub_district=" + sub_district +
        "&address=" + address +  "&lat=" + lat + "&lng=" + lng + "&phone=" + phone + "&user_id=" + user_id;

        fetch(url)
            .then(response => response.json())
            .then(result => {
                alert('บันทึกข้อมูล ขอความช่วยเหลือเรียบร้อย');
                // html = '<div> ได้รับข้อมูลขอความช่วยเหลือแล้ว </div>'
                // document.querySelector('#message_sos').innerHTML = html;
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

        // document.querySelector('#from_select_position').classList.remove('d-none');
        let html;
        let show_btn_address = document.querySelector('#btn_select_map');
            show_btn_address.innerHTML = "";

        html =  '<div class="col-6 col-md-4 p-1 ">' +
                    '<a class="btn btn-primary btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" >' +
                        '<i class="fa-solid fa-house-user">' + '</i>' + 'เลือกจากแผนที'่ +
                    '</a>' +
                '</div>' +
                '<div class="col-6 col-md-4 p-1 ">' +
                    '<a  class="btn btn-success btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" ' +
                       ' <i class="fa-solid fa-location-dot">' + '</i>' + 'ตำแหน่งปัจจุบัน' +
                    '</a>' +
                '</div>' ;

                show_btn_address.innerHTML = html;

    }

</script>

<script>
    function locations_current(){
        document.getElementById("map_select_location").innerHTML = "";
        document.getElementById("map_select_location_from_address").innerHTML = "";
        //add
        document.querySelector('#map_select_location_from_address').classList.add('d-none');
        document.querySelector('#div_province').classList.add('d-none');
        document.querySelector('#div_amphoe').classList.add('d-none');
        document.querySelector('#div_tambon').classList.add('d-none');
        document.querySelector('#div_address_detail').classList.add('d-none');

        document.querySelector('#btn_change_address').classList.add('d-none');
        document.querySelector('#btn_cancel_change_add').classList.add('d-none');
        document.querySelector('#btn_confirm_address').classList.add('d-none');
        //remove
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


