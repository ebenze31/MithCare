@extends('layouts.mithcare_footer')

@section('content')

<style>
    .container {
        /* display: flex;
        flex-direction: column;
        height: 100%;
        overflow: hidden; */
    }
    .bg_div{
        background-color: gray;
    }
    .toggleCameraButton{
        border-radius: 50%;
        width: 60px !important;
        height: 60px !important;
        border: 1px solid black;
        background-color: rgba(0,0,0,0.6);
        color: #ffffff;
    }
    .toggleMicrophoneButton{
        border-radius: 50%;
        width: 60px !important;
        height: 60px !important;
        border: 1px solid black;
        background-color: rgba(0,0,0,0.6);
        color: #ffffff;
    }
    .background-Red{
        background-color: #db2d2e !important;
    }
    .progressMithcare {
      width: 200px;
      background-color: #f2f2f2;
      height: 20px;
    }
    .progress-barMithcare {
      width: 0%;
      height: 100%;
      background-color: #4caf50;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-button {
        background-color: #f1f1f1;
        color: #333;
        padding: 8px;
        border: none;
        cursor: pointer;
        height: 40px;
        width: 200px;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }
    .widthProgress{
        width: 3% !important;
        background-color: #4caf50;
        height: 100% !important;
    }
    /*============================
            Class Computer
    =============================*/

    @media screen and (min-width: 1024px)  {
        .imgdiv{  /*รูปโปรไฟล์ local*/
            border: 1px solid black;
            border-radius: 50% !important;
            width: 5rem !important;
            height: 5rem !important;
            margin-right: 1rem;
        }
        .br_header{
            display: inline-flex;
            height: 10%;
            margin-top: 1rem;
            margin-left: 1rem;
            padding: 1rem;
        }
        .br_section{
            display: flex;
            justify-content: center;
            height: 60%;
            margin-top: 0.5rem;
            padding: 1rem;
        }
        .br_section div video{
            /* height: 30% !important; */
            /* width: 100% !important; */
        }
        .logo_mithcare{
            border-radius: 50% !important;
            width: 100px;
            height: 100px;
        }
        .logo_mithcare img{
            border-radius: 50% !important;
            width: 80px;
            height: 80px;
        }
        .itemPeople{
            border-radius: 50% !important;
            width: 50px;
            height: 50px;
        }
        #TestBubble span{
            font-size: 40px;
        }
        #videoDiv{
            width: 100% !important;
            height: 24rem !important;
            border: 1px solid black;
            object-fit: cover;
            transform: scaleX(-1) !important;
        }
        .buttonDiv{
            position: absolute;
            left: 40%;
            bottom: 1rem;
            transform: translate(-40%,);
        }
    }

    /*============================
            Class Tablet
    =============================*/

    @media screen and (min-width: 768px) and (max-width: 1023px) {
        .imgdiv{  /*รูปโปรไฟล์ local*/
            border: 1px solid black;
            border-radius: 50% !important;
            width: 5rem !important;
            height: 5rem !important;
            margin-right: 1rem;
        }
        .br_header{
            display: inline-flex;
            height: 20%;
            margin-top: 1rem;
            margin-left: 1rem;
            padding: 1rem;
        }
        .br_section{
            height: 80%;
            margin-top: .5rem;
            padding: 1rem;

        }
        .br_section div video{
            height: 400px;
            width: 100% !important;
        }
        .logo_mithcare{
            border-radius: 50% !important;
            width: 100px;
            height: 100px;
        }
        .logo_mithcare img{
            border-radius: 50% !important;
            width: 80px;
            height: 80px;
        }
        .itemPeople{
            border-radius: 50% !important;
            width: 4rem;
            height: 4rem;
        }
        #TestBubble span{
            font-size: 30px;
        }
        #videoDiv{  /*กรอบรูปโปรไฟล์ local*/
            width: 100% !important;
            height: 24rem !important;
            border: 1px solid black;
            object-fit: cover;
            /* transform: scaleX(-1) !important; */
        }
        .buttonDiv{
            position: absolute;
            left: 50%;
            bottom: 1rem;
            transform: translate(-50%);
        }
    }

    /*============================
            Class mobile
    =============================*/
    @media screen and (max-width: 768px) {
        .mobile_d_none{ /* d-none แค่ mobile*/
            display: none !important;
        }
        .imgdiv{  /*รูปโปรไฟล์ local*/
            border: 1px solid black;
            border-radius: 50% !important;
            width: 3rem;
            height: 3rem;
            margin-right: 1rem;
        }
        .br_section{
            display: flex;
            justify-content: center;
            height: 80%;
            margin-top: 0.5rem;
            padding: 1rem;
        }
        .br_section div video{
            height: 400px;
            width: 100% !important;
        }
        .br_header{
            display: flex;
            justify-content: center;
            height: 20%;
            margin: 0.5rem;
            padding: 1rem;
        }
        .logo_mithcare img{
            border-radius: 50% !important;
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
        .itemPeople{
            border-radius: 50% !important;
            width: 3rem;
            height: 3rem;
        }
        #TestBubble span{
            font-size: 25px;
        }
        #members_in_room{
            font-size: 1rem;
            margin-top: 1rem;
        }
        #videoDiv{  /*กรอบรูปโปรไฟล์ local*/
            width: 100% !important;
            height: 22rem !important;
            border: 1px solid black;
            object-fit: cover;
            /* transform: scaleX(-1) !important; */
        }
        .buttonDiv{
            position: absolute;
            left: 45%;
            bottom: 1rem;
            transform: translate(-45%);
        }

    }

</style>

    <div class="container">
        <div id='br_header' class="row br_header">
            <div>
                <img class="imgdiv" src="{{ url('storage/'.$user_DB->photo )}}">
            </div>
            <div id="TestBubble" class="d-flex align-items-center">
                <span>ห้องสนทนาของ {{$user_DB->name}}</span>
            </div>
        </div>
        <div id='br_section' class="row br_section">
            <div class="col-sm-12 col-md-8 col-lg-8 d-flex justify-content-center ">
                <video id="videoDiv" autoplay></video>
                <div class="buttonDiv d-flex align-items-center">
                    <button id="toggleCameraButton" class="toggleCameraButton mr-3"></button>
                    <button id="toggleMicrophoneButton" class="toggleMicrophoneButton"></button>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 row d-flex align-items-center">
                <span class="col-12 d-flex justify-content-center align-items-center logo_mithcare mt-2 mobile_d_none" ><img src="{{ url('/img/logo_mithcare/x-icon.png') }}">&nbsp;MithCare</span>
                <span id="timeStart" class="col-12 d-flex justify-content-center mt-2" style="font-size: 1rem;"></span>
                <div id="members_in_room" class="col-12 d-flex justify-content-center align-items-center" ></div>

                <a id="btnJoinRoom" href="{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack=open&audioTrack=open" class="col-12 btn btn-info mt-2" style="font-size: 1rem;">เข้าร่วมห้องสนทนา</a>
            </div>
        </div>
        <div class="col-8 d-flex justify-content-between mobile_d_none">
            <div class="dropdown col-4">
                <button class="dropdown-button">ไมโครโฟน</button>
                <div class="dropdown-content">
                    <!-- เนื้อหาใน dropdown -->
                    <a href="#">ไมค์ 1</a>
                    <a href="#">ไมค์ 2</a>
                    <hr>
                    <div class="progressMithcare">
                        <div id="progressMithCare" class="progress-barMithcare " role="progressbar"></div>
                        <div class="d-flex justify-content-around ">
                            <button id="start-button" class="btn-old btn-info " onclick="CheckStatusMicrophone();">StartTest</button>
                            <button id="stop-button" class="btn-old btn-info " onclick="stopListening();">EndTest</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown col-4">
                <button class="dropdown-button">กล้อง</button>
                <div class="dropdown-content">
                    <!-- เนื้อหาใน dropdown -->
                    <a href="#">กล้อง 1</a>
                    <hr>

                </div>
            </div>
            <div class="dropdown col-4">
                <button class="dropdown-button">ลำโพง</button>
                <div class="dropdown-content">
                    <!-- เนื้อหาใน dropdown -->
                    <a href="#">ลำโพง 1</a>
                    <hr>

                </div>
            </div>
        </div>
    </div>


    <!--เรียกใช้ axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const room_id = '{{$room_id}}';
        const user_id = '{{$user_id}}';
        const urlStatsVideo = "{{ url('/') }}/api/getStatRoom?room_id=" + room_id + "&room_of_members=" + user_id;
            axios.get(urlStatsVideo).then((response) => {
                console.log(response['data']);
                setInterval(() => {
                    var timeCountVideo = document.getElementById("timeStart");
                    // วันที่และเวลาปัจจุบัน
                    var currentDate = new Date();
                    var currentTime = currentDate.getTime();

                    // วันที่และเวลาที่กำหนด
                    var targetDate = new Date(response['data']['time_start']);
                    var targetTime = targetDate.getTime();

                    // คำนวณเวลาที่ผ่านไปในมิลลิวินาที
                    var elapsedTime = currentTime - targetTime;
                    var elapsedMinutes = Math.floor(elapsedTime / (1000 * 60));

                    // แปลงเวลาที่ผ่านไปให้เป็นรูปแบบชั่วโมง:นาที:วินาที
                    var hours = Math.floor(elapsedMinutes / 60);
                    var minutes = elapsedMinutes % 60;
                    var seconds = Math.floor((elapsedTime / 1000) % 60);

                    let showTimeCountVideo;
                    // แสดงผลลัพธ์
                    if (hours > 0) {
                        showTimeCountVideo = hours + ':' + minutes + ':' + seconds + "&nbsp;/ 10 นาที";
                    } else {
                        showTimeCountVideo = minutes + ':' + seconds + "&nbsp;/ 10 นาที";
                    }

                    if(response['data']['time_start'] == null){
                        timeCountVideo.innerHTML = '<i class="fa-regular fa-clock fa-fade" style="color: #11b06b; font-size: 30px;"></i>&nbsp;' + "--:-- ";
                    }else{
                        timeCountVideo.innerHTML = '<i class="fa-regular fa-clock fa-fade" style="color: #11b06b; font-size: 30px;"></i>&nbsp;' + ": " + showTimeCountVideo;
                    }


                }, 1000);
            })
            .catch((error) => {
                console.log("ERROR HERE");
                console.log(error);
            });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var CameraRetries = 0; // ตัวแปรเก็บจำนวนครั้งที่เรียกใช้งานกล้อง
        var MicrophoneRetries = 0; // ตัวแปรเก็บจำนวนครั้งที่เรียกใช้งานไมค์
        //======================
        // เปิดกล้องตอนโหลดหน้านี้
        //======================
        function openCamera() {

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // รองรับการเข้าถึงกล้อง
                // var constraints = { video: { facingMode: 'user' } }; // เพิ่มออปชัน facingMode เพื่อเลือกกล้องหน้า
                var constraints = { video: { facingMode: 'environment' } }; // เพิ่มออปชัน facingMode เพื่อเลือกกล้องหน้า
                navigator.mediaDevices.getUserMedia(constraints)
                .then(function(videoStream) {
                    // ได้รับสตรีมวิดีโอสำเร็จ
                    document.querySelector('#toggleCameraButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-camera"></i>'
                    var videoElement = document.getElementById('videoDiv');
                    videoElement.srcObject = videoStream;
                    console.log(typeof videoStream);
                    console.log(videoStream);
                })
                .catch(function(error) {
                    // ไม่สามารถเข้าถึงกล้องได้ หรือผู้ใช้ไม่อนุญาต
                    console.error('เกิดข้อผิดพลาดในการเข้าถึงกล้อง:', error);
                    CameraRetries++;

                    if(CameraRetries < 7){
                        setTimeout(openCamera, 1000);
                    }

                });
            } else {
                console.log('ไม่สนับสนุนการเข้าถึงกล้องในเบราว์เซอร์นี้');
            }
        }
        openCamera(); //เรียกฟังก์ชันเปิดกล้อง
        //======================
        // เปิดไมค์ตอนโหลดหน้านี้
        //======================

        // เพิ่มส่วนนี้เพื่อเรียกใช้ getUserMedia สำหรับไมโครโฟน
        function openMicrophone() {

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ audio: true })
                .then(function(newAudioStream) {
                    audioStream = newAudioStream;
                    document.querySelector('#toggleMicrophoneButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-microphone"></i>'
                    console.log('เปิดสตรีมไมโครโฟน');
                    console.log(audioStream);
                })
                .catch(function(error) {
                    console.error('เกิดข้อผิดพลาดในการเข้าถึงไมโครโฟน:', error);
                    MicrophoneRetries++;
                    //เรียกฟังก์ชันเปิดไมค์ใหม่ 5 ครั้ง
                    if(MicrophoneRetries < 5) {
                        setTimeout(openMicrophone, 500);
                    }
                });
            }
        }
        openMicrophone(); //เรียกฟังก์ชันเปิดไมค์

        // navigator.mediaDevices.enumerateDevices()
        // .then(function(devices) {
        //     var microphones = devices.filter(function(device) {
        //     return device.kind === 'audioinput';
        //     });
        //     console.log('จำนวนไมโครโฟนที่พบ:', microphones.length);
        //     console.log(microphones);
        // })
        // .catch(function(error) {
        //     console.error('เกิดข้อผิดพลาดในการตรวจสอบอุปกรณ์:', error);
        // });

    });


    </script>

    <script>
        //======================
        //   เปิด - ปิด กล้อง
        //======================
        var toggleCameraButton = document.getElementById('toggleCameraButton');
            toggleCameraButton.addEventListener('click', toggleCamera);

        var statusCamera = "open";
        var statusMicrophone = "open";

        function toggleCamera() {
            if (statusCamera == "open") {
                statusCamera = "close"; //เซ็ต statusCamera เป็น close
                document.querySelector('#btnJoinRoom').setAttribute('href',"{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack="+statusCamera+"&audioTrack="+statusMicrophone);
                // ตรวจสอบว่ากล้องถูกเปิดหรือไม่
                navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(videoStream) {

                    // ปิดกล้อง
                    var videoElement = document.getElementById('videoDiv');
                    var stramVideo = videoElement.srcObject;
                    var videoTracks = stramVideo.getVideoTracks();

                    // console.log(videoTracks);

                    videoTracks[0].stop();
                    document.querySelector('#toggleCameraButton').classList.add('background-Red');
                    document.querySelector('#toggleCameraButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-camera-slash"></i>'
                    // console.log('ปิดกล้อง');
                })

            }else{
                statusCamera = "open"; // เซ็ต statusCamera เป็น open
                document.querySelector('#btnJoinRoom').setAttribute('href',"{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack="+statusCamera+"&audioTrack="+statusMicrophone);
                // เปิดกล้อง
                navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(newVideoStream) {
                    // ได้รับสตรีมวิดีโอใหม่สำเร็จ
                    videoStream = newVideoStream;
                    var videoElement = document.getElementById('videoDiv');
                    videoElement.srcObject = videoStream;
                    document.querySelector('#toggleCameraButton').classList.remove('background-Red');
                    document.querySelector('#toggleCameraButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-camera"></i>'
                    // console.log('เปิดกล้อง');

                    // console.log(videoStream);
                })
                .catch(function(error) {
                    // ไม่สามารถเข้าถึงกล้องได้ หรือผู้ใช้ไม่อนุญาต
                    console.error('เกิดข้อผิดพลาดในการเข้าถึงกล้อง:', error);
                });
            }
            setTimeout(() => {
                console.log(statusCamera);


            }, 1000);

        }

    </script>

    <script>
        //======================
        //   เปิด - ปิด ไมโครโฟน
        //======================
        var toggleMicrophoneButton = document.getElementById('toggleMicrophoneButton');
        toggleMicrophoneButton.addEventListener('click', toggleMicrophone);

        function toggleMicrophone() {
            if (statusMicrophone == 'open') {
                statusMicrophone = "close"; // เซ็ต statusMicrophone เป็น close
                document.querySelector('#btnJoinRoom').setAttribute('href',"{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack="+statusCamera+"&audioTrack="+statusMicrophone);
                navigator.mediaDevices.getUserMedia({ audio: true })
                .then(function(audioStream) {

                    // ปิดไมค์
                    let audioTracks = audioStream.getAudioTracks();
                    console.log("audioStream");
                    console.log(audioStream);

                    audioTracks[0].stop();
                    document.querySelector('#toggleMicrophoneButton').classList.add('background-Red');
                    document.querySelector('#toggleMicrophoneButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-microphone-slash"></i>'
                    // console.log('ปิดไมค์');

                })
            }else{
                statusMicrophone = "open"; // เซ็ต statusMicrophone เป็น open
                document.querySelector('#btnJoinRoom').setAttribute('href',"{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack="+statusCamera+"&audioTrack="+statusMicrophone);
                navigator.mediaDevices.getUserMedia({ audio: true })
                .then(function(newAudioStream) {
                    audioStream = newAudioStream;
                    document.querySelector('#toggleMicrophoneButton').classList.remove('background-Red');
                    document.querySelector('#toggleMicrophoneButton').innerHTML = '<i style="font-size: 25px;" class="fa-regular fa-microphone"></i>'
                    // console.log('เปิดสตรีมไมโครโฟน');
                    console.log(audioStream);
                })
                .catch(function(error) {
                    console.error('เกิดข้อผิดพลาดในการเข้าถึงไมโครโฟน:', error);
                });
            }
            setTimeout(() => {
                console.log(statusMicrophone);
                document.querySelector('#btnJoinRoom').setAttribute('href',"{{ url('/room_call'. '/' . $room_id . '/' . $user_id ) }}?videoTrack="+statusCamera+"&audioTrack="+statusMicrophone);
            }, 1000);
        }



    </script>

<script>
    let isListening = false;
    let mediaStream;
    function CheckStatusMicrophone(){
        if(statusMicrophone == "open"){
            startListening();

        }
    }

    function startListening() {
        // สร้างออบเจ็กต์สำหรับเข้าถึงไมค์
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const analyser = audioContext.createAnalyser();

        // กำหนดค่าตัวเลขความถี่และความถี่สุดท้าย
        const minDecibels = -90;
        const maxDecibels = -10;
        analyser.minDecibels = minDecibels;
        analyser.maxDecibels = maxDecibels;

        // เริ่มต้นการแสดงผลด้วย requestAnimationFrame
        function updateProgressBar() {
            const dataArray = new Uint8Array(analyser.frequencyBinCount);
            analyser.getByteFrequencyData(dataArray);

            // คำนวณค่าเฉลี่ยของความดังจากข้อมูลที่ได้รับ
            let averageDecibels = 0;
            for (let i = 0; i < dataArray.length; i++) {
            averageDecibels += dataArray[i];
            }
            averageDecibels /= dataArray.length;

            // แปลงค่าเฉลี่ยของความดังเป็นเปอร์เซ็นต์สำหรับ progress bar
            const progressPercentage = mapRange(averageDecibels, minDecibels, maxDecibels, 0, 50);
            document.getElementById("progressMithCare").style.width = `${progressPercentage}%`;
            // console.log(progressPercentage);
            // เรียกใช้ฟังก์ชันอีกครั้งเพื่ออัปเดต progress bar
            requestAnimationFrame(updateProgressBar);
        }

        // เริ่มต้นการอัปเดต progress bar
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                mediaStream = stream;
                const microphone = audioContext.createMediaStreamSource(stream);
                microphone.connect(analyser);
                isListening = true;
                updateProgressBar();
                document.getElementById("start-button").disabled = true;
                document.getElementById("stop-button").disabled = false;
                document.getElementById("progressMithCare").setAttribute('class','progress-barMithcare');
            })
            .catch(error => {
                console.error("ไม่สามารถเข้าถึงไมค์ได้:", error);
            });
    }

    function stopListening() {
        if (!isListening) {
            return;
        }else{
            mediaStream.getTracks().forEach(track => {
                track.stop();
            });
            isListening = false;
            document.getElementById("start-button").disabled = false;
            document.getElementById("stop-button").disabled = true;
            document.getElementById("progressMithCare").style.width = `0%`;
            document.getElementById("progressMithCare").setAttribute('class','widthProgress');
        }

    }

    // ฟังก์ชันสำหรับแปลงค่าในช่วงเดิมให้เป็นค่าในช่วงใหม่
    function mapRange(value, min1, max1, min2, max2) {
        return min2 + ((value - min1) * (max2 - min2)) / (max1 - min1);
    }

</script>

@if (!empty($RoomData))
    <script>
        const members_in_room = '{{$RoomData->members_in_room}}'; // สตริงที่ต้องการแยก
        console.log("members_in_room");
        console.log(members_in_room);
        const memberInRoomDiv = document.querySelector('#members_in_room');

        // แยกสตริงด้วยตัวคั่น ','
        const membersArray = members_in_room.split(',');
        console.log("membersArray");
        console.log(membersArray);
        // วนลูปในอาร์เรย์และแสดงค่าที่ได้

        if(members_in_room !== null){
            console.log("เข้า มาทำงานนะ")
            membersArray.forEach((member) => {
            const url_getMember_form_id = "{{ url('/') }}/api/getMember_form_id?user_id=" + member;
                    axios.get(url_getMember_form_id).then((response) => {
                            // console.log(response['data']);
                            let Member_form_Id = response['data'];
                            console.log("Member_form_Id");

                            if(Member_form_Id){
                                const memberDiv = document.createElement('div');
                                    memberDiv.setAttribute('id',Member_form_Id['id']);
                                const memberImg = document.createElement('img');
                                    memberImg.setAttribute('class','itemPeople');
                                    memberImg.src = "{{ url('storage')}}"+ "/" + Member_form_Id['photo'];

                                    memberDiv.appendChild(memberImg);
                                    memberInRoomDiv.appendChild(memberDiv);
                            }
                        })
                        .catch((error) => {
                            console.log("ERROR HERE");
                            console.log(error);
                        });

            });
        }

    </script>
@endif


<script>
    function alertNoti(Icon, Detail) {
       const alertElement = document.querySelector('.containerAlert');
       const iconElement = document.querySelector('#iconAlert');
       const detailElement = document.querySelector('#detailAlert');

       if (alertElement) {
         alertElement.classList.remove('scaleUpDown');
         alertElement.remove();
       }

       const newAlertElement = document.createElement('div');
       newAlertElement.classList.add('containerAlert');
       newAlertElement.classList.add('scaleUpDown');

       newAlertElement.classList.add('scaleUpDown');

       const alertStatus = document.createElement('span');
       alertStatus.classList.add('alertStatus');


       const newIconElement = document.createElement('span');
       newIconElement.id = 'iconAlert';
       newIconElement.innerHTML = Icon;

       const newDetailElement = document.createElement('span');
       newDetailElement.id = 'detailAlert';
       newDetailElement.innerHTML = Detail;

       alertStatus.appendChild(newIconElement);
       alertStatus.appendChild(newDetailElement);

       newAlertElement.appendChild(alertStatus);

       document.body.appendChild(newAlertElement);

     }
   </script>

@endsection


