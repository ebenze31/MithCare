@extends('layouts.mithcare')

@section('content')
    <style>
        #data_video_call {
            height: calc(40vh);

            /* background-color: #3490dc; */
            border-color: #3490dc;
            border-style: solid;
        }
    </style>
    <input class="d-none" type="text" id="textbox" />

    <div id='app'></div>
    <center>
        <div class="container ">

            <h3 class="text-center">Get started with video calling</h3>
            <div class="row d-flex justify-content-center ">
                <div>
                    <button class="btn-old btn-primary" type="button" id="join">เข้าร่วม</button>
                    <button class="btn-old btn-danger" type="button" id="leave">ออก</button>
                </div>
            </div>

            <div class="col-12 mt-2">

                <div class="mt-2" id="data_video_call"></div>

                <button type="button" id="muteAudio" class="btn-old btn-primary mt-2"><i
                        class="fa-solid fa-microphone"></i></button>
                {{-- <button  id="toggle_video_btn" class="btn-old btn-success open"><i class="fa-solid fa-video"></i></button> --}}
                <button type="button" class="btn-old btn-success mt-2" id="muteVideo"><i
                        class="fa-solid fa-video"></i></button>
            </div>
        </div>
    </center>

    {{-- <button type="button" id="inItScreen">Share Screen</button> --}}

    {{-- <br><label> Local Audio Level :</label>
        <input type="range" min="0" id= "localAudioVolume" max="100" step="1"><br>
        <label> Remote Audio Level :</label>
        <input type="range" min="0" id= "remoteAudioVolume" max="100" step="1"> --}}



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
                    appId: 'acb41870f41c48d4a42b7b0ef1532351',

                    appCertificate: '41aa313ac49f4e3d81f1a3056e122ca0',

                    currentTimestamp: Math.floor(Date.now() / 1000),

                    expirationTimeInSeconds: 3600,

                    privilegeExpiredTs: Math.floor(Date.now() / 1000) + 3600,
                    // Set the channel name.
                    channel: 'MithCare',
                    // Pass your temp token here.
                    // token: '007eJxTYLh98vS2m9c/F7/wyaq/x7z0RfHOu2GT91gYGIq+rjA4V6yiwJCYnGRiaGFukGZimGxikWKSaGKUZJ5kkJpmaGpsZGxquPWLTkpDICODcnAaIyMDBIL4HAy+mSUZzolFqQwMAL+dIqs=',
                    // token: tokenA,
                    // role: RtcRole.PUBLISHER,
                    // Set the user ID.
                    uid: '{{ Auth::user()->id }}',

                    token: "",
                };

                const url = "{{ url('/') }}/api/video_call";
                axios.get(url).then((response) => {
                        console.log("------------------------------------");
                        console.log(response['data']);
                        console.log(">>>>>>>>>>");

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
        let show_data_video = document.querySelector('#data_video_call');

        // setTimeout(function() {
        //     startBasicCall();
        // }, 2000);

        // fetch(url).then(response => response.text())
        //         .then(result => {
        //             console.log(result);
        //         });

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
            document.getElementById('data_video_call').appendChild(remotePlayerContainer);
            // Dynamically create a container in the form of a DIV element to play the local video track.
            const localPlayerContainer = document.createElement('div');
            document.getElementById('data_video_call').appendChild(localPlayerContainer);
            // Specify the ID of the DIV container. You can use the uid of the local user.
            localPlayerContainer.id = options.uid;
            // Set the textContent property of the local video container to the local user id.
            localPlayerContainer.textContent = "Local user " + options.uid;
            // Set the local video container size.
            localPlayerContainer.style.width = "640px";
            localPlayerContainer.style.height = "480px";
            localPlayerContainer.style.padding = "15px 5px 5px 5px";
            // Set the remote video container size.
            remotePlayerContainer.style.width = "640px";
            remotePlayerContainer.style.height = "480px";
            remotePlayerContainer.style.padding = "15px 5px 5px 5px";
            // Listen for the "user-published" event to retrieve a AgoraRTCRemoteUser object.
            agoraEngine.on("user-published", async (user, mediaType) => {
                // Subscribe to the remote user when the SDK triggers the "user-published" event.
                await agoraEngine.subscribe(user, mediaType);
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
                    remotePlayerContainer.textContent = "Remote user " + user.uid.toString();
                    // Append the remote container to the page body.
                    document.body.append(remotePlayerContainer);
                    // Play the remote video track.
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
                    // Create a local video track from the video captured by a camera.
                    channelParameters.localVideoTrack = await AgoraRTC.createCameraVideoTrack();
                    // Append the local video container to the page body.
                    document.body.append(localPlayerContainer);
                    // Publish the local audio and video tracks in the channel.
                    await agoraEngine.publish([channelParameters.localAudioTrack, channelParameters
                        .localVideoTrack
                    ]);
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
                    // Leave the channel
                    await agoraEngine.leave();
                    console.log("You left the channel");
                    // Refresh the page for reuse
                    window.location.reload();
                }
            }
        }
        // startBasicCall();

        document.getElementById('muteVideo').onclick = async function() {
            if (isMuteVideo == false) {
                // Mute the local video.
                channelParameters.localVideoTrack.setEnabled(false);
                // Update the button text.
                document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video-slash"></i>';
                isMuteVideo = true;
            } else {
                // Unmute the local video.
                channelParameters.localVideoTrack.setEnabled(true);
                // Update the button text.
                document.getElementById(`muteVideo`).innerHTML = '<i class="fa-solid fa-video"></i>';
                isMuteVideo = false;
            }
        }

        document.getElementById('muteAudio').onclick = async function() {
            if (isMuteAudio == false) {
                // Mute the local video.
                channelParameters.localAudioTrack.setEnabled(false);
                // Update the button text.
                document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
                isMuteAudio = true;
            } else {
                // Unmute the local video.
                channelParameters.localAudioTrack.setEnabled(true);
                // Update the button text.
                document.getElementById(`muteAudio`).innerHTML = '<i class="fa-solid fa-microphone"></i>';
                isMuteAudio = false;
            }
        }

        function toggleMute() {
            // เปลี่ยนแสดงสัญลักษณ์ปุ่ม
            let muteBtn = document.getElementById('mute-btn');

            // ค้นหาอินสแตนซ์ของ Agora Voice SDK
            const agora = AgoraRTC.createClient({
                mode: 'rtc',
                codec: 'vp8'
            });
            // ถ้าไมค์เปิดให้ปิดและเปลี่ยนเป็นเสียงละครั้ง
            if (channelParameters.localAudioTrack.setEnabled(true)) {
                channelParameters.localAudioTrack.setEnabled(false);
                muteBtn.innerHTML = '<i class="fa-solid fa-microphone-slash"></i>';
            } else { // ถ้าไมค์ปิดให้เปิดและเปลี่ยนเป็นเสียงละครั้ง
                channelParameters.localAudioTrack.setEnabled(true);
                muteBtn.innerHTML = '<i class="fa-solid fa-microphone"></i>';

            }
        }

        // function toggleVideo() {
        //   // เปลี่ยนแสดงสัญลักษณ์ปุ่ม
        //   let muteBtn = document.getElementById('toggle_video_btn');

        //   // ค้นหาอินสแตนซ์ของ Agora Voice SDK
        //   const agora = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });
        //   // ถ้าวิดีโอเปิดให้ปิด
        //   if (channelParameters.localVideoTrack.EnableLocalVideo(true)) {

        //     channelParameters.localVideoTrack.setEnabled(false);
        //     muteBtn.innerHTML = '<i class="fa-solid fa-video-slash"></i>';

        //   } else { // ถ้าไมค์ปิดให้เปิด
        //     channelParameters.localVideoTrack.setEnabled(true);
        //     muteBtn.innerHTML = '<i class="fa-solid fa-video"></i>';

        //   }
        // }



        // Remove the video stream from the container.
        function removeVideoDiv(elementId) {
            console.log("Removing " + elementId + "Div");
            let Div = document.getElementById(elementId);
            if (Div) {
                Div.remove();
            }
        };
    </script>
@endsection
