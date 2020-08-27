
    var im = baseURL+"assets/images/marker.png";
    function locate(){
        navigator.geolocation.getCurrentPosition(initMap,fail);
    }
     function fail(){
        //initMap();
         console.log('navigator.geolocation failed, may not be supported');
     }

    function initMap(position) {
        var myLatLng;

        var latitude = point_lat;
        var longitude = point_long;

        //if(position!=undefined) {
        //  latitude = position.coords.latitude;
        //  longitude = position.coords.longitude;
        //}
        //console.log(position);
        myLatLng = new google.maps.LatLng(latitude, longitude);

        var mapOptions = {
          zoom: 13,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = null;
        var userMarker = null;


            map = new google.maps.Map(document.getElementById('map'),
                                          mapOptions);
            userMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: im,
                /*//draggable:true*/
            });




        //var input = document.getElementById('searchInput');
        //setTimeout(function(){
        //  $("#searchInput").val(document.getElementById('location').innerHTML);
        //},500);

        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        /*
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        */
        /*
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            icon: "{base_url}assets/images/marker.png",
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            /*draggable:true*/

          /*
        });
        */
        //dragger
        /*
        google.maps.event.addListener(marker, 'dragend', function()
        {
            geocodePosition(marker.getPosition());
        });
        google.maps.event.addListener(marker, 'dragend', function(evt){
            console.log('Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3));
            document.getElementById('lat').innerHTML = evt.latLng.lat().toFixed(3);
            document.getElementById('lon').innerHTML = evt.latLng.lng().toFixed(3);
      $("#point_lat").val(evt.latLng.lat().toFixed(3));
      $("#point_long").val(evt.latLng.lng().toFixed(3));
        });
        */
        /*
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(15);
            }
            marker.setIcon(({
                icon: "{base_url}assets/images/marker.png",
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            //Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                    document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'country'){
                    document.getElementById('country').innerHTML = place.address_components[i].long_name;
                }
            }
            document.getElementById('location').innerHTML = place.formatted_address;
            document.getElementById('lat').innerHTML = place.geometry.location.lat();
            document.getElementById('lon').innerHTML = place.geometry.location.lng();
      $("#point_lat").val(place.geometry.location.lat());
      $("#point_long").val(place.geometry.location.lng());
        });
        */


    }
      /*
        function geocodePosition(pos)
        {
           geocoder = new google.maps.Geocoder();
           geocoder.geocode
            ({
                latLng: pos
            },
                function(results, status)
                {
                    if (status == google.maps.GeocoderStatus.OK)
                    {
                        document.getElementById('location').innerHTML = results[0].formatted_address;
                        document.getElementById('addr').innerHTML = results[0].formatted_address;
                        console.log(results[0].formatted_address);
                    }
                    else
                    {
                        console.log('Cannot determine address at this location.'+status);
                    }
                }
            );
        }
        */
        //dragger
$(document).ready(function(){
  $(".pic").on("click", function() {
     $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
     $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });

  initMap(null);
});
