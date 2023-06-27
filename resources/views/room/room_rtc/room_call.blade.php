@extends('layouts.mithcare_outbar')

@section('content')

    <link href="{{ asset('mithcare/css/for_video_call.css') }}" rel="stylesheet">
    <link href="{{ asset('mithcare/css/animation_for_videoCall.css') }}" rel="stylesheet">
    <!-- สำหรับ bubble message -->
    <div class="containerAlert ">
        <div class="alertStatus">
            <span id="iconAlert"></span>
            <span id="detailAlert"></span>
        </div>
    </div>
    <!-- สำหรับ loading ก่อนเข้า videocall -->
    <div id="loadingAnime" class="preloader d-none">
        <div class="loading"><span></span><span></span><span></span><span></span></div>
    </div>

    <div class="video-container">
        <div id='MainVideoDiv' class="MainVideoDiv">
            <div id='localVideoMain' class="localPlayerVideoCall"></div>
            {{-- <div id="Screen{{ $user_id }}" class="ShareScreenVideoCall d-none"></div> --}}
            <div id='remoteVideoMain' class="remotePlayerVideoCall d-none"></div>
        </div>
        <div id='ButtonDiv' class="ButtonDiv">
            {{-- <button class="btn btn-secondary" id="btn_switchCamera" onclick="switchCamera();">
                        <i class="fa-solid fa-camera-rotate"></i>
            </button> --}}
            <div id="timeCountVideo" class="clockDuration mobile_d_none"></div>
        </div>
    </div>

    <div id='app'></div>
    <button class="btn btn-primary d-none" type="button" id="join">เข้าร่วม</button>

        <!-- Button trigger modal -->
        <button id="modalToStart" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#staticBackdrop">
            Modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ยินดีต้อนรับ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="LoadVideoData();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                -------------------------------------------------------
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div> --}}
            </div>
            </div>
        </div>

    <!--เรียกใช้ axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('Agora_Web_SDK_FULL/AgoraRTC_N-4.17.0.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        var options;
        var appId = '{{ env('AGORA_APP_ID') }}';
        var appCertificate = '{{ env('AGORA_APP_CERTIFICATE') }}';

        const homeId = '{{ $room_id }}';
        const user_id_from_room = '{{ $user_id }}';
        const localUser_id = '{{ Auth::user()->id }}';
        //const channelName = "MithCare" + homeId + user_id_from_room;
        const channelName = "MithCare";

        options = {
                    // Pass your App ID here.
                    appId: appId,

                    appCertificate: appCertificate,

                    // Set the channel name.
                    channel: channelName,

                    uid: '{{ Auth::user()->id }}',

                    // uname: '{{ Auth::user()->name }}',

                    token: "",
                };

        let appIdLength = options.appId.length;
        let appCertLength = options.appCertificate.length;
        console.log(appIdLength);
        console.log(appCertLength);

        if(appIdLength < 32){
            options.appId = '{{ env('AGORA_APP_ID') }}';
        }
        if(appCertLength < 32){
            options.appCertificate = '{{ env('AGORA_APP_CERTIFICATE') }}';
        }

        document.addEventListener('DOMContentLoaded', (event) => {
                // console.log("START");
                LoadingVideoCall();
                startBasicCall();

            });

            function LoadingVideoCall() {
                setTimeout(() => {
                    // const url = "{{ url('/') }}/api/video_call?room_id=" + homeId + "&user_id=" + user_id_from_room + "&appId=" + options.appId + "&appCertificate=" + options.appCertificate;
                    const url = "{{ url('/') }}/api/video_call?room_id=" + homeId + "&user_id=" + user_id_from_room;
                    const loadingAnime = document.getElementById('loadingAnime');

                    axios.get(url).then((response) => {
                        options['token'] = response['data'];

                        // เอาหน้าโหลดออก
                        loadingAnime.remove();

                        setTimeout(() => {
                            document.getElementById("join").click();
                        }, 1000);
                    })
                    .catch((error) => {
                        console.log("ERROR HERE");
                        console.log(error);

                        if(loadingAnime){
                            loadingAnime.classList.remove('d-none');
                        }

                        // เรียกใช้งานฟังก์ชัน retryFunction() อีกครั้งหลังจากเวลาหน่วงให้ผ่านไป
                        setTimeout(() => {
                            LoadingVideoCall();
                        }, 3000);
                    });
                }, 1000);

            }
   </script>


    <script>
        var ButtonDiv = document.querySelector('#ButtonDiv');
        var MainVideoDiv = document.querySelector('#MainVideoDiv');

        // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด แชร์หน้าจอ
        var isSharingEnabled = false;

        //div for sharescreen
        // var ScreenDiv = document.querySelector('#Screen'+user_id_from_room);

        // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด วิดีโอและเสียง
        var isMuteVideo = false;
        var isMuteAudio = false;

        // ใช้สำหรับ สร้าง bg สีดำให้วิดีโอ
        var closeVideoHTML;

        // ใช้สำหรับ เช็คไม่ให้ฟังก์ชันออกห้องทำงานซ้ำ
        var leaveChannel = false;

        var channelParameters = {
            // A variable to hold a local audio track.
            localAudioTrack: null,
            // A variable to hold a local video track.
            localVideoTrack: null,
            // A variable to hold a remote audio track.
            remoteAudioTrack: null,
            // A variable to hold a remote video track.
            remoteVideoTrack: null,
            // A variable to hold the remote user id.s
            remoteUid: null,
            // A variable to hold the screen track
            screenTrack: null,
        };

        async function startBasicCall() {
            // Create an instance of the Agora Engine
            console.log("-------------------- startBasicCall ------------------");

            // checkBrowserStatus();

            const agoraEngine = AgoraRTC.createClient({
                mode: "rtc",
                codec: "vp8"
            });
            console.log("agoraEngine");
            console.log(agoraEngine);
            console.log(agoraEngine['remoteUsers'].length);

            //===================================
            //       บันทึก stats Video Call
            //===================================

            function MemberInRoomUpdate(member_id){

                const urlStatsVideo = "{{ url('/') }}/api/urlMemberVideo?room_id=" + homeId + "&room_of_members=" + user_id_from_room + "&members_in_room=" + member_id;

                axios.get(urlStatsVideo).then((response) => {
                    console.log(response['data']);
                })
                .catch((error) => {
                    console.log("ERROR HERE");
                    console.log(error);
                });
            }

            //function สำหรับ คำนวนเวลาของห้อง ตรวจสอบจำนวนคนในห้อง ว่ามีกี่คน และใครบ้าง
            function StatsVideoUpdate(){
                const urlStatsVideo = "{{ url('/') }}/api/urlStatsVideo?room_id=" + homeId + "&room_of_members=" + user_id_from_room;
                axios.get(urlStatsVideo).then((response) => {
                    // console.log(response['data']);

                    setInterval(() => {
                        var timeCountVideo = document.getElementById("timeCountVideo");
                        // วันที่และเวลาปัจจุบัน
                        var currentDate = new Date();
                        var currentTime = currentDate.getTime();

                        // วันที่และเวลาที่กำหนด
                        var targetDate = new Date(response['data']);
                        var targetTime = targetDate.getTime();

                        // คำนวณเวลาที่ผ่านไปในมิลลิวินาที
                        var elapsedTime = currentTime - targetTime;
                        var elapsedMinutes = Math.floor(elapsedTime / (1000 * 60));

                        // แปลงเวลาที่ผ่านไปให้เป็นรูปแบบชั่วโมง:นาที:วินาที
                        var hours = Math.floor(elapsedMinutes / 60);
                        var minutes = elapsedMinutes % 60;
                        var seconds = Math.floor((elapsedTime / 1000) % 60);
                        var minsec = minutes + '.' + seconds;

                        // console.log(minsec);
                        // console.log(typeof(minsec));

                        let showTimeCountVideo;

                        // แสดงผลลัพธ์
                        if (hours > 0) {
                            if (minutes < 10) {  // ใส่ 0 ข้างหน้า นาที กรณีเลขยังไม่ถึง 10
                                showTimeCountVideo = hours + ':' + '0' + minutes + ':' + seconds + "&nbsp;/ 10 นาที";
                            }else{
                                showTimeCountVideo = hours + ':' + minutes + ':' + seconds + "&nbsp;/ 10 นาที";
                            }
                        } else {
                            if(seconds < 10){  // ใส่ 0 ข้างหน้า วินาที กรณีเลขยังไม่ถึง 10
                                showTimeCountVideo =  minutes + ':' + '0' + seconds + "&nbsp;/ 10 นาที";
                            }else{
                                showTimeCountVideo = minutes + ':' + seconds + "&nbsp;/ 10 นาที";
                            }
                        }

                        // เสียงแจ้งเตือน
                        var audio_ringtone = new Audio("{{ asset('sound/achive-sound-132273.mp3') }}");

                        // เมื่อผ่านไป 5 นาทีแล้ว ให้กดปุ่ม "Leave"
                        if (minsec === "5.0") {
                            alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;"><a style="color: white;">&nbsp;ห้องสนทนาเหลืออีก 5 นาที</a></i>',
                            '<i id="alertClose" class="fa-light fa-circle-xmark" onclick="alertClose();"></i>');
                            //เสียงแจ้งเตือน
                            audio_ringtone.play();
                        }
                        // เมื่อผ่านไป 6 นาทีแล้ว ให้กดปุ่ม "Leave"
                        if (minsec === "6.0") {
                            // ตรวจสอบว่ามีปุ่ม "Leave" อยู่ใน DOM หรือไม่ แล้วกดปุ่ม "Leave" โดยอัตโนมัติ
                            alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;"><a style="color: white;">&nbsp;ห้องสนทนาเหลืออีก 4 นาที</a></i>',
                            '<i id="alertClose" class="fa-light fa-circle-xmark" onclick="alertClose();"></i>');
                             //เสียงแจ้งเตือน
                            audio_ringtone.play();
                        }

                        // เมื่อผ่านไป 7 นาทีแล้ว ให้กดปุ่ม "Leave"
                        if (minsec === "7.0") {
                            // ตรวจสอบว่ามีปุ่ม "Leave" อยู่ใน DOM หรือไม่ แล้วกดปุ่ม "Leave" โดยอัตโนมัติ
                            alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;"><a style="color: white;">&nbsp;ห้องสนทนาเหลืออีก 3 นาที</a></i>',
                            '<i id="alertClose" class="fa-light fa-circle-xmark" onclick="alertClose();"></i>');
                             //เสียงแจ้งเตือน
                            audio_ringtone.play();
                        }

                        // เมื่อผ่านไป 8 นาทีแล้ว ให้กดปุ่ม "Leave"
                        if (minsec === "8.0") {
                            // ตรวจสอบว่ามีปุ่ม "Leave" อยู่ใน DOM หรือไม่ แล้วกดปุ่ม "Leave" โดยอัตโนมัติ
                            // alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;">', 'ห้องสนทนาเหลืออีก 2 นาที');

                                alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;"><a style="color: white;">&nbsp;ห้องสนทนาเหลืออีก 2 นาที</a></i>',
                            '<i id="alertClose" class="fa-light fa-circle-xmark" onclick="alertClose();"></i>');
                             //เสียงแจ้งเตือน
                            audio_ringtone.play();
                        }

                        // เมื่อผ่านไป 9 นาทีแล้ว แสดง Alert "เหลือเวลา 1 นาที"
                        if (minsec === "9.0") {

                            // สร้าง message bubble
                            let secondsRemaining;

                            function countdown(minutes) {
                                let seconds = minutes * 60;

                                const countdownInterval = setInterval(function() {
                                    // const minutesRemaining = Math.floor(seconds / 60);
                                    secondsRemaining = seconds % 60;

                                    // console.log((secondsRemaining < 10 ? "0" : "") + secondsRemaining);

                                    if (seconds === 0) {
                                        clearInterval(countdownInterval);
                                    }

                                    if(secondsRemaining !== 0){
                                        document.getElementById('showSecondRemaining').innerHTML = (secondsRemaining < 10 ? "0" : "") + secondsRemaining;
                                    }
                                    seconds--;
                                }, 1000);
                            }
                            countdown(1);

                            alertNoti('<i class="fa-regular fa-clock" style="color: #11b06b;">', 'ห้องสนทนาเหลืออีก <span id="showSecondRemaining">60</span> วินาที');

                                //เสียงแจ้งเตือน
                            audio_ringtone.play();

                            if(document.querySelector('.containerAlert')){
                                const alertNotiElement = document.querySelector('.containerAlert');
                                    alertNotiElement.classList.remove('scaleUpDown');
                                    alertNotiElement.classList.add('scaleUpDownV2');
                            }

                        }

                        // เมื่อผ่านไป 10 นาทีแล้ว ให้กดปุ่ม "Leave"
                        if (elapsedMinutes === 10) {
                            // ตรวจสอบว่ามีปุ่ม "Leave" อยู่ใน DOM หรือไม่ แล้วกดปุ่ม "Leave" โดยอัตโนมัติ
                            const urlStatsVideo = "{{ url('/') }}/api/leaveChannel?room_id=" + homeId + "&room_of_members=" + user_id_from_room + "&members_in_room=" + '{{ Auth::user()->id }}';
                            axios.get(urlStatsVideo).then((response) => {
                                // console.log("ไอดีที่ออกจากห้อง");
                                // console.log(response['data']);
                                window.history.back();
                            });

                        }
                        // // อัปเดตข้อความใน div ที่มี id เป็น timeCountVideo
                        timeCountVideo.innerHTML = '<i class="fa-regular fa-clock fa-fade" style="color: #11b06b; font-size: 30px;"></i>&nbsp;' + ": " + showTimeCountVideo;
                    }, 1000);


                })
                .catch((error) => {
                    console.log("ERROR HERE");
                    console.log(error);
                });
            }

            // Dynamically create a container in the form of a DIV element to play the remote video track.
            const remotePlayerContainer = document.getElementById('remoteVideoMain');

            // Dynamically create a container in the form of a DIV element to play the local video track.
            const localPlayerContainer = document.getElementById('localVideoMain');
            // Specify the ID of the DIV container. You can use the uid of the local user.
            localPlayerContainer.id = options.uid;
            // Set the textContent property of the local video container to the local user id.

            agoraEngine.enableAudioVolumeIndicator();

            agoraEngine.on("volume-indicator", volumes => {
                volumes.forEach((volume, index) => {
                    if (options.uid == volume.uid && volume.level > 50) {
                        // console.log("ได้ยินเสียงแล้ววววววววววววววววววว");
                        // console.log(volume.uid);
                        // console.log(volume.level);

                        localPlayerContainer.classList.add('VoiceLocalEffect');
                    } else if (options.uid == volume.uid && volume.level < 50) {
                        // console.log("ไม่มีเสียง");
                        // console.log(volume.level);
                        localPlayerContainer.classList.remove('VoiceLocalEffect');
                    }
                });
            })

            // *************************************************************************** //
            // ******************************** local ************************************ //
            // *************************************************************************** //
            function nameRoleLocal (){
                const localPlayerURL = "{{ url('/') }}/api/localPlayerData?room_id=" + homeId + "&user_id=" + '{{ Auth::user()->id }}';
                    axios.get(localPlayerURL).then((response) => {
                    var localPlayerData = response['data'];

                            // ชื่อ local ขวาล่าง //
                    const nameLocal = document.createElement('div');
                        nameLocal.classList.add('profileNameLocal');
                        nameLocal.innerHTML = "{{ Auth::user()->name }}";
                            // โรล local ขวาล่าง //
                    const roleLocal = document.createElement('div');
                            roleLocal.classList.add('profileNameLocal');
                        if(localPlayerData['status'] === "patient"){
                            roleLocal.innerHTML = "ผู้ป่วยระดับ " + localPlayerData['lv_of_caretaker'];
                        }else if(localPlayerData['status'] === "owner"){
                            roleLocal.innerHTML = "เจ้าของบ้าน";
                        }else if(localPlayerData['status'] === "member"){
                            roleLocal.innerHTML = "สมาชิก(ผู้ดูแล)";
                        }else{
                            roleLocal.innerHTML = "สมาชิก";
                        }

                    const namedivLocal = document.createElement('div');
                        namedivLocal.classList.add('namedivLocal','mobile_d_none');
                        namedivLocal.appendChild(nameLocal);
                        namedivLocal.appendChild(roleLocal);

                    localPlayerContainer.appendChild(namedivLocal);
                    //END ชื่อ local ขวาล่าง //
                })
                .catch((error) => {
                    console.log("ERROR HERE localPlayerData มีปัญหา");
                    console.log(error);
                    console.log("ERROR HERE localPlayerData มีปัญหา");
                });
            }



            //============== เมนูปุ่มด้านล่าง ==============
            const divForVideoButton = document.createElement('div');
            divForVideoButton.classList.add('buttonVideo');

            //สร้างปุ่ม สลับหน้าจอ
            const switchCameraFR = document.createElement('button');
                switchCameraFR.type = "button";
                switchCameraFR.id = "switchCameraFR";
                // switchCameraFR.classList.add('btn-old', 'btn-info', 'mt-2','switchCameraFR');
                switchCameraFR.classList.add('btn-old', 'btn-info', 'mt-2','computer_d_none');
                switchCameraFR.innerHTML = '<i class="fa-regular fa-camera-rotate"></i>';

            divForVideoButton.appendChild(switchCameraFR);

            ButtonDiv.appendChild(divForVideoButton);
            //สร้างปุ่ม แชร์หน้าจอ
            const shareScreenButton = document.createElement('button');
                shareScreenButton.type = "button";
                shareScreenButton.id = "shareScreen";
                shareScreenButton.classList.add('btn-old', 'btn-info', 'mt-2','mobile_d_none');
                shareScreenButton.innerHTML = '<i class="fa-solid fa-screencast"></i>';

            divForVideoButton.appendChild(shareScreenButton);

            //สร้างปุ่ม เปิด-ปิด เสียง
            const muteButton = document.createElement('button');
                muteButton.type = "button";
                muteButton.id = "muteAudio";
                muteButton.classList.add('btn-old','mt-2');
                muteButton.innerHTML = '<i class="fa-solid fa-microphone"></i>';

            divForVideoButton.appendChild(muteButton);

            //สร้างปุ่ม เปิด-ปิด วิดีโอ
            const muteVideoButton = document.createElement('button');
                muteVideoButton.type = "button";
                muteVideoButton.id = "muteVideo";
                muteVideoButton.classList.add('btn-old','mt-2');
                muteVideoButton.innerHTML = '<i class="fa-solid fa-video"></i>';

            divForVideoButton.appendChild(muteVideoButton);

            //สร้างปุ่ม ออกสาย
            const leaveVideoButton = document.createElement('button');
                leaveVideoButton.type = "button";
                leaveVideoButton.id = "leaveVideoCall";
                leaveVideoButton.classList.add('btn-old', 'btn-danger', 'mt-2');
                leaveVideoButton.innerHTML = '<i class="fa-solid fa-phone"></i>';

            divForVideoButton.appendChild(leaveVideoButton);

            // div สำหรับแสดงวันที่-เวลาปัจจุบัน

            var intervalId; // สร้างตัวแปรเพื่อเก็บ ID ของ setInterval

            function updateDateTime() {

                if(document.querySelector('.DateTimeDiv')){
                    document.querySelector('.DateTimeDiv').remove();
                }

                var currentDate = new Date();

                var currentDay = currentDate.getDate();
                var currentMonth = currentDate.getMonth() + 1;
                var currentYear = currentDate.getFullYear();

                var currentHours = currentDate.getHours();
                var currentMinutes = currentDate.getMinutes();
                if (currentMinutes < 10) {
                    currentMinutes = '0' + currentMinutes;
                }

                var formattedDate = currentDay + '/' + currentMonth + '/' + currentYear;
                var formattedTime = currentHours + ':' + currentMinutes;

                var DateTimeDiv = document.createElement('div');
                    DateTimeDiv.classList.add('DateTimeDiv','mobile_d_none');
                if (DateTimeDiv) {
                    DateTimeDiv.innerHTML = formattedTime + '<br>' + formattedDate;
                }
                ButtonDiv.insertBefore(DateTimeDiv, divForVideoButton.nextSibling);
            }

            function startUpdatingDateTime() {
                clearInterval(intervalId); // หยุดการอัปเดตเวลา (หากมีการอัปเดตที่กำลังทำงานอยู่)

                updateDateTime(); // อัปเดตเวลาและวันที่ครั้งแรก

                intervalId = setInterval(updateDateTime, 60000); // เริ่มต้นการอัปเดตเวลาทุกๆ 1 นาที (60000 มีเซกันด์)
            }

            // เรียกใช้งานฟังก์ชัน startUpdatingDateTime เพื่อเริ่มต้นการอัปเดตเวลา
            startUpdatingDateTime();

            muteVideoButton.onclick = async function() {
                if (isMuteVideo == false) {
                    // Mute the local video.
                    channelParameters.localVideoTrack.setEnabled(false);
                    // Update the button text.
                    document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                    muteVideoButton.classList.add('btn-disabled');
                    // muteVideoButton.classList.remove('btn-success');
                    isMuteVideo = true;

                    //======================
                    //   Profile Local
                    //======================

                    //ดึงข้อมูลผู้ใช้งานจาก auth
                    const user = '{{ json_encode(auth()->user()) }}';

                    // สร้าง element รูปภาพ
                    const imgLocal = document.createElement('img');
                    if(user.avatar !== '' && user.photo === ''){
                        imgLocal.src = "{{ Auth::user()->avatar }}";
                    }else if(user.photo !== ''){
                        imgLocal.src = "{{ url('/storage') }}" + "/" + "{{ Auth::user()->photo }}";
                    }else if(user.avatar === '' && user.photo === ''){
                        imgLocal.src = "https://www.mithcare.com/img/%E0%B8%AA%E0%B8%95%E0%B8%B4%E0%B8%81%E0%B9%80%E0%B8%81%E0%B8%AD%E0%B8%A3%E0%B9%8C%20Mithcare/01.png";
                    }

                    // สร้าง element div สำหรับรอบรูปภาพ
                    const imgdivLocal = document.createElement('div');
                        imgdivLocal.classList.add('imgdivLocal');

                    // if(document.querySelector('.imgdivLocalAfterSubscribe')){
                    //     document.querySelector('.imgdivLocalAfterSubscribe').remove();
                    // }

                    // เพิ่ม element รูปภาพเข้าไปยัง element div
                    imgdivLocal.appendChild(imgLocal);

                    localPlayerContainer.appendChild(imgdivLocal);


                    //======================
                    // END Profile Local
                    //======================
                } else {
                    // Unmute the local video.
                    channelParameters.localVideoTrack.setEnabled(true);
                    // Update the button text.
                    document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video"></i>';
                    // muteVideoButton.classList.add('btn-success');
                    muteVideoButton.classList.remove('btn-disabled');
                    isMuteVideo = false;

                    if(document.querySelector('.imgdivLocal')){
                        document.querySelector('.imgdivLocal').remove();
                    }
                }
            }

            muteButton.onclick = async function() {
                if (isMuteAudio == false) {
                    // Mute the local video.
                    channelParameters.localAudioTrack.setEnabled(false);
                    // Update the button text.
                    document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                    muteButton.classList.add('btn-disabled');
                    // muteButton.classList.remove('btn-primary');
                    isMuteAudio = true;
                } else {
                    // Unmute the local video.
                    channelParameters.localAudioTrack.setEnabled(true);
                    // Update the button text.
                    document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                    // muteButton.classList.add('btn-primary');
                    muteButton.classList.remove('btn-disabled');
                    isMuteAudio = false;
                }
            }

            //ShareScreen
            document.getElementById('shareScreen').onclick = async function () {
                if (isSharingEnabled == false) {
                    try {
                        // Create a screen track for screen sharing.
                        channelParameters.screenTrack = await AgoraRTC.createScreenVideoTrack();
                        // Update the button text.
                        document.getElementById('shareScreen').innerHTML = '<i class="fa-solid fa-square-xmark"></i>';

                        if(agoraEngine['remoteUsers'][0]){
                            //ตรวจเช็คว่ามี remote player มั้ย
                            if(agoraEngine['remoteUsers'].length !== 0){
                                for(let c_uid = 0; c_uid < agoraEngine['remoteUsers']['length']; c_uid++){
                                    // f_remoteID ใช้สำหรับตรวจเช็ค id ของ remote player
                                    let remoteID = agoraEngine['remoteUsers'][c_uid]['uid'];

                                    if(document.querySelector('#unreal' + remoteID)){ //เมื่อผู้ใช้ยังไม่ได้เข้าสู่ user-published ให้แสดง unrealDiv และซ่อน remotePlayerContainer
                                        // เปลี่ยน class unrealDiv ให้เป็นโหมดสำหรับแชร์หน้าจอ
                                        let unrealDivInShareScreen = document.querySelector('#unreal' + remoteID);
                                            unrealDivInShareScreen.setAttribute('class','RemotePlayerInScreenShare');
                                        // เปลี่ยน class remotePlayerContainer ให้ซ่อนอยู่
                                    }else{ // เมื่อมี remotePlayerContainer ให้ซ่อน unrealDiv
                                        let remote_STR = remotePlayerContainer;
                                        // เปลี่ยน class remotePlayerContainer ให้เป็นโหมดสำหรับแชร์หน้าจอ
                                        remote_STR.setAttribute('class','RemotePlayerInScreenShare');
                                    }
                                }
                            }
                        }


                        let local_STR = localPlayerContainer;
                            local_STR.setAttribute('class','LocalPlayerInScreenShare');

                        // Create a new <div> element to display the shared screen.
                        const ScreenDiv = document.createElement('div');
                        ScreenDiv.setAttribute('id', 'Screen'+ user_id_from_room);
                        ScreenDiv.setAttribute('class', 'ShareScreenVideoCall');

                        // ScreenDiv.classList.remove('d-none');
                        await channelParameters.screenTrack.play(ScreenDiv);

                        // Append the ScreenDiv to the main video container.
                        const MainVideoDiv = document.getElementById('MainVideoDiv');
                        MainVideoDiv.appendChild(ScreenDiv);

                        isSharingEnabled = true;
                    } catch (error) {
                        console.error('Failed to start screen sharing:', error);
                    }
                } else {
                    try {
                        // // หยุดการส่งภาพจากอุปกรณ์ปัจจุบัน
                        // channelParameters.localVideoTrack.setEnabled(false);
                        agoraEngine.unpublish([channelParameters.screenTrack]);

                        // ปิดการเล่นภาพวิดีโอกล้องเดิม
                        channelParameters.screenTrack.stop();
                        channelParameters.screenTrack.close();

                        if(agoraEngine['remoteUsers'][0]){
                            //ตรวจเช็คว่ามี remote player มั้ย
                            if(agoraEngine['remoteUsers'].length !== 0){
                                for(let c_uid = 0; c_uid < agoraEngine['remoteUsers']['length']; c_uid++){
                                    // remoteID ใช้สำหรับตรวจเช็ค id ของ remote player
                                    let remoteID = agoraEngine['remoteUsers'][c_uid]['uid'];

                                    if(document.querySelector('#unreal' + remoteID)){ //เมื่อผู้ใช้ยังไม่ได้เข้าสู่ user-published ให้แสดง unrealDiv และซ่อน remotePlayerContainer
                                            // เปลี่ยน class unrealDiv ให้ใช้ class ตอนไม่แชร์หน้าจอ
                                        let unrealDivInShareScreen = document.querySelector('#unreal' + remoteID);
                                            unrealDivInShareScreen.setAttribute('class','remotePlayerVideoCall');

                                            let local_STR = localPlayerContainer;
                                            local_STR.setAttribute('class','localAfterSubscribe');

                                    }else{
                                        let remote_STR = remotePlayerContainer;
                                        remote_STR.setAttribute('class','remotePlayerVideoCall','');

                                        let local_STR = localPlayerContainer;
                                            local_STR.setAttribute('class','localAfterSubscribe');
                                    }
                                }
                            }
                        }else{ //ถ้าไม่มี remote user
                            let local_STR = localPlayerContainer;
                            local_STR.setAttribute('class','localPlayerVideoCall');
                        }

                        //ลบ div ที่ใส่ sharescreenTrack ไว้
                        document.querySelector('#Screen' + '{{Auth::user()->id}}').remove();

                        // ScreenDiv.classList.add('d-none');

                        // Update the button text.
                        document.getElementById('shareScreen').innerHTML = '<i class="fa-solid fa-screencast"></i>';
                        // Update the screen sharing state.
                        isSharingEnabled = false;

                    } catch (error) {
                        console.error('Failed to stop screen sharing:', error);
                    }
                }
            };

            window.onload = function() {
                // Listen to the Join button click event.
                document.getElementById("join").onclick = async function() {
                    // Join a channel.
                    try {
                        await agoraEngine.join(options.appId, options.channel, options.token, options.uid);
                    } catch (error) {
                        setTimeout(() => {

                            window.location.reload(true);
                        }, 2500);

                    }
                    // Create a local audio track from the audio sampled by a microphone.

                    try {
                        // สร้างเทร็กเสียงจากไมค์
                        channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                    } catch (error) {
                            // สร้างเทร็กเสียงจากไมค์
                        channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                    }

                    let retryCreateCamera;

                    try {
                        // สร้างเทร็กวิดีโอจากกล้อง
                        channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack();
                    } catch (error) {
                        retryCreateCamera = setInterval(() => {
                            console.log("Deer ======================================= DEER");
                            console.log("Deer ======================================= DEER");
                            console.log("Deer ======================================= DEER");
                            try {
                                // สร้างเทร็กวิดีโอจากกล้อง
                                channelParameters.localVideoTrack = AgoraRTC.createCameraVideoTrack();
                                console.log("RETRY -------------------------------");
                                clearInterval(retryCreateCamera);
                            } catch (error) {
                                // สร้างเทร็กวิดีโอจากกล้อง
                                channelParameters.localVideoTrack = AgoraRTC.createCameraVideoTrack();
                            }
                        }, 1000);
                    }

                    try {
                        if('{{$videoTrack}}' == "open"){
                            // เข้าห้องด้วย->สถานะเปิดกล้อง
                            isMuteVideo = true;
                            muteVideoButton.dispatchEvent(new MouseEvent('click')); // คลิกปุ่มโดยใช้เหตุการณ์
                        }else{
                            // เข้าห้องด้วย->สถานะปิดกล้อง
                            isMuteVideo = false;
                            muteVideoButton.dispatchEvent(new MouseEvent('click')); // คลิกปุ่มโดยใช้เหตุการณ์
                        }

                        if('{{$audioTrack}}' == "open"){
                            // เข้าห้องด้วย->สถานะเปิดไมค์
                            isMuteAudio = true;
                            muteButton.dispatchEvent(new MouseEvent('click')); // คลิกปุ่มโดยใช้เหตุการณ์
                        }else{
                            // เข้าห้องด้วย->สถานะปิดไมค์
                            isMuteAudio = false;
                            muteButton.dispatchEvent(new MouseEvent('click')); // คลิกปุ่มโดยใช้เหตุการณ์
                        }
                    } catch (error) {

                    }

                    MemberInRoomUpdate(options.uid);
                    StatsVideoUpdate();

                    // Enable dual-stream mode.
                    agoraEngine.enableDualStream();

                    // Publish the local audio and video tracks in the channel.
                    await agoraEngine.publish([channelParameters.localAudioTrack, channelParameters.localVideoTrack ]);
                    await nameRoleLocal();

                    // Play the local video track.
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    console.log("publish success!");

                }

                // Listen to the Leave button click event.
                document.querySelector('#leaveVideoCall').addEventListener('click', async function(typeExit) {
                    // closeVideoCall();

                    // Destroy the local audio and video tracks.
                    channelParameters.localAudioTrack.close();
                    channelParameters.localVideoTrack.close();
                    // Remove the containers you created for the local video and remote video.
                    removeVideoDiv(remotePlayerContainer.id);
                    removeVideoDiv(localPlayerContainer.id);

                    //กดซ่อนปุ่มตอนออกเพื่อ ความสวยงาม
                    ButtonDiv.classList.add('d-none');
                    //กดซ่อนวิดีโอตอนออกเพื่อ ความสวยงาม
                    let remoteDnone = document.querySelector('.remotePlayerVideoCall');
                    if(remoteDnone){
                        remoteDnone.classList.add('d-none');
                    }



                    // Leave the channel
                    await agoraEngine.leave();
                    console.log("You left the channel -----------------------> ออกแล้วนะ");
                    // Refresh the page for reuse

                    if(leaveChannel == false){
                        const urlStatsVideo = "{{ url('/') }}/api/userLeave?room_id=" + homeId + "&room_of_members=" + user_id_from_room + "&members_in_room=" + localUser_id;
                        axios.get(urlStatsVideo).then((response) => {
                            // console.log("ไอดีที่ออกจากห้อง");
                            // console.log(response['data']);
                            leaveChannel = true;
                            window.history.back();
                        });

                    }

                    // goBack();

                    function goBack(){
                        window.history.back();
                    }
                })

            }


            // *************************************************************************** //
            // ******************************** END local ******************************** //
            // *************************************************************************** //

            // --------------------------------------------------------------------------- //

            // *************************************************************************** //
            // ****************************** remotePlayer ******************************* //
            // *************************************************************************** //

            // Listen for the "user-published" event to retrieve a AgoraRTCRemoteUser object.
            agoraEngine.on("user-published", async (user, mediaType) => {
                // Subscribe to the remote user when the SDK triggers the "user-published" event.
                await agoraEngine.subscribe(user, mediaType);
                console.log("------------------- published ------------------");
                console.log("user_id >> " + user.uid);
                console.log("subscribe >> " + mediaType + " << success");

                setTimeout(() => {
                    StatsVideoUpdate();
                }, 2500);

                // Subscribe and play the remote video in the container If the remote user publishes a video track.
                if (mediaType == "video") {

                    // Retrieve the remote video track.
                    channelParameters.remoteVideoTrack = user.videoTrack;
                    // Retrieve the remote audio track.
                    channelParameters.remoteAudioTrack = user.audioTrack;
                    // Save the remote user id for reuse.
                    channelParameters.remoteUid = user.uid.toString();
                    // Specify the ID of the DIV container. You can use the uid of the remote user.
                    remotePlayerContainer.id = user.uid.toString();

                    remotePlayerContainer.classList.remove('d-none');
                    // ชื่อ RemotePlayer
                    // remotePlayerContainer.textContent = "Remote user " + user.uid.toString();

                    // สลับ local ไปเป็นจอเล็กแล้วให้อยู่ขวาบน
                    let local_STR = localPlayerContainer;
                    // let local_STR = document.getElementById('localVideoMain');
                    // local_STR.classList.add('localAfterSubscribe');
                    // local_STR.classList.remove('localPlayerVideoCall');
                    local_STR.setAttribute('class','localAfterSubscribe');

                    // สร้าง element div new_remote_video_call
                    if(document.getElementById('unreal'+ user.uid)){
                        document.getElementById('unreal'+ user.uid).remove();
                    }
                    // if(document.getElementById('remote_video_call_'+ user.uid)){
                    //     document.getElementById('remote_video_call_'+ user.uid).remove();
                    // }
                    if(document.querySelector('#imgdivRemote'+ user.uid)){
                        document.querySelector('#imgdivRemote'+ user.uid).remove();
                    }

                    //======================
                    //   Profile Remote
                    //======================

                    const urlRemoteUser = "{{ url('/') }}/api/getUserRemote" + "?userId=" + user.uid + "&room_id=" + homeId;
                    // console.log(urlRemoteUser);
                    axios.get(urlRemoteUser).then((response) => {
                        // console.log("=========== urlRemoteUser ================");
                        // console.log(response['data']);

                        if(document.querySelector('namedivRemote'+ user.uid)){
                            document.querySelector('namedivRemote'+ user.uid).remove();
                        }

                        const userRemote = response['data'];


                        const nameRemote = document.createElement('div');
                            nameRemote.innerHTML = userRemote['name'];
                            nameRemote.classList.add('profileNameRemote')
                        const statusRemote = document.createElement('div');
                            statusRemote.classList.add('profileNameRemote')
                        if(userRemote['memberStatus'] === 'patient'){
                            statusRemote.innerHTML = "ผู้ป่วยระดับ " + userRemote['memberLv'];
                        }else if(userRemote['memberStatus'] === 'owner'){
                            statusRemote.innerHTML = "เจ้าของบ้าน";
                        }else if(userRemote['memberStatus'] === 'member'){
                            statusRemote.innerHTML = "สมาชิก(ผู้ดูแล)";
                        }else{
                            statusRemote.innerHTML = "สมาชิก";
                        }
                        // สร้าง element div สำหรับใส่ชื่อ
                        const namedivRemote = document.createElement('div');
                            namedivRemote.classList.add('namedivRemote','mobile_d_none');
                            namedivRemote.id = 'namedivRemote'+ user.uid;
                        // เพิ่ม element รูปภาพเข้าไปยัง element div
                        namedivRemote.appendChild(nameRemote);
                        namedivRemote.appendChild(statusRemote);

                        remotePlayerContainer.appendChild(namedivRemote);

                    })
                    .catch((error) => {
                        console.log("ERROR HERE");
                        console.log(error);

                    });
                    //======================
                    // END Profile Remote
                    //======================

                }

                // Subscribe and play the remote audio track If the remote user publishes the audio track only.
                if (mediaType == "audio") {
                    // Get the RemoteAudioTrack object in the AgoraRTCRemoteUser object.
                    channelParameters.remoteAudioTrack = user.audioTrack;
                    // Play the remote audio track. No need to pass any DOM element.
                    channelParameters.remoteAudioTrack.play();

                    agoraEngine.on("volume-indicator", volumes => {
                        volumes.forEach((volume, index) => {
                            if (channelParameters.remoteUid == volume.uid && volume.level > 50) {
                                console.log("ได้ยินเสียงแล้ววววววววววววววววววว");
                                console.log(volume.uid);
                                console.log(volume.level);

                                remotePlayerContainer.classList.add('VoiceLocalEffect');
                            } else if (channelParameters.remoteUid == volume.uid && volume.level < 50) {
                                console.log("ไม่มีเสียง");
                                console.log(volume.level);
                                remotePlayerContainer.classList.remove('VoiceLocalEffect');
                            }
                        });
                    })

                }


                // ---------------------- ลบ BackGround - วิดีโอ ---------------------- //
                if(document.querySelector('#video_trackRemoteDiv')){
                    document.querySelector('#video_trackRemoteDiv').remove();
                }
                // ---------------------- สร้างปุ่ม เปิด-ปิด เสียง/วิดีโอ ---------------------- //
                if( document.querySelector('#muteAudio2') ){
                    document.querySelector('#muteAudio2').remove();
                }
                if( document.querySelector('#muteVideo2') ){
                    document.querySelector('#muteVideo2').remove();
                }
                const divForVideoButton2 = document.createElement('div');
                divForVideoButton2.classList.add('buttonVideo2');
                // สร้างปุ่ม เปิด-ปิด เสียง
                var muteButton2 = document.createElement('div');
                    muteButton2.id = "muteAudio2";

                    if(user.audioTrack){
                        muteButton2.classList.add('btn-old','unmuteRemote', 'mt-2');
                        muteButton2.innerHTML = '<i class="fa-solid fa-microphone"></i>';
                    }else{
                        muteButton2.classList.add('btn-old','muteRemote', 'mt-2');
                        muteButton2.innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                    }

                    divForVideoButton2.appendChild(muteButton2);

                // สร้างปุ่ม เปิด-ปิด วิดีโอ
                var muteVideoButton2 = document.createElement('div');
                    muteVideoButton2.id = "muteVideo2";
                    if(user.videoTrack){
                        muteVideoButton2.classList.add('btn-old', 'btn-success', 'mt-2');
                        muteVideoButton2.innerHTML = '<i class="fa-solid fa-video"></i>';
                    }else{
                        muteVideoButton2.classList.add('btn-old', 'btn-danger', 'mt-2');
                        muteVideoButton2.innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                    }

                    divForVideoButton2.appendChild(muteVideoButton2);
                    document.querySelector('.remotePlayerVideoCall').appendChild(divForVideoButton2);

                    if (channelParameters.remoteVideoTrack !== null) { // ตรวจสอบว่าตัวแปร video ไม่เป็น null ก่อนเรียกใช้เมธอด play()
                        channelParameters.remoteVideoTrack.play(remotePlayerContainer);
                    }
                // ---------------------- จบ สร้างปุ่ม เปิด-ปิด เสียง/วิดีโอ ---------------------- //



            });

            // ******************** remotePlayer ปิด ไมค์ กล้อง ออก ********************* //
            // ⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇ //

            // ออกจากห้อง
            agoraEngine.on("user-joined", function (evt) {

                // ลบ div unreal ออก
                if(document.getElementById("unreal" + evt.uid)){
                    document.getElementById("unreal" + evt.uid).remove();
                }

                if(agoraEngine['remoteUsers'][0]){

                    if( agoraEngine['remoteUsers']['length'] != 0 ){
                        for(let c_uid = 0; c_uid < agoraEngine['remoteUsers']['length']; c_uid++){
                        // console.log('USER_ID ==>> ' + agoraEngine['remoteUsers'][c_uid]['uid']);
                        // console.log('ไมค์ ==>> ' + agoraEngine['remoteUsers'][c_uid]['hasAudio']);
                        // console.log('กล้อง ==>> ' + agoraEngine['remoteUsers'][c_uid]['hasVideo']);

                        const f_remoteID = agoraEngine['remoteUsers'][c_uid]['uid'];

                            if(agoraEngine['remoteUsers'][c_uid]['hasVideo'] == false){
                                //เพิ่มแท็กวิดีโอที่มีพื้นหลังแค่สีดำ
                                console.log("สร้างพื้นหลังดำ");

                                //ปรับให้ localPlayerContainer อยู่ในโหมดคุยกับ remote
                                let local_STR = localPlayerContainer;
                                local_STR.setAttribute('class','localAfterSubscribe');

                                //สร้าง div unreal แล้วเอาไปไว้ใน MainVideoDiv ที่เดียวกับ localPlayerContainer,remotePlayerContainer
                                closeVideoHTML  =
                                                ' <div id="unreal'+ f_remoteID + '" class="remotePlayerVideoCall">' +
                                                    '<video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>' +
                                                '</div>' ;
                                MainVideoDiv.insertAdjacentHTML('beforeend', closeVideoHTML); // แทรกล่างสุด

                                //======================
                                //   Profile Remote
                                //======================

                                var unrealDiv = document.querySelector('#unreal' + f_remoteID);

                                const urlRemoteUserUnreal = "{{ url('/') }}/api/getUserRemote" + "?userId=" + f_remoteID + "&room_id=" + homeId;
                                // console.log(urlRemoteUser);
                                axios.get(urlRemoteUserUnreal).then((response) => {

                                    if(document.querySelector('f_imgdivRemote'+ f_remoteID)){
                                        document.querySelector('f_imgdivRemote'+ f_remoteID).remove();
                                    }

                                    if(document.querySelector('f_namedivRemote'+ f_remoteID)){
                                        document.querySelector('f_namedivRemote'+ f_remoteID).remove();
                                    }

                                    const f_userRemote = response['data'];

                                    //=======================
                                    // สร้างชื่อจากโปรไฟล์ ใส่ bg
                                    // ======================
                                    const f_nameRemote = document.createElement('div');
                                        f_nameRemote.innerHTML = f_userRemote['name'];
                                        f_nameRemote.classList.add('profileNameRemote')
                                    const f_statusRemote = document.createElement('div');
                                        f_statusRemote.classList.add('profileNameRemote')
                                    if(f_userRemote['memberStatus'] === 'patient'){
                                        f_statusRemote.innerHTML = "ผู้ป่วยระดับ " + f_userRemote['memberLv'];
                                    }else if(f_userRemote['memberStatus'] === 'owner'){
                                        f_statusRemote.innerHTML = "เจ้าของบ้าน";
                                    }else if(f_userRemote['memberStatus'] === 'member'){
                                        f_statusRemote.innerHTML = "สมาชิก(ผู้ดูแล)";
                                    }else{
                                        f_statusRemote.innerHTML = "สมาชิก";
                                    }
                                    // สร้าง element div สำหรับใส่ชื่อ
                                    const f_namedivRemote = document.createElement('div');
                                    f_namedivRemote.classList.add('namedivRemote','mobile_d_none');
                                    f_namedivRemote.id = 'f_namedivRemote'+ f_remoteID;
                                    // เพิ่ม element รูปภาพเข้าไปยัง element div
                                    f_namedivRemote.appendChild(f_nameRemote);
                                    f_namedivRemote.appendChild(f_statusRemote);

                                    unrealDiv.appendChild(f_namedivRemote);

                                    //=======================
                                    // สร้างรูปภาพโปรไฟล์ ใส่ bg
                                    // ======================
                                    const f_imgRemote = document.createElement('img');

                                    if(f_userRemote['avatar']){
                                        f_imgRemote.src = f_userRemote['avatar'];
                                        // f_imgRemote.classList.add('imgdivRemote');
                                    }else{
                                        f_imgRemote.src = "{{ url('/storage') }}" + "/" + f_userRemote['photo'];
                                        // f_imgRemote.classList.add('imgdivRemote');
                                    }

                                    // สร้าง element div สำหรับกรอบรูปภาพ
                                    const f_imgdivRemote = document.createElement('div');
                                        f_imgdivRemote.classList.add('imgdivRemote');
                                        f_imgdivRemote.id = 'f_imgdivRemote'+ f_remoteID;

                                    // เพิ่ม element รูปภาพเข้าไปยัง element div
                                    f_imgdivRemote.appendChild(f_imgRemote);

                                    unrealDiv.appendChild(f_imgdivRemote);

                                })
                                .catch((error) => {
                                    console.log("ERROR HERE");
                                    console.log(error);

                                });

                                //===========================
                                // Icon Camera & Microphone
                                //===========================

                                const f_divForVideoButton2 = document.createElement('div');
                                f_divForVideoButton2.classList.add('buttonVideo2');
                                // สร้างปุ่ม เปิด-ปิด เสียง
                                let f_muteButton2 = document.createElement('div');
                                    f_muteButton2.id = "f_muteAudio2";

                                    if(agoraEngine['remoteUsers'][c_uid]['hasAudio'] == true){
                                        f_muteButton2.classList.add('btn-old','unmuteRemote', 'mt-2', 'mobile_d_none');
                                        f_muteButton2.innerHTML = '<i class="fa-solid fa-microphone"></i>';
                                    }else{
                                        f_muteButton2.classList.add('btn-old','muteRemote', 'mt-2', 'mobile_d_none');
                                        f_muteButton2.innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                                    }

                                    f_divForVideoButton2.appendChild(f_muteButton2);

                                // สร้างปุ่ม เปิด-ปิด วิดีโอ
                                let f_muteVideoButton2 = document.createElement('div');
                                    f_muteVideoButton2.id = "f_muteVideo2";

                                    if(agoraEngine['remoteUsers'][c_uid]['hasVideo'] == true){
                                        f_muteVideoButton2.classList.add('btn-old', 'unmuteRemote', 'mt-2', 'mobile_d_none');
                                        f_muteVideoButton2.innerHTML = '<i class="fa-solid fa-video"></i>';
                                    }else{
                                        f_muteVideoButton2.classList.add('btn-old', 'muteRemote', 'mt-2', 'mobile_d_none');
                                        f_muteVideoButton2.innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                                    }

                                    f_divForVideoButton2.appendChild(f_muteVideoButton2);
                                    unrealDiv.appendChild(f_divForVideoButton2);
                            }

                            //===================//
                            //  CheckShareScreen
                            //===================//

                            if(isSharingEnabled == true){ //ถ้ามีการแชร์หน้าจอ
                                if(document.querySelector('#unreal' + f_remoteID)){ //ถ้ามี unrealDiv
                                    unrealDiv.setAttribute('class','RemotePlayerInScreenShare');

                                    // ปรับให้ localPlayerContainer อยู่ในโหมด shareScreen
                                    let local_STR = localPlayerContainer;
                                    local_STR.setAttribute('class','LocalPlayerInScreenShare');
                                }else{
                                    remotePlayerContainer.setAttribute('class','RemotePlayerInScreenShare');

                                    // ปรับให้ localPlayerContainer อยู่ในโหมด shareScreen
                                    let local_STR = localPlayerContainer;
                                    local_STR.setAttribute('class','LocalPlayerInScreenShare');
                                }
                            }

                        }
                    }
                }

            });

            // ออกจากห้อง
            agoraEngine.on("user-left", function (evt) {

                console.log("remove id = "+evt.uid);

                if(document.getElementById(evt.uid)){
                    document.getElementById(evt.uid).remove();
                }
                // if(document.getElementById("remote_video_call_" + evt.uid)){
                //     document.getElementById("remote_video_call_" + evt.uid).remove();
                // }
                // ลบ div unreal ออก
                if(document.getElementById("unreal" + evt.uid)){
                    document.getElementById("unreal" + evt.uid).remove();
                }
                // ลบ div ScreenShare ออก
                if(document.getElementById("Screen" + user_id_from_room)){
                    document.getElementById("Screen" + user_id_from_room).remove();
                }

                //===================
                //  CheckShareScreen
                //===================

                if(isSharingEnabled == true){ //ถ้ามีการแชร์หน้าจอ
                    let local_FULL = localPlayerContainer;
                        local_FULL.classList.add('LocalPlayerInScreenShare');
                        local_FULL.classList.remove('localAfterSubscribe');
                }else{
                    let local_FULL = localPlayerContainer;
                        local_FULL.classList.add('localPlayerVideoCall');
                        local_FULL.classList.remove('localAfterSubscribe');
                }

                // ---------------------- ลบ BackGround - วิดีโอ ---------------------- //
                if(document.querySelector('#video_trackRemoteDiv')){
                    document.querySelector('#video_trackRemoteDiv').remove();
                }
                // ---------------------- ลบ เปิด-ปิด เสียง/วิดีโอ แบบ ------------------- //
                if( document.querySelector('#muteAudio2') ){
                    document.querySelector('#muteAudio2').remove();
                }
                if( document.querySelector('#muteVideo2') ){
                    document.querySelector('#muteVideo2').remove();
                }
                // ---------------------- ลบ เปิด-ปิด เสียง/วิดีโอ แบบ unreal ------------------- //
                if( document.querySelector('#f_muteAudio2') ){
                    document.querySelector('#f_muteAudio2').remove();
                }
                if( document.querySelector('#f_muteVideo2') ){
                    document.querySelector('#f_muteVideo2').remove();
                }

                channelParameters.remoteVideoTrack = null;
                channelParameters.remoteAudioTrack = null;
                channelParameters.remoteUid = null;

            });


            // ปิด ไมค์ กล้อง
            agoraEngine.on("user-unpublished", async (user, mediaType) => {

                // await agoraEngine.subscribe(user, mediaType);

                console.log("------------------- unpublished ------------------");
                console.log("user_id >> " + user.uid);
                console.log("unpublished >> " + mediaType);

                if(mediaType == "video"){

                    console.log('===================== VIDEO ========================')
                    if(user.videoTrack){
                        console.log("กล้อง >> 'เปิด' อยู่");

                        let muteVideoButton2 = document.getElementById(`muteVideo2`);
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video"></i>';
                        // muteVideoButton2.classList.add('btn-success');
                        muteVideoButton2.classList.remove('btn-disabled');


                    }else{
                        console.log("กล้อง >> 'ปิด' อยู่");
                        // remotePlayerContainer.muteVideo();
                        // channelParameters.localVideoTrack.muteVideo();

                        let muteVideoButton2 = document.getElementById(`muteVideo2`);
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                        muteVideoButton2.classList.add('btn-disabled');
                        // muteVideoButton2.classList.remove('btn-success');

                        if(document.getElementById('video_trackRemoteDiv')){
                            document.getElementById('video_trackRemoteDiv').remove();
                        }
                        //เพิ่มแท็กวิดีโอที่มีพื้นหลังแค่สีดำ
                        let remote_video_call = document.getElementById(user.uid.toString());
                            closeVideoHTML  =
                                               ' <div id="video_trackRemoteDiv" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: gray;">' +
                                                    '<video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>' +
                                                '</div>' ;
                        remote_video_call.insertAdjacentHTML('beforeend', closeVideoHTML); // แทรกล่างสุด

                        //เพิ่มรูปภาพโปรไฟล์ตอนปิดกล้อง ขนาด * หลังจากsubscribe
                        // const imgdivLocalAfterSubscribe = document.createElement('div');
                        // imgdivLocalAfterSubscribe.classList.add('imgdivLocalAfterSubscribe');

                        // if(document.querySelector('.imgdivLocal')){
                        //     document.querySelector('.imgdivLocal').remove();
                        // }

                        // localPlayerContainer.appendChild(imgdivLocalAfterSubscribe);

                    //======================
                    //   Profile Remote
                    //======================

                    const urlRemoteUser = "{{ url('/') }}/api/getUserRemote" + "?userId=" + user.uid + "&room_id=" + homeId;
                    // console.log(urlRemoteUser);
                    axios.get(urlRemoteUser).then((response) => {

                        if(document.querySelector('imgdivRemote'+ user.uid)){
                            document.querySelector('imgdivRemote'+ user.uid).remove();
                        }

                        const userRemote = response['data'];

                        // สร้าง element รูปภาพ
                        const imgRemote = document.createElement('img');
                        if(userRemote['avatar']){
                            imgRemote.src = userRemote['avatar'];
                            // imgRemote.classList.add('imgdivRemote');
                        }else{
                            imgRemote.src = "{{ url('/storage') }}" + "/" + userRemote['photo'];
                            // imgRemote.classList.add('imgdivRemote');
                        }

                        // สร้าง element div สำหรับกรอบรูปภาพ
                        const imgdivRemote = document.createElement('div');
                            imgdivRemote.classList.add('imgdivRemote');
                            imgdivRemote.id = 'imgdivRemote'+ user.uid;

                        // เพิ่ม element รูปภาพเข้าไปยัง element div
                        imgdivRemote.appendChild(imgRemote);

                        remotePlayerContainer.appendChild(imgdivRemote);

                    })
                    .catch((error) => {
                        console.log("ERROR HERE");
                        console.log(error);

                    });
                    //======================
                    // END Profile Remote
                    //======================

                    }

                }

                if(mediaType == "audio"){

                    console.log('===================== AUDIO ========================')

                    if(user.audioTrack){
                        console.log("ไมค์ >> 'เปิด' อยู่");
                        let muteButton2 = document.getElementById(`muteAudio2`);
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                        // muteButton2.classList.add('btn-primary');
                        muteButton2.classList.remove('btn-disabled');
                    }else{
                        console.log("ไมค์ >> 'ปิด' อยู่");
                        let muteButton2 = document.getElementById(`muteAudio2`);
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                        muteButton2.classList.add('btn-disabled');
                        // muteButton2.classList.remove('btn-primary');
                    }
                }


            });

            // ******************** remotePlayer ปิด ไมค์ กล้อง ออก ********************* //
            // ⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆⬆ //

            // *************************************************************************** //
            // **************************** END remotePlayer ***************************** //
            // *************************************************************************** //

        }


        // Remove the video stream from the container.
        function removeVideoDiv(elementId) {
            // console.log("Removing " + elementId + "Div");
            let Div = document.getElementById(elementId);
            if (Div) {
                Div.remove();
            }
        };


        window.addEventListener('beforeunload', function(event) {
            if(leaveChannel == false){
                const urlStatsVideo = "{{ url('/') }}/api/userLeave?room_id=" + homeId + "&room_of_members=" + user_id_from_room + "&members_in_room=" + localUser_id;
                            axios.get(urlStatsVideo).then((response) => {
                                //ออกจากหน้านี้กรณีที่ไม่ได้กดออกเอง
                            });
            }
        });

    </script>

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

        function alertClose() {
            document.querySelector('.containerAlert').remove(); // ปิดตัว alertNoti เมื่อคลิกที่ปุ่มปิด
        };

   </script>


   {{-- <script>
    // <button class="btn btn-secondary" id="btn_switchCamera" onclick="switchCamera();">
    //             <i class="fa-solid fa-camera-rotate"></i>
    // </button>
    /////////////////////// ปุ่มสลับ กล้อง/////////////////////
    const btn_switchCamera = document.querySelector('#btn_switchCamera');

    function onChangeVideoDevice() {
        const selectedVideoDeviceId = getCurrentVideoDeviceId();
        // console.log('เปลี่ยนอุปกรณ์กล้องเป็น:', selectedVideoDeviceId);

        // สร้าง local video track ใหม่โดยใช้กล้องที่คุณต้องการ
        AgoraRTC.createCameraVideoTrack({ cameraId: selectedVideoDeviceId })
            .then(newVideoTrack => {

            // console.log('------------ newVideoTrack ------------');
            // console.log(newVideoTrack);

            // // หยุดการส่งภาพจากอุปกรณ์ปัจจุบัน
            // channelParameters.localVideoTrack.setEnabled(false);
            agoraEngine.unpublish([channelParameters.localVideoTrack]);

            // ปิดการเล่นภาพวิดีโอกล้องเดิม
            channelParameters.localVideoTrack.stop();
            channelParameters.localVideoTrack.close();

            // เปลี่ยน local video track เป็นอุปกรณ์ใหม่
            channelParameters.localVideoTrack = newVideoTrack;

            if (isMuteVideo == false) {

                // เริ่มส่งภาพจากอุปกรณ์ใหม่
                channelParameters.localVideoTrack.setEnabled(true);
                // แสดงภาพวิดีโอใน <div>

                try{
                if (Screen_current == 'first'){
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    channelParameters.remoteVideoTrack.play(remotePlayerContainer);
                }else{
                    channelParameters.localVideoTrack.play(remotePlayerContainer);
                    channelParameters.remoteVideoTrack.play(localPlayerContainer);
                }
                }catch{
                if (Screen_current == 'first'){
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    // channelParameters.remoteVideoTrack.play(remotePlayerContainer);
                }else{
                    // channelParameters.localVideoTrack.play(remotePlayerContainer);
                    channelParameters.remoteVideoTrack.play(localPlayerContainer);
                }
                }

                // ส่ง local video track ใหม่ไปยังผู้ใช้คนที่สอง
                agoraEngine.publish([channelParameters.localVideoTrack]);

                // alert('เปลี่ยนอุปกรณ์กล้องสำเร็จ');
                // console.log('เปลี่ยนอุปกรณ์กล้องสำเร็จ');
            } else {
                // alert('ปิด');
                channelParameters.localVideoTrack.setEnabled(false);
            }

            })
            .catch(error => {
            // alert('ไม่สามารถเปลี่ยนกล้องได้');
            alertNoti('<i class="fa-solid fa-triangle-exclamation fa-shake"></i>', 'ไม่สามารถเปลี่ยนกล้องได้');

            setTimeout(function() {
                document.querySelector('#btn_switchCamera').click();
            }, 2000);

            console.error('เกิดข้อผิดพลาดในการสร้าง local video track:', error);
            });
        }

    function getCurrentVideoDeviceId() {
        const videoDevices = document.getElementsByName('video-device');
        for (let i = 0; i < videoDevices.length; i++) {
            if (videoDevices[i].checked) {
            return videoDevices[i].value;
            }
        }
        return null;
        }


        var now_Mobile_Devices = 1;

        btn_switchCamera.onclick = async function() {

        console.log('btn_switchCamera');

        // console.log('activeVideoDeviceId');
        // console.log(activeVideoDeviceId);

        // เรียกดูอุปกรณ์ทั้งหมด
        const devices = await navigator.mediaDevices.enumerateDevices();

        // เรียกดูอุปกรณ์ที่ใช้อยู่
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: true,
            video: true
        });

        // แยกอุปกรณ์ตามประเภท
        let videoDevices = devices.filter(device => device.kind === 'videoinput');

            console.log('------- videoDevices -------');
            console.log(videoDevices);
            console.log('length ==>> ' + videoDevices.length);
            console.log('------- ------- -------');

        // สร้างรายการอุปกรณ์ส่งข้อมูลและเพิ่มลงในรายการ
        let videoDeviceList = document.getElementById('video-device-list');
            videoDeviceList.innerHTML = '';

        let count_i = 1 ;

        videoDevices.forEach(device => {
            let radio = document.createElement('input');
            radio.type = 'radio';
            radio.id = 'video-device-' + count_i;
            radio.name = 'video-device';
            radio.value = device.deviceId;
            radio.checked = device.deviceId === activeVideoDeviceId;

            let label = document.createElement('label');
            label.classList.add('dropdown-item');
            label.appendChild(radio);
            label.appendChild(document.createTextNode(device.label || `อุปกรณ์ส่งข้อมูล ${videoDeviceList.children.length + 1}`));

            videoDeviceList.appendChild(label);
            radio.addEventListener('change', onChangeVideoDevice);

            count_i = count_i + 1 ;
        });

        // ---------------------------

        // เรียกใช้ฟังก์ชันและแสดงผลลัพธ์
        const deviceType = checkDeviceType();
        console.log("Device Type:", deviceType);

        if (deviceType == 'PC'){
            document.querySelector('.btn_for_select_video_device').click();
        }else{
            let check_videoDevices = document.getElementsByName('video-device');

            if (now_Mobile_Devices == 1){
            // console.log("now_Mobile_Devices == 1 // ให้คลิก ");
            // console.log(check_videoDevices[1].id);
            document.querySelector('#'+check_videoDevices[1].id).click();
            now_Mobile_Devices = 2 ;
            }else{
            // console.log("now_Mobile_Devices == 2 // ให้คลิก ");
            // console.log(check_videoDevices[0].id);
            document.querySelector('#'+check_videoDevices[0].id).click();
            now_Mobile_Devices = 1 ;
            }
        }

        }

        // ตรวจสอบอุปกรณ์ที่ใช้งาน
        function checkDeviceType() {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // ตรวจสอบชนิดของอุปกรณ์
        if (/android/i.test(userAgent)) {
            return "Mobile (Android)";
        }

        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "Mobile (iOS)";
        }

        return "PC";
        }
   </script> --}}

@endsection
