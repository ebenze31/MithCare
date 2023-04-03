@extends('layouts.mithcare')

@section('content')

    <h2 class="left-align">Get started with video calling</h2>
    <div class="row justify-content-around">
        <div>
            <center>
                <button class="btn btn-primary" type="button" id="join">Join</button>
                <button class="btn btn-danger" type="button" id="leave">Leave</button>
            </center>
        </div>
    </div>

    <h1>Agora RTC Demo</h1>
    <div id="me"></div>

<script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.0.0.js"></script>
<!-- <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-4.4.0.js"></script> -->

<!-- <script src="https://cdn.agora.io/sdk/release/AgoraRTC_SDK_for_web-4.5.0.js"></script> -->

<script>
    // Pass your App ID here.
    var appId = 'acb41870f41c48d4a42b7b0ef1532351';
    var channel = 'MithCare';

    var token = '007eJxTYHg9Y+t0SzPLlqSA+gn8m8y7blgcdJnkvNzf9m7ygkWu81sUGBKTk0wMLcwN0kwMk00sUkwSTYySzJMMUtMMTY2NjE0NN4RrpTQEMjJ86vZiZmSAQBCfg8E3syTDObEolYEBAKWzIB8=';


    // เปิด connection กับ Agora RTC ด้วย appId
    const client = AgoraRTC.createClient({mode: 'live', codec: 'vp8'});
    client.init(appId, function () {
      console.log('AgoraRTC client initialized');
    }, function (err) {
      console.log('AgoraRTC client init failed', err);
    });

    // เข้าร่วมห้องแชท
    client.join(null, channel, null, function(uid) {
      console.log('User ' + uid + ' joined channel');
    }, function(err) {
      console.log('Join channel error', err);
    });

    // สร้างและแสดง video stream
    const localStream = AgoraRTC.createStream({
      video: true,
      audio: false,
    });
    localStream.init(function() {
      console.log('getUserMedia successfully');
      localStream.play('me');
    }, function(err) {
      console.log('getUserMedia failed', err);
    });

</script>

@endsection




