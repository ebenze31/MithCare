

    /* =====================
    map จากการกดรับตำแหน่งบ้าน
    =======================*/

    var marker_select_location;
    var map_select_location;
    var marker_icon_mithcare = "{{url('/img/logo_mithcare/marker/Marker_mithcare.png')}}";

    // const image_sos = "{{ url('/img/icon/operating_unit/sos.png') }}";
    function Open_map_select_location()
    {
        // 13.7248936,100.4930264 lat lng ประเทศไทย
        let lat_text = document.querySelector("#lat");
        let lng_text = document.querySelector("#lng");
        let latlng = document.querySelector("#latlng");

        let lat = parseFloat(lat_text.value) ;
        let lng = parseFloat(lng_text.value) ;

        console.log(lat);
        console.log(lng);

        map_select_location = new google.maps.Map(document.getElementById("map_select_location"), {
            center: {lat: lat, lng: lng },
            zoom: 14,
        });

        if (marker_select_location) {
            marker_select_location.setMap(null);
        }
        marker_select_location = new google.maps.Marker({
            position: {lat: lat , lng: lng },
            map: map_select_location,
            icon: marker_icon_mithcare,
        });

        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
            // content: "คลิกที่แผนที่เพื่อรับโลเคชั่น",
            // position: myLatlng,
        });

        infoWindow.open(map_select_location);
        // Configure the click listener.
        map_select_location.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                // position: mapsMouseEvent.latLng,
            });

            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );

            let text_content = infoWindow.content ;

            // console.log(text_content)

            const contentArr = text_content.split(",");

            const lat_Arr = contentArr[0].split(":");

                let marker_lat = lat_Arr[1];

            const lng_Arr = contentArr[1].split(":");

                let marker_lng = lng_Arr[1].replace("\n}", "");

            // console.log(marker_lat)
            // console.log(marker_lng)

            let lat = parseFloat(marker_lat) ;
            let lng = parseFloat(marker_lng) ;



            let center_lat_map_show = document.querySelector('#center_lat_map_show') ;
            let center_lng_map_show = document.querySelector('#center_lng_map_show') ;
                center_lat_map_show.value = marker_lat ;
                center_lng_map_show.value = marker_lng ;

            addMarker_select_location(marker_lat , marker_lng);

            infoWindow.open(map_select_location);

            // add_location(text_content,  map_sos , marker_lat , marker_lng)
            // check_area_new();
        });
    }

    function addMarker_select_location(marker_lat , marker_lng) {

        if(marker_select_location){
            marker_select_location.setMap(null);
        }
            marker_select_location = new google.maps.Marker({
            position: {lat: parseFloat(marker_lat) , lng: parseFloat(marker_lng) },
            // label: {text: count_position.value, color: "white"},
            map: map_select_location,
            icon: marker_icon_mithcare,
        });

        document.querySelector("#lat").value = marker_lat;
        document.querySelector("#lng").value = marker_lng;
        document.querySelector("#latlng").value = marker_lat + ',' + marker_lng;
    }



