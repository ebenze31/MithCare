@extends('layouts.mithcare_outbar')

@section('content')

<style>
/*=======================================
            global css Computer
    =======================================*/
    @media screen and (min-width: 1024px){
    body,html,main{
        width: 100%;
        height: 100%;
    }
    .video-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        overflow: hidden; /* เพื่อไม่ให้เกิดการเลื่อนเมาส์เพื่อดูเนื้อหาในส่วนล่าง */
    }
    .bg-black{
        background-color: black;
    }
    .clockDuration{
        font-size: 18px;
        width: 15%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .DateTimeDiv{
        font-size: 18px;
        text-align: right;
        width: 15%;
        display: flex;
        justify-content: center;
        align-items: center;
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
        flex-direction: column;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 90%;
    }
    .ButtonDiv{
        background-color: #343336 !important;
        display: flex;
        flex-direction: row;
        /* align-items: center; */
        width: 100%;
        height: 10%;
    }
    .buttonVideo{ /*Div ใหญ่ ของเหล่า ปุ่ม */
        width: 70%;
        display: flex;
        justify-content: center;
        align-items: center;
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
    .VoiceLocalEffect{
        box-shadow: rgb(85, 91, 255) 0px 0px 0px 3px, rgb(31, 193, 27) 0px 0px 0px 6px, rgb(255, 217, 19) 0px 0px 0px 9px, rgb(255, 156, 85) 0px 0px 0px 12px, rgb(255, 85, 85) 0px 0px 0px 15px;
        border-radius: 10px;
    }
    .computer_d_none{ /* d-none แค่ pc*/
        display: none !important;
    }
    .containerAlert {
        transform: scale(0);
        position: absolute;
        bottom: 8rem;
        /* เปลี่ยนจาก top: 10px; เป็น top: 50%; */
        /* outline: #000 1px solid; */
        margin-left: 1rem;
        /* width: 100%; */
        display: flex !important;
        justify-content: start !important;
        align-items: center !important;
        color: #85e260 !important;
        z-index: 999;
    }
    .alertStatus {
        /* transform: scale(0); */
        font-size: 20px;
        background-color: rgba(0, 0, 0, 0.3) !important;
        color: #fff !important;
        padding: 3px 10px !important;
        border-radius: 1rem !important;
    }

    #iconAlert {
        margin-right: .5rem;
    }
    .scaleUpDown {
        animation-name: scaleupanddown;
        animation-duration: 10s;
        transform: scale(0);
    }
    .scaleUpDownV2 {
        animation-name: scaleupanddownV2;
        animation-duration: 60s;
        transform: scale(0);
    }

    @keyframes scaleupanddown {
        0% {
            transform: scale(0);
        }
    /* Change the percentage here to make it faster */
        3% {
            transform: scale(1);
        }

    /* Change the percentage here to make it stay down for longer */
        99% {
            transform: scale(1);
        }

    /* Keep this at the end */
        100% {
            transform: scale(0);
        }
    }

    @keyframes scaleupanddownV2 {
        0% {
            transform: scale(0);
        }

        3% {
            transform: scale(1);
        }


        90% {
            transform: scale(1);
        }


        100% {
            transform: scale(0);
        }
    }
    .ShareScreenVideoCall{ /* วิดีโอจอใหญ่ของ remote */
        /* flex-grow: 1;
        flex-basis: 50%; */
        /* height: 70% !important;
        width: 60% !important;
        position: relative; */
        margin: 1rem;
        width: 70%;
        height: 70%;
        position: absolute;
        top: 2%;
        display: flex;
        justify-content: center;
        border-radius: 10px;
    }
    .ShareScreenVideoCall div {
        border-radius: 10px;
    }


    /*=======================================
            localPlayer css Computer
    =======================================*/
    .localPlayerVideoCall{ /* วิดีโอจอใหญ่ของ local */
        height: 75% !important;
        width: 80% !important;
        position: relative;
    }
    .localPlayerVideoCall div {
        border-radius: 10px;
    }
    .localAfterSubscribe{ /* วิดีโอจอเล็กหลัง subscribe ของ local */
        /* flex-grow: 1;
        flex-basis: 50%; */
        height: 45% !important;
        width: 50% !important;
        position: relative;
        margin: 1rem;
    }
    .LocalPlayerInScreenShare{
        margin: 1rem;
        border-radius: 10px;
        width: 15%;
        height: 15%;
        position: absolute;
        left: 50%;
        bottom: 9%;
        background-color: rgb(61, 168, 187);
        display: flex;
        justify-content: center;
        /* align-items: center; */
    }
    .localAfterSubscribe div {
        border-radius: 10px;
    }
    .imgdivLocal{  /*กรอบรูปโปรไฟล์ local*/
        width: 250px;
        height: 250px;
        border: 1px solid black;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        /* border-radius: 50% !important; */
        z-index: 1;
    }
    .imgdivLocal img{  /*รูปโปรไฟล์ local*/
        border-radius: 50% !important;
        width: 250px;
        height: 250px;
    }
    .profileNameLocal{
        color: #ffffff;
        text-align: center;
    }
    .namedivLocal{
        background-color: #343336;
        position: absolute;
        padding: 0.2rem !important;
        right: 1rem !important;
        bottom: 1rem !important;
        /* transform: translate(-50%, -50%); */
        border-radius: 2px !important;
        z-index: 1;
    }
    /* .sharescreen{
        transform: scaleX(-1);
    } */
    .switchCameraFR{
        display: none;
    }

    /*=======================================
            remotePlayer css Computer
    =======================================*/

    .remotePlayerVideoCall{ /* วิดีโอจอใหญ่ของ remote */
        /* flex-grow: 1;
        flex-basis: 50%; */
        /* height: 45% !important;
        width: 50% !important;
        position: relative; */

    }
    .remotePlayerVideoCall div {
        border-radius: 10px;
    }
    .RemotePlayerInScreenShare{
        margin: 1rem;
        border-radius: 10px;
        width: 15%;
        height: 15%;
        position: absolute;
        left: 34%;
        bottom: 9%;
        background-color: rgb(187, 61, 61);
        display: flex;
        justify-content: center;
        /* align-items: center; */
    }
    .buttonVideo2{
        position: absolute;
        bottom: 1rem;
        left: 1rem;
    }
    .buttonVideo2 div{
        margin-right: 0.5rem;
        font-size: 0.8rem !important;
        padding: 0 !important;
        width: 2.5rem !important;
        height: 2.5rem !important;
    }
    .buttonVideo2 div i{
        margin-top: 0.1 !important;
    }
    .unmuteRemote{
        border-radius: 50% !important;
        width: 3.5rem !important;
        height: 3.5rem !important;
        font-size: 1rem !important;
        background-color: rgba(0,0,0,0.6);
        color: #ffffff;
    }
    .muteRemote{
        border-radius: 50% !important;
        width: 3.5rem !important;
        height: 3.5rem !important;
        font-size: 1rem !important;
        background-color: #db2d2e !important;
        color: #ffffff;
    }
    .imgdivRemote{  /*กรอบรูปโปรไฟล์ local*/
        width: 250px;
        height: 250px;
        border: 1px solid black;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50% !important;
        z-index: 1;
    }
    .imgdivRemote img{  /*รูปโปรไฟล์ local*/
        border-radius: 50% !important;
        width: 250px;
        height: 250px;
    }
    .profileNameRemote{
        color: #ffffff;
        text-align: center;
    }
    .namedivRemote{
        background-color: #343336;
        position: absolute;
        padding: 0.2rem !important;
        right: 1rem !important;
        bottom: 1rem !important;
        /* transform: translate(-50%, -50%); */
        border-radius: 2px !important;
        z-index: 1;
    }
    #remotePlayerContainer { /*พื้นหลังดำ ??*/
        background-color: black;
        visibility: hidden;
    }
    /*=========================
            Sidebar
    =========================*/
    .SidebarDiv{

    }
    #body-row {
        margin-left:0;
        margin-right:0;
    }
    #sidebar-container {
        min-height: 100vh;
        background-color: #c9c9c9;
        padding: 0;
        position:fixed;
        right:0;
        top: 0;
    }

    /* Sidebar sizes when expanded and expanded */
    .sidebar-expanded {
        width: 300px;
    }
    .sidebar-collapsed {
        width: 60px;
    }

    /* Menu item*/
    #sidebar-container .list-group a {
        height: 50px;
        color: white;
    }

    /* Submenu item*/
    #sidebar-container .list-group .sidebar-submenu a {
        height: 45px;
        padding-left: 30px;
    }
    .sidebar-submenu {
        font-size: 0.9rem;
    }

    /* Separators */
    .sidebar-separator-title {
        background-color: #333;
        height: 35px;
    }
    .sidebar-separator {
        background-color: #333;
        height: 25px;
    }
    .logo-separator {
        background-color: #333;
        height: 60px;
    }

    /* Closed submenu icon */
    #sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
    content: " \f0d7";
    font-family: FontAwesome;
    display: inline;
    text-align: right;
    padding-left: 10px;
    }
    /* Opened submenu icon */
    #sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
        content: " \f0da";
        font-family: FontAwesome;
        display: inline;
        text-align: right;
        padding-left: 10px;
    }
}
</style>

<div class="video-container">
    <div id='MainVideoDiv' class="MainVideoDiv" >
        {{-- <div id='ScreenShareVideoMain' class="ShareScreenVideoCall ">
            <div id="ScreenShareContainer" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: rgb(61, 187, 92); " class="">
                <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>
            </div>
        </div>
        <div id='localVideoMain' class="localAfterSubscribe">
            <div id="LocalContainer" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: rgb(187, 61, 61); " class="">
                <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>
            </div>
        </div>
        <div id='remoteVideoMain' class="remotePlayerVideoCall ">
            <div id="RemoteContainer" style="width: 100%; height: 100%; position: relative; overflow: hidden; background-color: rgb(61, 168, 187); " class="">
                <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; object-fit: cover;"></video>
            </div>
        </div> --}}


        <div id='ScreenShareVideoMain' class="ShareScreenVideoCall" style="background-color: rgb(61, 187, 92);">
            <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; object-fit: cover;"></video>
        </div>
        <div class="d-flex justify-content-between">
            <div id='remoteVideoMain' class="RemotePlayerInScreenShare">
                <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; object-fit: cover;"></video>
            </div>
            <div id='localVideoMain' class="LocalPlayerInScreenShare">
                <video class="agora_video_player" playsinline="" muted="" style="width: 100%; height: 100%; object-fit: cover;"></video>
            </div>
        </div>


    </div>



    <div id='ButtonDiv' class="ButtonDiv">
        {{-- <button class="btn btn-secondary" id="btn_switchCamera" onclick="switchCamera();">
                    <i class="fa-solid fa-camera-rotate"></i>
        </button> --}}
        <div id="timeCountVideo" class="clockDuration mobile_d_none"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide submenus
    var collapseElements = document.querySelectorAll('#body-row .collapse');
    for (var i = 0; i < collapseElements.length; i++) {
        var collapseElement = collapseElements[i];
        collapseElement.classList.remove('show');
    }

    // Collapse/Expand icon
    var collapseIcon = document.getElementById('collapse-icon');
    collapseIcon.classList.add('fa-angle-double-left');

    // Collapse click
    var sidebarCollapseElements = document.querySelectorAll('[data-toggle=sidebar-colapse]');
    for (var j = 0; j < sidebarCollapseElements.length; j++) {
        var sidebarCollapseElement = sidebarCollapseElements[j];
        sidebarCollapseElement.addEventListener('click', function() {
        sidebarCollapse();
        });
    }

  function sidebarCollapse() {
    var menuCollapsedElements = document.querySelectorAll('.menu-collapsed');
    for (var k = 0; k < menuCollapsedElements.length; k++) {
        var menuCollapsedElement = menuCollapsedElements[k];
        menuCollapsedElement.classList.toggle('d-none');
    }

        var sidebarSubmenuElements = document.querySelectorAll('.sidebar-submenu');
    for (var l = 0; l < sidebarSubmenuElements.length; l++) {
        var sidebarSubmenuElement = sidebarSubmenuElements[l];
        sidebarSubmenuElement.classList.toggle('d-none');
    }

        var submenuIconElements = document.querySelectorAll('.submenu-icon');
    for (var m = 0; m < submenuIconElements.length; m++) {
        var submenuIconElement = submenuIconElements[m];
        submenuIconElement.classList.toggle('d-none');
    }

    var sidebarContainer = document.getElementById('sidebar-container');
    sidebarContainer.classList.toggle('sidebar-expanded');
    sidebarContainer.classList.toggle('sidebar-collapsed');

    // Collapse/Expand icon
    collapseIcon.classList.toggle('fa-angle-double-left');
    collapseIcon.classList.toggle('fa-angle-double-right');
    }
});

</script>


@endsection
