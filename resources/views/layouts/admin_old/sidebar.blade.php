<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar" >

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon ">
            <img src="{{ asset('/img/logo_mithcare/x-icon.png') }}" width="40px" class="logo-dark" alt="logo">
        </div>
        <div class="sidebar-brand-text mx-3">MithCare </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/room_admin') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold" >ห้องแอดมิน</span></a>
    </li>
    <li class="nav-item" >
        <a class="nav-link" href="{{ url('/ask_for_help') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold" >ขอความช่วยเหลือ</span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/health_check') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold" >ไฟล์ตรวจสุขภาพ</span></a>
    </li> --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/category') }}">
            <i class="fas fa-circle"></i>
            <span style="color:black ; font-weight:bold" >จัดการหมวดหมู่</span></a>
    </li> --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/detail') }}">
            <i class="fas fa-circle"></i>
            <span>คำร้อง</span></a>
    </li> --}}

</ul>
<!-- End of Sidebar -->
