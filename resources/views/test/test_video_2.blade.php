@extends('layouts.mithcare_outbar')

@section('content')
    <style>
        .data_video_call {

            min-height: 30rem;
            max-height: 100%;
            /* background-color: #3490dc; */
            border-color: #3490dc;
            border-style: solid;
        }
        #remoteUserBackground{
            border-color: #3490dc;
            border-style: solid;

            position: absolute;
            left: 0px;
            top: 0px;
            object-fit: cover;
            width: 100%;
            height: 100%;

            overflow: hidden;
        }
        video{
            border-color: #3490dc;
            border-style: solid;

            position: relative;
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            overflow: hidden;
        }
        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .videoHeight{
            height: 25rem;

        }
            @media (max-width: 576px) {
                .videoHeight{
                    height: 15rem;
                }
            }
        .imgdivLocal{
            width: 100px;
            height: 100px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }
            @media (max-width: 576px) {
                .imgdivLocal{
                    width: 50px;
                    height: 50px;
                    border: 1px solid black;
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    z-index: 1;
                }
            }
        .imgdivRemote{
            width: 100px;
            height: 100px;
            max-height: 100px;
            border: 1px solid black;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 1;
        }
            @media (max-width: 576px) {
                .imgdivRemote{
                    width: 50px;
                    height: 50px;
                    border: 1px solid black;
                    position: absolute;
                    left: 0;
                    bottom: 0;
                    z-index: 1;
                }
            }
        .imgLocalHeight{
            height: 100%;
            max-height: 100%;
            width: 100%;
            max-width: 100%;
        }

        .imgRemoteHeight{
            height: 100%;
            max-height: 100%;
            width: 100%;
            max-width: 100%;
        }
        #remotePlayerContainer {
            background-color: black;
            visibility: hidden;
        }


    </style>
    <input class="d-none" type="text" id="textbox" />

    <div id='app'></div>
    <center>
        <div class="container">

            <h3 class="text-center">Get started with video calling</h3>
            <div class="row d-flex justify-content-center ">
                <div >
                    <button class="btn btn-primary" type="button" id="join">เข้าร่วม</button>
                    <button class="btn btn-danger" type="button" id="leave">ออก</button>
                    {{-- <button type="button" class="btn-old btn-primary mt-2" id="muteAudio_beforeJoin">
                        <i class="fa-solid fa-microphone"></i>
                    </button>
                    <button type="button" class="btn-old btn-success mt-2" id="muteVideo_beforeJoin">
                        <i   class="fa-solid fa-video"></i>
                    </button> --}}
                </div>
            </div>

            <div id="div_for_videoCall" class="row mt-2 data_video_call p-3">
                {{-- <label id="minutes">00</label>:<label id="seconds">00</label> --}}
                <p id="time"></p>
                <div class="my-4 col-12 col-md-6 col-lg-6 " id="data_video_call"></div>
                <div class="my-4 col-12 col-md-6 col-lg-6 " id="remote_video_call">
                    <div id="remoteUserBackground" class="d-none"
                        style=" background-color:black; " >
                    </div>
                </div>
                <video id="video_track-video-6-client-e9202_9ab6a" class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%;
                position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>
            </div>
        </div>
    </center>

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
        var show_data_video = document.querySelector('#data_video_call');
            show_data_video.innerHTML = "";

        var div_for_videoCall = document.querySelector('#div_for_videoCall');

        var isMuteVideo = false;
        var isMuteAudio = false;

        var isMuteVideo2 = false;
        var isMuteAudio2 = false;

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
            const remotePlayerContainer = document.createElement("div");
            // Dynamically create a container in the form of a DIV element to play the local video track.
            const localPlayerContainer = document.createElement('div');
            // Specify the ID of the DIV container. You can use the uid of the local user.
            localPlayerContainer.id = options.uid;
            // Set the textContent property of the local video container to the local user id.

             // ชื่อ LocalPlayer
            // localPlayerContainer.textContent = "Local user " + options.uid;

            // Set the local video container size.
            remotePlayerContainer.style.position = 'relative'; // Set position to relative for the container
            localPlayerContainer.style.position = 'relative'; // Set position to relative for the container

            //======================
            //   Profile Local
            //======================

            // ดึงข้อมูลผู้ใช้งานจาก auth
            const user = {!! json_encode(auth()->user()) !!};

            // สร้าง element รูปภาพ
            const imgLocal = document.createElement('img');
            if(user.avatar){
                imgLocal.src = "{{ Auth::user()->avatar }}";
                imgLocal.classList.add('imgLocalHeight');

            }else{
                imgLocal.src = "{{ url('/storage') }}" + "/" + "{{ Auth::user()->photo }}";
                imgLocal.classList.add('imgLocalHeight');
            }

            const nameLocal = document.createElement('div');
            nameLocal.innerHTML = user.name;
            // สร้าง element div สำหรับรอบรูปภาพ
            const imgdivLocal = document.createElement('div');
                imgdivLocal.classList.add('imgdivLocal');

            // เพิ่ม element รูปภาพเข้าไปยัง element div
            imgdivLocal.appendChild(imgLocal);
            imgdivLocal.appendChild(nameLocal);
            localPlayerContainer.appendChild(imgdivLocal);


            // Create a button element for muting audio


                //สร้างปุ่ม เปิด-ปิด เสียง
                const muteButton = document.createElement('button');
                muteButton.type = "button";
                muteButton.id = "muteAudio";
                muteButton.classList.add('btn-old', 'btn-primary', 'mt-2');
                muteButton.innerHTML = '<i class="fa-solid fa-microphone"></i>';

                muteButton.style.position = 'absolute'; // Set position to absolute for the mute button
                muteButton.style.bottom = '10px'; // Set the distance from the bottom of the container
                muteButton.style.left = '50%'; // Set the distance from the left of the container
                muteButton.style.transform = 'translateX(-50%)'; // Center the button horizontally

                localPlayerContainer.appendChild(muteButton);

                //สร้างปุ่ม เปิด-ปิด วิดีโอ
                const muteVideoButton = document.createElement('button');
                muteVideoButton.type = "button";
                muteVideoButton.id = "muteVideo";
                muteVideoButton.classList.add('btn-old', 'btn-success', 'mt-2');
                muteVideoButton.innerHTML = '<i class="fa-solid fa-video"></i>';

                muteVideoButton.style.position = 'absolute'; // Set position to absolute for the mute button
                muteVideoButton.style.bottom = '10px'; // Set the distance from the bottom of the container
                muteVideoButton.style.right = '50%'; // Set the distance from the left of the container
                muteVideoButton.style.transform = 'translateX(-50%)'; // Center the button horizontally

                localPlayerContainer.appendChild(muteVideoButton);

                muteVideoButton.onclick = async function() {
                    if (isMuteVideo == false) {
                        // Mute the local video.
                        channelParameters.localVideoTrack.setEnabled(false);
                        // Update the button text.
                        document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                        muteVideoButton.classList.add('btn-danger');
                        muteVideoButton.classList.remove('btn-success');
                        isMuteVideo = true;

                        // document.querySelector('#remoteUserBackground').classList.toggle('d-none');
                    } else {
                        // Unmute the local video.
                        channelParameters.localVideoTrack.setEnabled(true);
                        // Update the button text.
                        document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video"></i>';
                        muteVideoButton.classList.add('btn-success');
                        muteVideoButton.classList.remove('btn-danger');
                        isMuteVideo = false;

                        // document.querySelector('#remoteUserBackground').classList.toggle('d-none');
                    }
                }

                muteButton.onclick = async function() {
                    if (isMuteAudio == false) {
                        // Mute the local video.
                        channelParameters.localAudioTrack.setEnabled(false);
                        // Update the button text.
                        document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                        muteButton.classList.add('btn-danger');
                        muteButton.classList.remove('btn-primary');
                        isMuteAudio = true;
                    } else {
                        // Unmute the local video.
                        channelParameters.localAudioTrack.setEnabled(true);
                        // Update the button text.
                        document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                        muteButton.classList.add('btn-primary');
                        muteButton.classList.remove('btn-danger');
                        isMuteAudio = false;
                    }
                }

            localPlayerContainer.classList.add('col-12','col-md-6','col-lg-6','videoHeight');
            localPlayerContainer.style.maxWidth = '100%';
            localPlayerContainer.style.padding = "15px 5px 5px 5px";

            remotePlayerContainer.classList.add('col-12','col-md-6','col-lg-6','videoHeight');
            remotePlayerContainer.style.maxWidth = '100%';
            remotePlayerContainer.style.padding = "15px 5px 5px 5px";

            // Listen for the "user-published" event to retrieve a AgoraRTCRemoteUser object.
            agoraEngine.on("user-published", async (user, mediaType) => {
                // Subscribe to the remote user when the SDK triggers the "user-published" event.
                await agoraEngine.subscribe(user, mediaType);
                console.log("------------------- published ------------------");
                console.log("subscribe success");



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
                    channelParameters.remoteUid = user.uid.toString();

                    // ชื่อ RemotePlayer
                    // remotePlayerContainer.textContent = "Remote user " + user.uid.toString();

                    // Append the remote container to the page body.
                    remote_video_call.append(remotePlayerContainer);
                    // Play the remote video track.

                    // if(isMuteVideo == 'true'){
                    //     remotePlayerContainer.style.background = "#000
                    // }
                    // isMuteVideo.on("mute-video", function(evt) {
                    // console.log("กล้องถูกปิดไว้");
                    // // remotePlayerContainer = document.getElementById("remote-video-" + remoteId);
                    // remotePlayerContainer.style.background = "#000

                        //สร้างปุ่ม เปิด-ปิด เสียง
                    if(document.querySelector('#muteAudio2')){
                        // console.log("มี muteVideo2 อยู่naja");

                    }else{
                        var muteButton2 = document.createElement('div');
                            muteButton2.id = "muteAudio2";
                            if(user.audioTrack){
                                muteButton2.classList.add('btn-old', 'btn-primary', 'mt-2');
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
                    }

                    if(document.querySelector('#muteVideo2')){
                        // console.log("มี muteVideo2 อยู่naja");

                    }else{
                        //สร้างปุ่ม เปิด-ปิด วิดีโอ
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
                    }


                    console.log("mediaType >> " + mediaType);

                    console.log('===================== VIDEO ========================')
                    console.log(user.videoTrack);
                    if(user.videoTrack){
                        console.log("กล้อง >> 'เปิด' อยู่");
                        // document.getElementById(`muteVideo2`).innerHTML = "";
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video"></i>';
                        muteVideoButton2.classList.add('btn-success');
                        muteVideoButton2.classList.remove('btn-danger');
                        document.getElementById('remoteUserBackground').classList.add('d-none');
                    }else{
                        console.log("กล้อง >> 'ปิด' อยู่");
                        // document.getElementById(`muteVideo2`).innerHTML = "";
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                        muteVideoButton2.classList.add('btn-danger');
                        muteVideoButton2.classList.remove('btn-success');
                        document.getElementById('remoteUserBackground').classList.remove('d-none');
                    }

                    // console.log('===================== AUDIO ========================')
                    // console.log(user.audioTrack);
                    // if(user.audioTrack){
                    //     console.log("ไมค์ >> 'เปิด' อยู่");
                    //     document.getElementById(`muteAudio2`).innerHTML = "";
                    //     document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                    //     muteButton2.classList.add('btn-primary');
                    //     muteButton2.classList.remove('btn-danger');
                    // }else{
                    //     console.log("ไมค์ >> 'ปิด' อยู่");
                    //     document.getElementById(`muteAudio2`).innerHTML = "";
                    //     document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                    //     muteButton2.classList.add('btn-danger');
                    //     muteButton2.classList.remove('btn-primary');
                    // }



                    //======================
                    //   Profile Remote
                    //======================
                    const urlRemoteUser = "{{ url('/') }}/api/getUserRemote" + "?userId=" + user.uid;
                    console.log(user.uid);
                    console.log(urlRemoteUser);
                    axios.get(urlRemoteUser).then((response) => {
                        // console.log("===========================");
                        // console.log(response['data']);
                        const userRemote = response['data'];

                        // สร้าง element รูปภาพ
                        const imgRemote = document.createElement('img');
                        if(userRemote['avatar']){
                            imgRemote.src = userRemote['avatar'];
                            imgRemote.classList.add('imgRemoteHeight');

                        }else{
                            imgRemote.src = "{{ url('/storage') }}" + "/" + userRemote['photo'];
                            imgRemote.classList.add('imgRemoteHeight');
                        }
                         // กำหนดความสูง imgRemote ไม่ให้เกิน imgdivRemote


                        const nameRemote = document.createElement('div');
                        nameRemote.innerHTML = userRemote['name'];
                        const statusRemote = document.createElement('div');
                        if(userRemote['memberStatus'] === 'patient'){
                            statusRemote.innerHTML = "ผู้ป่วยระดับ " + userRemote['memberLV'];
                        }else if(userRemote['memberStatus'] === 'owner'){
                            statusRemote.innerHTML = "เจ้าของบ้าน";
                        }else if(userRemote['memberStatus'] === 'member'){
                            statusRemote.innerHTML = "สมาชิก(ผู้ดูแล)";
                        }else{
                            statusRemote.innerHTML = "สมาชิก";
                        }
                        // สร้าง element div สำหรับรอบรูปภาพ
                        const imgdivRemote = document.createElement('div');
                        imgdivRemote.classList.add('imgdivRemote');


                        // เพิ่ม element รูปภาพเข้าไปยัง element div
                        imgdivRemote.appendChild(imgRemote);
                        imgdivRemote.appendChild(nameRemote);
                        imgdivRemote.appendChild(statusRemote);
                        remotePlayerContainer.appendChild(imgdivRemote);

                    })
                    .catch((error) => {
                        console.log("ERROR HERE");
                        console.log(error);

                    });

                    channelParameters.remoteVideoTrack.play(remotePlayerContainer);

                }
                // Subscribe and play the remote audio track If the remote user publishes the audio track only.
                if (mediaType == "audio") {
                    // Get the RemoteAudioTrack object in the AgoraRTCRemoteUser object.
                    channelParameters.remoteAudioTrack = user.audioTrack;
                    // Play the remote audio track. No need to pass any DOM element.
                    channelParameters.remoteAudioTrack.play();

                    // console.log("mediaType >> " + mediaType);

                    // console.log('===================== VIDEO ========================')
                    // console.log(user.videoTrack);
                    // if(user.videoTrack){
                    //     console.log("กล้อง >> 'เปิด' อยู่");
                    //     document.getElementById(`muteVideo2`).innerHTML = "";
                    //     document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video"></i>';
                    //     muteVideoButton2.classList.add('btn-success');
                    //     muteVideoButton2.classList.remove('btn-danger');
                    // }else{
                    //     console.log("กล้อง >> 'ปิด' อยู่");
                    //     document.getElementById(`muteVideo2`).innerHTML = "";
                    //     document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                    //     muteVideoButton2.classList.add('btn-danger');
                    //     muteVideoButton2.classList.remove('btn-success');
                    // }

                    console.log('===================== AUDIO ========================')
                    console.log(user.audioTrack);
                    if(user.audioTrack){
                        console.log("ไมค์ >> 'เปิด' อยู่");
                        // document.getElementById(`muteAudio2`).innerHTML = "";
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                        muteButton2.classList.add('btn-primary');
                        muteButton2.classList.remove('btn-danger');
                    }else{
                        console.log("ไมค์ >> 'ปิด' อยู่");
                        // document.getElementById(`muteAudio2`).innerHTML = "";
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                        muteButton2.classList.add('btn-danger');
                        muteButton2.classList.remove('btn-primary');
                    }
                }

                // Listen for the "user-unpublished" event.
                agoraEngine.on("user-unpublished", user => {
                    console.log(user.uid + "has left the channel");
                    console.log("------------------- unpublished ------------------");
                    console.log("mediaType >> " + mediaType);

                    console.log('===================== VIDEO ========================')
                    console.log(user.videoTrack);
                    if(user.videoTrack){
                        console.log("กล้อง >> 'เปิด' อยู่");
                        // document.getElementById(`muteVideo2`).innerHTML = "";
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video"></i>';
                        muteVideoButton2.classList.add('btn-success');
                        muteVideoButton2.classList.remove('btn-danger');
                        document.getElementById('remoteUserBackground').classList.add('d-none');
                    }else{
                        console.log("กล้อง >> 'ปิด' อยู่");
                        // document.getElementById(`muteVideo2`).innerHTML = "";
                        document.getElementById(`muteVideo2`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                        muteVideoButton2.classList.add('btn-danger');
                        muteVideoButton2.classList.remove('btn-success');
                        document.getElementById('remoteUserBackground').classList.remove('d-none');
                    }

                    console.log('===================== AUDIO ========================')
                    console.log(user.audioTrack);
                    if(user.audioTrack){
                        console.log("ไมค์ >> 'เปิด' อยู่");
                        // document.getElementById(`muteAudio2`).innerHTML = "";
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                        muteButton2.classList.add('btn-primary');
                        muteButton2.classList.remove('btn-danger');
                    }else{
                        console.log("ไมค์ >> 'ปิด' อยู่");
                        // document.getElementById(`muteAudio2`).innerHTML = "";
                        document.getElementById(`muteAudio2`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                        muteButton2.classList.add('btn-danger');
                        muteButton2.classList.remove('btn-primary');
                    }
                });

            });
            window.onload = function() {
                // Listen to the Join button click event.

                document.getElementById("join").onclick = async function() {
                    // Join a channel.
                    await agoraEngine.join(options.appId, options.channel, options.token, options.uid);
                    // Create a local audio track from the audio sampled by a microphone.
                    channelParameters.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                    // Create a local video track from the video captured by a camera.[]
                    channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack();

                    let isAboutTimeCalled = false;

                    if (isAboutTimeCalled == false) {
                        aboutTime();
                        isAboutTimeCalled = true;
                    }

                    // Append the local video container to the page body.
                    show_data_video.append(localPlayerContainer);
                    // Publish the local audio and video tracks in the channel.
                    await agoraEngine.publish([channelParameters.localAudioTrack, channelParameters.localVideoTrack ]);

                    // Play the local video track.
                    channelParameters.localVideoTrack.play(localPlayerContainer);
                    console.log("publish success!");


                }
                // Listen to the Leave button click event.
                document.getElementById('leave').onclick = async function() {
                    // Destroy the local audio and video tracks.
                    channelParameters.localAudioTrack.close();
                    channelParameters.localVideoTrack.close();
                    // Remove the containers you created for the local video and remote video.
                    removeVideoDiv(remotePlayerContainer.id);
                    removeVideoDiv(localPlayerContainer.id);

                    // Show Button Before Join
                    // document.getElementById('muteAudio_beforeJoin').classList.remove('d-none');
                    // document.getElementById('muteVideo_beforeJoin').classList.remove('d-none');

                    // Leave the channel
                    await agoraEngine.leave();
                    console.log("You left the channel");
                    // Refresh the page for reuse
                    window.location.reload();
                }
            }

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
                        realTime.classList.add('btn', 'btn-success');

                    const timeDiv = document.createElement('div');
                        timeDiv.classList.add('col-12');
                        timeDiv.id = "timeDiv";

                    const timeButton = document.createElement('button');
                        timeButton.id = "timeButton";
                        timeButton.classList.add('btn',  'btn-success','order-first');
                        timeButton.innerHTML = '<i class="fa-duotone fa-record-vinyl fa-fade" style="--fa-primary-color: #d70f0f; --fa-secondary-color: #181616; font-size: 20px; padding-left: 3px"></i>';
                    refreshTime()

                    function refreshTime() {
                            nowTimeTH = new Date().toLocaleTimeString("en-US", {
                            timeZone: "Asia/Bangkok",
                            hour12: false,
                            hour: "2-digit",
                            minute: "2-digit"
                        });
                        formattedString = nowTimeTH.replace(", ", " - ");
                        formattedString += " น.";
                        realTime.innerHTML = formattedString;
                    }

                    setInterval(refreshTime, 1000); // อัพเดทเวลาทุก ๆ 1 วินาที


                    timeDiv.appendChild(realTime);

                    timeDiv.appendChild(timeButton);
                    div_for_videoCall.insertBefore(timeDiv, div_for_videoCall.firstChild);

                    //================
                    //    ตัวจับเวลา
                    //================
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
