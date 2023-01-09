 <!--//////// Sidebar ////////-->
        <!-- <div class="contact-panel col-md-3 mb-2">
            <div class="contact-panel__form">
                <div class="contact-panel__title h4" style="color: black;">  เมนู</div>                         
                <hr>
                <div class="ontact-panel__desc">
                    <ul class="nav" role="tablist">
                        <li role="presentation">
                            <a href="{{ url('/room') }}" class="h5 " >
                                จัดการบ้าน
                            </a>
                        </li>
                        <li role="presentation" class="col-12">
                            <a href="{{ url('/room_find') }}" class="h5 " >
                                ค้นหาบ้าน
                            </a>
                        </li>
                        <li role="presentation" class="col-12">
                            <a href="{{ url('/room_find') }}" class="h5 " >
                                ADMIN HOME
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> -->

            <div class="widget widget-categories col-md-3 mb-2">
                <h5 class="widget__title"><i class="fa-solid fa-bars "></i> เมนู</h5>
                <div class="widget-content">
                  <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/room') }}"><span class="cat-count"><i class="fa-solid fa-house"></i></span><span  class="h5">จัดการบ้าน</span></a></li>
                    <li><a href="{{ url('/room_find') }}"><span class="cat-count"><i class="fa-solid fa-house-day"></i></span><span class="h5">ค้นหาบ้าน</span></a></li>
                    <li><a href="{{ url('/room_admin') }}"><span class="cat-count"><i class="fa-solid fa-house-heart"></i></span><span class="h5">ADMIN HOME</span></a></li>                   
                  </ul>
                </div><!-- /.widget-content -->
            </div>
<!--////// End Sidebar /////////-->
