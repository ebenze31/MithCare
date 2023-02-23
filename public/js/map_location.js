function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
      navigator.geolocation.getCurrentPosition(initMap);

      // navigator.geolocation.getCurrentPosition(geocodeLatLng);
    } else {
      // x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
      let lat_text = document.querySelector("#lat");
      let lng_text = document.querySelector("#lng");
      let latlng = document.querySelector("#latlng");

      lat_text.value = position.coords.latitude ;
      lng_text.value = position.coords.longitude ;
      latlng.value = position.coords.latitude+","+position.coords.longitude ;

      let lat = parseFloat(lat_text.value) ;
      let lng = parseFloat(lng_text.value) ;

      // console.log(lat);
      // console.log(lng);

    //   let location_users = document.querySelector("#location_user");
    //       location_users.innerHTML = '<a class=" shadow-box text-white btn btn-primary shadow" style="position:absolute;margin-top:-100px;margin-left:10px;border-radius:10px" id="submit"><i class="fas fa-search-location"></i></a>';
    //   check_area(lat,lng);
  }

  function initMap(position) {

      let lat_text = document.querySelector("#lat");
      let lng_text = document.querySelector("#lng");
      let latlng = document.querySelector("#latlng");

      lat_text.value = position.coords.latitude ;
      lng_text.value = position.coords.longitude ;
      latlng.value = position.coords.latitude+","+position.coords.longitude ;

      let lat = parseFloat(lat_text.value) ;
      let lng = parseFloat(lng_text.value) ;

      const map = new google.maps.Map(document.getElementById("map_google_ask_for_help"), {
          zoom: 15,
          center: { lat: lat, lng: lng },
          mapTypeId: "terrain",
      });
      // 40.7504479,-73.9936564,19

      // ตำแหน่ง USER
      const user = { lat: lat, lng: lng };
      const marker_user = new google.maps.Marker({ map, position: user });


  }

