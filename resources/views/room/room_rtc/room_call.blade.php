@extends('layouts.mithcare_outbar')

@section('content')
    <style>
        /*=======================================
                    global css Computer
         =======================================*/
        .bg-black{
            background-color: black;
        }
        .videoCallArea{ /* div ใหญ่ที่ใส่ local remote container*/

            min-height: 40rem;
            max-height: 100%;
            /* border-color: #ade9d2;
            border-style: solid; */
            border-radius: 10px;
            background-color: #acd2f1;
            margin: 2px;
        }
        video{ /* ตกแต่ง tag video ที่ agora สร้างมา*/
            border-color: #3490dc;
            border-style: solid;
            border-radius: 10px;

            position: relative;
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            overflow: hidden;
        }
        .MainVideoDiv{
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            padding: 2rem;
        }
        .buttonVideo{ /*Div ใหญ่ ของเหล่า ปุ่ม */
            /* background-color: #051407; */
            position: absolute;
            bottom: 0.5rem;
            left: 50%;
            transform: translateX(-50%);
        }
        .buttonVideo button{
            margin-right: 0.5rem;
        }
        .btn-old{ /* ปุ่มทั้งหมด */
            border-radius: 50% !important;
            width: 3.5rem !important;
            height: 3.5rem !important;
            font-size: 1rem !important;
            background-color: rgba(0,0,0,0.6);
            color: #ffffff;
        }
        .btn-old i{ /* ไอคอนในปุ่มทั้งหมด*/
            margin-top: .5rem !important;
        }
        .btn-disabled{ /* ปุ่มขณะถูกปิด ขึ้นสีแดง*/
            background-color: #db2d2e !important;
            color: #ffffff;
        }
        #muteAudio2 {
            position: absolute;
            bottom: 0.5rem;
            left: 0.5;
        }
        #muteVideo2{
            position: absolute;
            bottom: 0.5rem;
            left: 0.8;
        }

        /*=======================================
                localPlayer css Computer
        =======================================*/
        .localPlayerVideoCall{ /* วิดีโอจอใหญ่ของ local */
            height: 400px !important;
            width: 60% !important;
            margin-right: auto!important;
	        margin-left: auto!important;
            margin-top: auto!important;
	        margin-bottom: auto!important;
        }
        .localPlayerVideoCall div {
            border-radius: 10px;
        }
        .localAfterSubscribe{ /* วิดีโอจอเล็กหลัง subscribe ของ local */
            height: 500px !important;
            width: 60% !important;
            margin-right: auto!important;
	        margin-left: auto!important;
            margin-top: auto!important;
	        margin-bottom: auto!important;
        }
        .localAfterSubscribe div {
            border-radius: 10px;
        }
        .imgdivLocal{  /*กรอบรูปโปรไฟล์ local*/
            width: 100px;
            height: 100px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }
        .imgLocalHeight{ /*ความกว้างและสูง กรอบรูปโปรไฟล์ local*/
            height: 100%;
            max-height: 100%;
            width: 100%;
            max-width: 100%;
        }

        /*=======================================
                remotePlayer css Computer
        =======================================*/

        .remotePlayerVideoCall{ /* วิดีโอจอใหญ่ของ remote */
            height: 500px !important;
            width: 60% !important;
            margin-right: auto!important;
	        margin-left: auto!important;
            margin-top: auto!important;
	        margin-bottom: auto!important;
        }
        .remotePlayerVideoCall div {
            border-radius: 10px;
        }
        .imgdivRemote{  /*กรอบรูปโปรไฟล์ remote*/
            width: 100px;
            height: 100px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }


        .imgRemoteHeight{ /*ความกว้างและสูง กรอบรูปโปรไฟล์ remote*/
            height: 100%;
            max-height: 100%;
            width: 100%;
            max-width: 100%;
        }
        #remotePlayerContainer { /*พื้นหลังดำ ??*/
            background-color: black;
            visibility: hidden;
        }

    /*=======================================
            CSS สำหรับหน้าจอมือถือ
    =======================================*/

    @media screen and (max-width: 768px) {

        body,html,main{
            width: 100%;
            height: 100%;
        }
        .buttonVideo{ /*Div ใหญ่ ของเหล่า ปุ่ม */
            /* background-color: #051407; */
            position: absolute;
            bottom: 1rem;
            left: 19%;
        }
        .buttonVideo button{
            margin-right: 0.5rem;
        }
        .btn-old{ /* ปุ่มทั้งหมด */
            border-radius: 50% !important;
            width: 3.5rem !important;
            height: 3.5rem !important;
            font-size: 1rem !important;
            background-color: rgba(0,0,0,0.6);
            color: #ffffff;
        }
        .btn-old i{ /* ไอคอนในปุ่มทั้งหมด*/
            margin-top: .5rem !important;
        }
        .btn-disabled{ /* ปุ่มขณะถูกปิด ขึ้นสีแดง*/
            background-color: #db2d2e !important;
            color: #ffffff;
        }
        #leaveVideoCall{ /* ปุ่มวางสาย*/
            background-color: #db2d2e !important;
            color: #ffffff;
        }
        .agora_video_player{ /*class ตัววิดีโอของ local */
            background-color: gray;
        }
        #muteAudio2 {
            display: none;
        }
        #muteVideo2{
            display: none;
        }
        /*=======================================
                localPlayer CSS Mobile
        =======================================*/

        .localVideoCallDiv div div{
            width: 100% !important;
            height: 100% !important;
            border-radius:  10px!important;
        }
        .imgdivLocal{  /* div รูปภาพของ local */
            width: 50px;
            height: 50px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }
        .localPlayerVideoCall{ /* วิดีโอจอใหญ่ของ local */
            height: 100% !important;
            width: 100% !important;
        }
        .localAfterSubscribe{ /* วิดีโอจอเล็กหลัง subscribe ของ local */
            height: 200px !important;
            width: 150px !important;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
            margin: 1rem;
        }
        .localAfterSubscribe div {
            border-radius: 10px;
        }
        /*=======================================
                remotePlayer CSS Mobile
        =======================================*/
        .remoteVideoCallDiv div div{
                width: 100% !important;
                height: 100% !important;
                border-radius:  10px!important;
        }
        .imgdivRemote{
            width: 50px;
            height: 50px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }
        .remotePlayerVideoCall{ /* วิดีโอจอใหญ่ของ remote */
            height: 100% !important;
            width: 100% !important;
        }

    }
    </style>

    <div id='MainVideoDiv' class="MainVideoDiv">
        <div id='localVideoMain' class="localPlayerVideoCall"></div>
        <div id='remoteVideoMain' class="remotePlayerVideoCall"></div>
    </div>

    <div id='app'></div>
    <button class="btn btn-primary d-none" type="button" id="join">เข้าร่วม</button>
    {{-- <center>
        <div class="container-fluid">
            <div id="div_for_videoCall" class="row mt-2 videoCallArea">
                <div class="my-4 col-12 col-md-6 col-lg-6 mx-auto" id="data_video_call"></div>
            </div>
        </div>

    </center> --}}

    <!--เรียกใช้ axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('Agora_Web_SDK_FULL/AgoraRTC_N-4.17.0.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

   <script>
        var options;
        document.addEventListener('DOMContentLoaded', (event) => {
                // console.log("START");

                options = {
                    // Pass your App ID here.
                    appId: '{{ env('AGORA_APP_ID') }}',

                    appCertificate: '{{ env('AGORA_APP_CERTIFICATE') }}',

                    // Set the channel name.
                    channel: 'MithCare',

                    uid: '{{ Auth::user()->id }}',

                    // uname: '{{ Auth::user()->name }}',

                    token: "",
                };

                console.log('----------------------------------------------------------');
                console.log(channelParameters.localVideoTrack);

                const url = "{{ url('/') }}/api/video_call";
                axios.get(url).then((response) => {
                        // console.log(response['data']);
                        options['token'] = response['data'];
                        document.getElementById("join").click();
                    })
                    .catch((error) => {
                        console.log("ERROR HERE");
                        console.log(error);
                    });

                startBasicCall();

            });
   </script>

    <script>
        // import AgoraRTC from "agora-rtc-sdk-ng"
        // var show_data_video = document.querySelector('#data_video_call');
        //     show_data_video.innerHTML = "";

        // var div_for_videoCall = document.querySelector('#div_for_videoCall');

        var MainVideoDiv = document.querySelector('#MainVideoDiv');

        // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด แชร์หน้าจอ
        var isSharingEnabled = false;

        // ใช้สำหรับ เช็คสถานะของปุ่มเปิด-ปิด วิดีโอและเสียง
        var isMuteVideo = false;
        var isMuteAudio = false;


        // ใช้สำหรับ สร้าง bg สีดำให้วิดีโอ
        var closeVideoHTML;

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
        };

        async function startBasicCall() {
            // Create an instance of the Agora Engine
            console.log("-------------------- startBasicCall ------------------");
            // console.log(newToken);

            const agoraEngine = AgoraRTC.createClient({
                mode: "rtc",
                codec: "vp8"
            });

            // Dynamically create a container in the form of a DIV element to play the remote video track.
            const remotePlayerContainer = document.getElementById('remoteVideoMain');

            // Dynamically create a container in the form of a DIV element to play the local video track.
            const localPlayerContainer = document.getElementById('localVideoMain');
            // Specify the ID of the DIV container. You can use the uid of the local user.
            localPlayerContainer.id = options.uid;
            // Set the textContent property of the local video container to the local user id.

            // *************************************************************************** //
            // ******************************** local ************************************ //
            // *************************************************************************** //

            //======================
            //   Profile Local
            //======================

            // ดึงข้อมูลผู้ใช้งานจาก auth
            // const user = {!! json_encode(auth()->user()) !!};

            // // สร้าง element รูปภาพ
            // const imgLocal = document.createElement('img');
            // if(user.avatar){
            //     imgLocal.src = "{{ Auth::user()->avatar }}";
            //     imgLocal.classList.add('imgLocalHeight');

            // }else{
            //     imgLocal.src = "{{ url('/storage') }}" + "/" + "{{ Auth::user()->photo }}";
            //     imgLocal.classList.add('imgLocalHeight');
            // }

            // const nameLocal = document.createElement('div');
            // nameLocal.innerHTML = user.name;
            // // สร้าง element div สำหรับรอบรูปภาพ
            // const imgdivLocal = document.createElement('div');
            //     imgdivLocal.classList.add('imgdivLocal');

            // // เพิ่ม element รูปภาพเข้าไปยัง element div
            // imgdivLocal.appendChild(imgLocal);
            // imgdivLocal.appendChild(nameLocal);
            // localPlayerContainer.appendChild(imgdivLocal);

            //======================
            // END Profile Local
            //======================
            const divForVideoButton = document.createElement('div');
            divForVideoButton.classList.add('buttonVideo');

            MainVideoDiv.appendChild(divForVideoButton);
            //สร้างปุ่ม แชร์หน้าจอ
            const shareScreenButton = document.createElement('button');
                shareScreenButton.type = "button";
                shareScreenButton.id = "shareScreen";
                shareScreenButton.classList.add('btn-old', 'btn-info', 'mt-2');
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

            muteVideoButton.onclick = async function() {
                if (isMuteVideo == false) {
                    // Mute the local video.
                    channelParameters.localVideoTrack.setEnabled(false);
                    // Update the button text.
                    document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                    muteVideoButton.classList.add('btn-disabled');
                    // muteVideoButton.classList.remove('btn-success');
                    isMuteVideo = true;


                } else {
                    // Unmute the local video.
                    channelParameters.localVideoTrack.setEnabled(true);
                    // Update the button text.
                    document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video"></i>';
                    // muteVideoButton.classList.add('btn-success');
                    muteVideoButton.classList.remove('btn-disabled');
                    isMuteVideo = false;


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

            window.onload = function() {
                // Listen to the Join button click event.
                document.getElementById("join").onclick = async function() {
                    // Join a channel.
                    await agoraEngine.join(options.appId, options.channel, options.token, options.uid);
                    // Create a local audio track from the audio sampled by a microphone.
                    channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                    // Create a local video track from the video captured by a camera.[]
                    channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack();

                    // let isAboutTimeCalled = false;
                    // if (isAboutTimeCalled == false) {
                    //     aboutTime();
                    //     isAboutTimeCalled = true;
                    // }

                    // Append the local video container to the page body.
                    // show_data_video.append(localPlayerContainer);

                    // Publish the local audio and video tracks in the channel.
                    await agoraEngine.publish([channelParameters.localAudioTrack, channelParameters.localVideoTrack ]);

                    // Play the local video track.
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    console.log("publish success!");

                    // ShareScreen
                    document.getElementById('shareScreen').onclick = async function () {
                        if(isSharingEnabled == false) {
                            // Create a screen track for screen sharing.
                            channelParameters.screenTrack = await AgoraRTC.createScreenVideoTrack();
                            // Replace the video track with the screen track.
                            await channelParameters.localVideoTrack.replaceTrack(channelParameters.screenTrack, true);
                            // Update the button text.
                            document.getElementById(`shareScreen`).innerHTML = '<i class="fa-solid fa-screencast"></i>';
                            // Update the screen sharing state.
                            isSharingEnabled = true;
                        } else {
                            // Replace the screen track with the local video track.
                            await channelParameters.screenTrack.replaceTrack(channelParameters.localVideoTrack, true);
                            // Update the button text.
                            document.getElementById(`shareScreen`).innerHTML = '<i class="fa-solid fa-screencast"></i>';
                            // Update the screen sharing state.
                            isSharingEnabled = false;
                        }
                    }
                }

                // Listen to the Leave button click event.
                document.querySelector('#leaveVideoCall').addEventListener('click', async function() {
                    // Destroy the local audio and video tracks.
                    channelParameters.localAudioTrack.close();
                    channelParameters.localVideoTrack.close();
                    // Remove the containers you created for the local video and remote video.
                    removeVideoDiv(remotePlayerContainer.id);
                    removeVideoDiv(localPlayerContainer.id);

                    // document.getElementById('timeDiv').remove();

                    // Leave the channel
                    await agoraEngine.leave();
                    console.log("You left the channel -----------------------> ออกแล้วนะ");
                    // Refresh the page for reuse
                    // window.onload();
                    window.history.back();
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

                //======================
                //   Profile Remote
                //======================
                // const urlRemoteUser = "{{ url('/') }}/api/getUserRemote" + "?userId=" + user.uid;
                // // console.log(urlRemoteUser);
                // axios.get(urlRemoteUser).then((response) => {
                //     // console.log("===========================");
                //     // console.log(response['data']);
                //     const userRemote = response['data'];

                //     // สร้าง element รูปภาพ
                //     const imgRemote = document.createElement('img');
                //     if(userRemote['avatar']){
                //         imgRemote.src = userRemote['avatar'];
                //         imgRemote.classList.add('imgRemoteHeight');

                //     }else{
                //         imgRemote.src = "{{ url('/storage') }}" + "/" + userRemote['photo'];
                //         imgRemote.classList.add('imgRemoteHeight');
                //     }
                //     // กำหนดความสูง imgRemote ไม่ให้เกิน imgdivRemote


                //     const nameRemote = document.createElement('div');
                //     nameRemote.innerHTML = userRemote['name'];
                //     const statusRemote = document.createElement('div');
                //     if(userRemote['memberStatus'] === 'patient'){
                //         statusRemote.innerHTML = "ผู้ป่วยระดับ " + userRemote['memberLV'];
                //     }else if(userRemote['memberStatus'] === 'owner'){
                //         statusRemote.innerHTML = "เจ้าของบ้าน";
                //     }else if(userRemote['memberStatus'] === 'member'){
                //         statusRemote.innerHTML = "สมาชิก(ผู้ดูแล)";
                //     }else{
                //         statusRemote.innerHTML = "สมาชิก";
                //     }
                //     // สร้าง element div สำหรับรอบรูปภาพ
                //     const imgdivRemote = document.createElement('div');
                //     imgdivRemote.classList.add('imgdivRemote');


                //     // เพิ่ม element รูปภาพเข้าไปยัง element div
                //     imgdivRemote.appendChild(imgRemote);
                //     imgdivRemote.appendChild(nameRemote);
                //     imgdivRemote.appendChild(statusRemote);
                //     remotePlayerContainer.appendChild(imgdivRemote);

                // })
                // .catch((error) => {
                //     console.log("ERROR HERE");
                //     console.log(error);

                // });
                //======================
                // END Profile Remote
                //======================

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

                    // ชื่อ RemotePlayer
                    // remotePlayerContainer.textContent = "Remote user " + user.uid.toString();

                    // สลับ local ไปเป็นจอเล็กแล้วให้อยู่ขวาบน
                    let local_STR = localPlayerContainer;
                    // let local_STR = document.getElementById('localVideoMain');
                        local_STR.classList.add('localAfterSubscribe');
                        local_STR.classList.remove('localPlayerVideoCall');

                    // สร้าง element div new_remote_video_call
                    if(document.getElementById('remote_video_call_'+ user.uid)){
                        document.getElementById('remote_video_call_'+ user.uid).remove();
                    }

                    let new_remote_video_call = document.createElement('div');
                        new_remote_video_call.setAttribute('class' , 'remotePlayerVideoCall');
                        new_remote_video_call.setAttribute('id' , 'remote_video_call_' + user.uid);

                    let remoteVideoMain = document.createElement('div');
                        remoteVideoMain.setAttribute('id' , 'remoteVideoMain' + user.uid);

                        remoteVideoMain.insertAdjacentHTML('beforeend', new_remote_video_call.outerHTML);

                    // document.querySelector('#remoteVideoMain' + user.uid).append(remotePlayerContainer);
                    remotePlayerContainer.append(remoteVideoMain);
                    // Play the remote video track.

                }

                // Subscribe and play the remote audio track If the remote user publishes the audio track only.
                if (mediaType == "audio") {
                    // Get the RemoteAudioTrack object in the AgoraRTCRemoteUser object.
                    channelParameters.remoteAudioTrack = user.audioTrack;
                    // Play the remote audio track. No need to pass any DOM element.
                    channelParameters.remoteAudioTrack.play();

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
                // สร้างปุ่ม เปิด-ปิด เสียง
                var muteButton2 = document.createElement('div');
                    muteButton2.id = "muteAudio2";

                    if(user.audioTrack){
                        muteButton2.classList.add('btn-old', 'btn-success', 'mt-2');
                        muteButton2.innerHTML = '<i class="fa-solid fa-microphone"></i>';
                    }else{
                        muteButton2.classList.add('btn-old', 'btn-danger', 'mt-2');
                        muteButton2.innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                    }

                    muteButton2.style.position = 'absolute'; // Set position to absolute for the mute button
                    muteButton2.style.bottom = '10px'; // Set the distance from the bottom of the container
                    muteButton2.style.left = '50%'; // Set the distance from the left of the container
                    muteButton2.style.transform = 'translateX(-50%)'; // Center the button horizontally

                    remotePlayerContainer.appendChild(muteButton2);

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
                    muteVideoButton2.style.position = 'absolute'; // Set position to absolute for the mute button
                    muteVideoButton2.style.bottom = '10px'; // Set the distance from the bottom of the container
                    muteVideoButton2.style.right = '50%'; // Set the distance from the left of the container
                    muteVideoButton2.style.transform = 'translateX(-50%)'; // Center the button horizontally

                    remotePlayerContainer.appendChild(muteVideoButton2);

                    if (channelParameters.remoteVideoTrack !== null) { // ตรวจสอบว่าตัวแปร video ไม่เป็น null ก่อนเรียกใช้เมธอด play()
                        channelParameters.remoteVideoTrack.play(remotePlayerContainer);
                    }
                // ---------------------- จบ สร้างปุ่ม เปิด-ปิด เสียง/วิดีโอ ---------------------- //


            });



            // ******************** remotePlayer ปิด ไมค์ กล้อง ออก ********************* //
            // ⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇⬇ //

            // ออกจากห้อง
            agoraEngine.on("user-left", function (evt) {
                console.log("remove id = "+evt.uid);
                document.getElementById(evt.uid).remove();

                // document.getElementById("remote_video_call_" + evt.uid).remove();

                console.log("ลบ local_FULL");
                let local_FULL = localPlayerContainer;
                    local_FULL.classList.add('localPlayerVideoCall');
                    local_FULL.classList.remove('localAfterSubscribe');

                // ---------------------- ลบ BackGround - วิดีโอ ---------------------- //
                if(document.querySelector('#video_trackRemoteDiv')){
                    document.querySelector('#video_trackRemoteDiv').remove();
                }
                // ---------------------- สร้างปุ่ม เปิด-ปิด เสียง/วิดีโอ ------------------- //
                if( document.querySelector('#muteAudio2') ){
                    document.querySelector('#muteAudio2').remove();
                }
                if( document.querySelector('#muteVideo2') ){
                    document.querySelector('#muteVideo2').remove();
                }

                channelParameters.remoteVideoTrack = null;
                channelParameters.remoteAudioTrack = null;
                channelParameters.remoteUid = null;

            });

            // ปิด ไมค์ กล้อง
            agoraEngine.on("user-unpublished", async (user, mediaType) => {

                console.log("------------------- unpublished ------------------");
                console.log("user_id >> " + user.uid);
                console.log("unpublished >> " + mediaType);




                if(mediaType == "video"){

                    console.log('===================== VIDEO ========================')
                    if(user.videoTrack){
                        console.log("กล้อง >> 'เปิด' อยู่");

                        let muteVideoButton2 = document.getElementById(`muteVideo2`);
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video"></i>';
                        muteVideoButton2.classList.add('btn-success');
                        muteVideoButton2.classList.remove('btn-danger');


                    }else{
                        console.log("กล้อง >> 'ปิด' อยู่");

                        let muteVideoButton2 = document.getElementById(`muteVideo2`);
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                        muteVideoButton2.classList.add('btn-danger');
                        muteVideoButton2.classList.remove('btn-success');

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
                    }

                }

                if(mediaType == "audio"){

                    console.log('===================== AUDIO ========================')

                    if(user.audioTrack){
                        console.log("ไมค์ >> 'เปิด' อยู่");
                        let muteButton2 = document.getElementById(`muteAudio2`);
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                        muteButton2.classList.add('btn-primary');
                        muteButton2.classList.remove('btn-danger');
                    }else{
                        console.log("ไมค์ >> 'ปิด' อยู่");
                        let muteButton2 = document.getElementById(`muteAudio2`);
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                        muteButton2.classList.add('btn-danger');
                        muteButton2.classList.remove('btn-primary');
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
    </script>

    <script>
        function aboutTime(){

            //=========================
            // เวลาปัจจุบันของประเทศไทย
            //=========================
            var formattedString = "";
            var nowTimeTH = "";
            var realTime = document.createElement('button');
                realTime.id = "realTime";
                realTime.classList.add('btn','btn-dark','mr-2');

            const timeDiv = document.createElement('div');
                timeDiv.classList.add('col-12','mt-2');
                timeDiv.id = "timeDiv";

            const timeButton = document.createElement('button');
                timeButton.id = "timeButton";
                timeButton.classList.add('btn','btn-dark','mr-2');
                timeButton.innerHTML = '<i class="fa-duotone fa-record-vinyl fa-fade" style="--fa-primary-color: #d70f0f; --fa-secondary-color: #181616; font-size: 20px; padding-left: 3px"></i>';

            refreshTime()

            function refreshTime() {
                const nowTimeTH = new Date();
                const date = {
                    timeZone: 'Asia/Bangkok',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                const time = {
                    timeZone: 'Asia/Bangkok',
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',

                };
                const formattedStringDate = nowTimeTH.toLocaleDateString('th-TH', date);
                const formattedStringTime = nowTimeTH.toLocaleTimeString('th-TH', time);
                realTime.innerHTML = formattedStringDate + '<br>' + formattedStringTime;
            }

            setInterval(refreshTime, 1000); // อัพเดทเวลาทุก ๆ 1 วินาที


            timeDiv.appendChild(realTime);

            timeDiv.appendChild(timeButton);
            div_for_videoCall.insertBefore(timeDiv, div_for_videoCall.firstChild);

            //================
            //    ตัวจับเวลา
            //================

            // ตรวจสอบว่าเวลาเก่าถูกเก็บไว้ใน localStorage หรือไม่
            let storedTime = localStorage.getItem("storedTime");

            // ถ้าเวลาเก่าไม่มีอยู่ใน localStorage ให้ใช้เวลาปัจจุบัน
            if (!storedTime) {
            storedTime = new Date().getTime();
            localStorage.setItem("storedTime", storedTime);
            }

            const minutes = document.createElement('div');
                minutes.id = "minutes";
                minutes.innerHTML = '00';

            const seconds = document.createElement('div');
                seconds.id = "seconds";
                seconds.innerHTML = '00';

            const minutesLabel = document.createElement('span');
                minutesLabel.innerHTML = ':';

            var totalSeconds = 0;

            setInterval(setTime, 1000);

            function setTime() {
                ++totalSeconds;
                seconds.innerHTML = pad(totalSeconds % 60);
                minutes.innerHTML = pad(parseInt(totalSeconds / 60));
            }

            function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                    return "0" + valString;
                } else {
                    return valString;
                }
            }

            // const textMinutes = document.createTextNode(" นาที");

            // timeDiv.appendChild(timeButton);
            timeButton.insertBefore(minutes,timeButton.firstChild);
            timeButton.insertBefore(seconds,timeButton.firstChild.nextSibling);
            timeButton.insertBefore(minutesLabel, timeButton.firstChild.nextSibling);
        }




    </script>

@endsection
