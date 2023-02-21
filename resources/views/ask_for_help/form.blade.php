
<style>
    #map_google_ask_for_help {
        height: calc(40vh);

        background-color: #3490dc;
    }
    #map_sos {
        height: calc(40vh);

        background-color: #80bbeb;
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
                <div class="d-none" id="map_google_ask_for_help"></div>
                <div class="d-" id="map_sos"></div>
            </div>
        </div>
    </div>
    <div id="location_users">

    </div>

    <div class="justify-content-center">
        <div class="column">
            <div class="col-12 mb-2">
                <span id="sos_by_btn" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " data-toggle="modal" data-target="#modal_sos_btn_user"
                style="background-color: #3490dc; font-size: 20px; color: white;" onclick="SOS_by_Btn( {{Auth::user()->id}} )">
                    <i class="fa-solid fa-truck-medical"></i> ขอความช่วยเหลือ
                </span>
            </div>
            <div class="col-12 mb-2">
                {{-- <input id="input_user_id" value="{{Auth::user()->id}}" class="d-none"> --}}
                <span id="sos_by_phone" name="sos_by_phone" class="btn btn-primary main-shadow main-radius " onclick="SOS_by_Phone( {{Auth::user()->id}} )" >
                    <i class="fa-solid fa-phone"></i> โทรฉุกเฉิน
                </span>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_sos_btn_user">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modal_sos_btn_user" tabindex="-1" role="dialog" aria-labelledby="modal_sos_btn_userTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal_sos_btn_userTitle">ยืนยันข้อมูล</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-12 col-md-4 p-1 ">
                        <a href="#heading" class="btn btn-primary btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="locations_myhome();">
                            <i class="fa-solid fa-house-user"></i> บ้านของฉัน
                        </a>
                    </div>
                    <div class="col-12 col-md-4 p-1 ">
                        <a href="#heading" class="btn btn-success btn-md float-end kanit btn-block text-white" width="100%" style="width:100%;border-radius: 20px;" onclick="">
                            <i class="fa-solid fa-house-user"></i> ตำแหน่งปัจจุบัน
                        </a>
                    </div>
                </div>
                <div class="row d-flex justify-content-around">
                    <!-- province -->
                      <div class="form-group col-lg-4 col-12 p-1 m-0">
                        <label for="address" class="control-label">{{ 'จังหวัด' }}</label>
                        <select name="select_province" id="select_province" class="input-provice form-control kanit" onchange="select_A();" required>
                            <option value="" selected>- เลือกจังหวัด -</option>
                        </select>
                        <input type="text" name="input_province" id="input_province" class=" input-provice form-control d-none" readonly>
                    </div>
                    <!-- amphoe -->
                    <div class="form-group col-lg-4 col-12 p-1 m-0">
                        <label for="address" class="control-label">{{ 'อำเภอ' }}</label>
                        <select name="select_amphoe" id="select_amphoe" class="form-control kanit input-provice " onchange="select_T();" required>
                            <option value="" selected>- เลือกอำเภอ -</option>
                        </select>
                        <input type="text" name="input_amphoe" id="input_amphoe" class="input-provice form-control d-none" readonly>
                    </div>
                    <!-- tambon -->
                    <div class="form-group col-lg-4 col-12 p-1 m-0">
                        <label for="address" class="control-label">{{ 'ตำบล' }}</label>
                        <select name="select_tambon" id="select_tambon" class="form-control kanit input-provice " onchange="select_lat_lng();" required>
                            <option value="" selected>- เลือกตำบล -</option>
                        </select>
                        <input type="text" name="input_tambon" id="input_tambon" class="input-provice form-control d-none" readonly>
                    </div>
                      <!-- address detail -->
                    <div id="div_address_detail" class=" form-group col-12 col-md-4">
                        <label for="address" class="control-label">{{ 'รายละเอียดที่อยู่' }}</label>
                        <input class="form-control" name="input_address" type="text" id="input_address" value="" required>
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                    </div>
                    <!-- lat,lng -->
                      <div id="div_latlng" class="d-none form-group col-12 col-md-4">
                        <label for="lng" class="control-label">{{ 'lat,lng' }}</label>
                        <input class="form-control" name="latlng" type="text" id="latlng" value="" readonly>
                        {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
                    </div>
                      <!-- phone -->
                    <div id="div_phone" class=" form-group col-12 col-md-4">
                        <label for="phone" class="control-label">{{ 'เบอร์โทรศัพท์' }}</label>
                        <input class="form-control" name="input_phone" type="text" id="input_phone" value="" required>
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>

                     <!-- lat -->
                    <input class="form-control d-none" name="lat" type="text" id="lat" value="" readonly>
                     <!-- lng -->
                    <input class="form-control d-none" name="lng" type="text" id="lng" value="" readonly>

                </div><!--/.row -->

            </div>
            <div class="modal-footer">
                <div class="row d-flex justify-content-between">
                    <a href="#heading" class="col-6 btn btn__secondary btn-md  kanit btn-block text-white" width="100%"
                    style="width:100%;border-radius: 20px;" onclick="">
                        <i class="fa-solid fa-house-user"></i> ยืนยัน
                    </a>
                    <a href="#heading" class="col-6 mt-0 btn btn-info btn-md  kanit btn-block text-white" width="100%"
                    style="width:100%;border-radius: 20px;" onclick="update_add_to_user();">
                        <i class="fa-solid fa-house-user"></i> แก้ไขข้อมูล
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>


<!--=============================================================================================================
                            JAVASCRIPT JAVASCRIPT JAVASCRIPT JAVASCRIPT JAVASCRIPT
===============================================================================================================-->

<script src="{{ asset('js/map_location.js')}}"></script>

<script>

    document.addEventListener('DOMContentLoaded', (event) => {
            initMap();

            select_province();

            // check_lat_lng();

    });

</script>

<script>
    function check_lat_lng(){
            var user_id = '{{Auth::user()->id}}';
            var lat = '{{Auth::user()->lat}}';
            //  console.log(user_id);

            // console.log( "NOT lat lng");
            if(lat){

            }else{
                fetch("{{ url('/') }}/api/ask_user_info" + "/" + user_id)
                .then(response => response.json())
                .then(result => {
                    // console.log(result['full_name']);
                    // result_area = result ;
                    getLocation();

                    // if (typeof result_area !== "undefined") {
                    //     // console.log(result_area)
                    //     getLocation();
                    // }
                });
            }


    }
</script>

<script>

    function SOS_by_Btn(user_id){

        let div_btn_sos_btn = document.querySelector('#sos_by_btn').classList;
        div_btn_sos_btn.add('btn-dark');
        div_btn_sos_btn.remove('btn-primary');
        // div_btn_sos_btn.add('d-none');
        div_btn_sos_btn.disable = true;
        // console.log(result);

        // let url = "{{ url('/api/sos_btn') }}?user_id=" + user_id;
        // console.log(url);
        // fetch(url)
        //     .then(response => response.json())
        //     .then(result => {

        //     });

    }

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

<script>
    var map;

    function initMap() {
        // 13.7248936,100.4930264 lat lng ประเทศไทย
        map = new google.maps.Map(document.getElementById("map_google_ask_for_help"), {
            center: {lat: 13.7248936, lng: 100.4930264 },
            zoom: 6,
        });

        // window.initMap = initMap;



}
</script>

<script>
    var map_sos;
    var marker_user;

    function Open_map_sos() {
        // 13.7248936,100.4930264 lat lng ประเทศไทย
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        console.log(lat);
        console.log(lng);

        map_sos = new google.maps.Map(document.getElementById("map_sos"), {
            center: {lat: lat, lng: lng },
            zoom: 6,
        });

        if (marker_user) {
            marker_user.setMap(null);
        }
        marker_user = new google.maps.Marker({
            position: {lat: lat , lng: lng },
            map: map_sos,
            // icon: image,
        });


        // window.initMap = initMap;

}
</script>


  <!--==========================================
                Script   ที่อยู่
  ============================================-->

<script>
    function locations_myhome() {

        document.querySelector('#select_province').classList.add('d-none');
        document.querySelector('#select_amphoe').classList.add('d-none');
        document.querySelector('#select_tambon').classList.add('d-none');

        document.querySelector('#input_province').classList.remove('d-none');
        document.querySelector('#input_amphoe').classList.remove('d-none');
        document.querySelector('#input_tambon').classList.remove('d-none');

        document.querySelector('#div_address_detail').classList.remove('d-none');
        document.querySelector('#div_phone').classList.remove('d-none');
        // document.querySelector('#div_latlng').classList.remove('d-none');

        let select_province = document.querySelector('#select_province');
        let select_amphoe = document.querySelector('#select_amphoe');
        let select_tambon = document.querySelector('#select_tambon');


        select_province.value = "";
        select_amphoe.value = "";
        select_tambon.value = "";

        select_province.required = "";
        select_amphoe.required = "";
        select_tambon.required = "";


        let input_province = document.querySelector('#input_province');
        let input_amphoe = document.querySelector('#input_amphoe');
        let input_tambon = document.querySelector('#input_tambon');
        let input_address = document.querySelector('#input_address');
        let input_phone = document.querySelector('#input_phone');

        let lat_user = "{{ Auth::user()->lat }}";
        let lng_user = "{{ Auth::user()->lng }}";

        document.querySelector('#lat').value = lat_user;
        document.querySelector('#lng').value = lng_user;
        document.querySelector('#latlng').value = lat_user + ',' + lng_user;

        input_province.value = "{{ Auth::user()->province }}";
        input_amphoe.value = "{{ Auth::user()->district }}";
        input_tambon.value = "{{ Auth::user()->sub_district }}";
        input_address.value = "{{ Auth::user()->address }}";
        input_phone.value = "{{ Auth::user()->phone }}";

        if(lat_user && lng_user){
            console.log("if")
            Open_map_sos();
        }else{
            console.log("else")
            getLocation_SOS();
        }

        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);
        // console.log(input_province.value);

        // select_lat_lng();

    }
    function getLocation_SOS() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition_SOS);
        // navigator.geolocation.getCurrentPosition(geocodeLatLng);
    } else {
        // x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition_SOS(position) {
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        lat_text.value = position.coords.latitude ;
        lng_text.value = position.coords.longitude ;
        latlng.value = position.coords.latitude+","+position.coords.longitude ;

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        Open_map_sos();
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

        fetch("{{ url('/') }}/api/select_province/")
            .then(response => response.json())
            .then(result => {
                // console.log(result);

                select_province.innerHTML = "";
                console.log(select_province);
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

    }

    function update_add_to_user(){
        let check_data = document.querySelector('#select_province').value;
        if(check_data){
            let province = document.querySelector('#select_province').value;
            let district = document.querySelector('#select_amphoe').value;
            let sub_district = document.querySelector('#select_tambon').value;
        }else{
            let province = document.querySelector('#input_province').value;
            let district = document.querySelector('#input_amphoe').value;
            let sub_district = document.querySelector('#input_tambon').value;
        }

        let address = document.querySelector('#input_address');
        let lat = document.querySelector('#lat').value;
        let lng = document.querySelector('#lng').value;
        let phone = document.querySelector('#input_phone').value;

        alert('ได้รับแล้ว'+ province + district + sub_district + address.value + phone);

        let url = "{{ url('/api/update_info_sos') }}?province=" + province + "&district=" + district + "&sub_district=" + sub_district +
        "&address=" + address + "&lat=" + lat + "&lng=" + lng + "&phone=" + phone;
        // console.log(url);
        fetch(url)
            .then(response => response.json())
            .then(result => {

            });
    }

    // function select_lat_lng() {
    //     // document.querySelector('#select-area').classList.add('d-none');
    //     // document.querySelector('#div_form').classList.add('wow');
    //     // document.querySelector('#div_form').classList.add('fadeInDown');

    //     // setTimeout(function() {
    //     //     document.querySelector('#div_form').classList.remove('d-none');
    //     // }, 1000);

    //     let select_province = document.querySelector('#select_province');

    //     if (select_province.value) {
    //         let select_amphoe = document.querySelector('#select_amphoe');
    //         let select_tambon = document.querySelector('#select_tambon');

    //         fetch("{{ url('/') }}/api/select_lat_lng" + "/" + select_province.value + "/" + select_amphoe.value + "/" + select_tambon.value)
    //             .then(response => response.json())
    //             .then(result => {
    //                 // console.log(result + "if");

    //                 let lat = document.querySelector('#lat');
    //                 lat.value = result[0]['lat'];

    //                 let lng = document.querySelector('#lng');
    //                 lng.value = result[0]['lng'];

    //                 document.querySelector('#map_google_ask_for_help').classList.remove('d-none');
    //                 initMap();

    //             });
    //     } else {
    //         let input_province = document.querySelector('#input_province');
    //         let input_amphoe = document.querySelector('#input_amphoe');
    //         let input_tambon = document.querySelector('#input_tambon');

    //         fetch("{{ url('/') }}/api/select_lat_lng" + "/" + input_province.value + "/" + input_amphoe.value + "/" + input_tambon.value)
    //             .then(response => response.json())
    //             .then(result => {
    //                 // console.log(result + "else");

    //                 let lat = document.querySelector('#lat');
    //                 lat.value = result[0]['lat'];

    //                 let lng = document.querySelector('#lng');
    //                 lng.value = result[0]['lng'];

    //                 document.querySelector('#map_google_ask_for_help').classList.remove('d-none');
    //                 initMap();

    //             });
    //     }


    // }



</script>




