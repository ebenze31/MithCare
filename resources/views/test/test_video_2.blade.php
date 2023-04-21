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
        .agora_video_player{
            background-color: black!important;
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
                    <div id="remoteUserBackground"
                    style="width: 100%; height: 100%; position: absolute; overflow: hidden; padding: 15px 5px 15px 5px;">
                        <video class="agora_video_player" playsinline="" muted=""
                        style="width: 95%; position: absolute; left: 0px;  object-fit: cover; background-color: black; ">
                        </video>
                    </div>
                </div>

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

                    token: "",
                };

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
            localPlayerContainer.textContent = "Local user " + options.uid;
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
            }else{
                imgLocal.src = "{{ url('/storage') }}" + "/" + "{{ Auth::user()->photo }}";
            }

            const nameLocal = document.createElement('div');
            nameLocal.innerHTML = user.name;
            // สร้าง element div สำหรับรอบรูปภาพ
            const imgdivLocal = document.createElement('div');
            imgdivLocal.style.width = '100px'; // กำหนดความกว้างของกรอบรูปภาพ
            imgdivLocal.style.height = '100px'; // กำหนดความสูงของกรอบรูปภาพ
            imgdivLocal.style.border = '1px solid black'; // กำหนดเส้นขอบกรอบรูปภาพ
            imgdivLocal.style.position = 'absolute';
            imgdivLocal.style.left = '0';
            imgdivLocal.style.bottom = '0';
            imgdivLocal.style.zIndex = '1';

            // เพิ่ม element รูปภาพเข้าไปยัง element div
            imgdivLocal.appendChild(imgLocal);
            imgdivLocal.appendChild(nameLocal);
            localPlayerContainer.appendChild(imgdivLocal);


            // Create a button element for muting audio
            if (options.uid) {

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
                console.log("subscribe success");
                console.log(user);
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
                    remotePlayerContainer.textContent = "Remote user " + user.uid.toString();
                    // Append the remote container to the page body.
                    remote_video_call.append(remotePlayerContainer);
                    // Play the remote video track.

                    //======================
                    //   Profile Remote
                    //======================

                    // สร้าง element รูปภาพ
                    const imgRemote = document.createElement('img');
                    if(user.avatar){
                        imgRemote.src = "{{ Auth::user()->avatar }}";
                    }else{
                        imgRemote.src = "{{ url('/storage') }}" + "/" + "{{ Auth::user()->photo }}";
                    }

                    const nameRemote = document.createElement('div');
                    nameRemote.innerHTML = user.name;
                    // สร้าง element div สำหรับรอบรูปภาพ
                    const imgdivRemote = document.createElement('div');
                    imgdivRemote.classList.add('imgdivRemote');


                    // เพิ่ม element รูปภาพเข้าไปยัง element div
                    imgdivRemote.appendChild(imgRemote);
                    imgdivRemote.appendChild(nameRemote);
                    remotePlayerContainer.appendChild(imgdivRemote);

                    channelParameters.remoteVideoTrack.play(remotePlayerContainer);

                }
                // Subscribe and play the remote audio track If the remote user publishes the audio track only.
                if (mediaType == "audio") {
                    // Get the RemoteAudioTrack object in the AgoraRTCRemoteUser object.
                    channelParameters.remoteAudioTrack = user.audioTrack;
                    // Play the remote audio track. No need to pass any DOM element.
                    channelParameters.remoteAudioTrack.play();
                }
                // Listen for the "user-unpublished" event.
                agoraEngine.on("user-unpublished", user => {
                    console.log(user.uid + "has left the channel");
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
                        minutesLabel.innerHTML = ' นาที';

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
                    timeButton.insertBefore(minutesLabel, timeButton.firstChild.nextSibling);
                    // timeButton.insertBefore(seconds,timeButton.firstChild);
        }
    </script>
@endsection
