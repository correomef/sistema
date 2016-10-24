<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=placeskey=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA"></script> -->

<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?&key=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA"></script> -->
    <div class="mapa">



			<input  style ="margin-top: 21px; width: 70%; height: 40px; border-radius: 3px; box-shadow: rgba(0, 0, 0, 0.498039) 2px 2px 5px; top: 21px; font-size: 20px;" id="pac-input" class="controls" type="text" placeholder="Escriba la direccion o arrastre el marcador rojo">

    		<div style="width:100%; height:400px" id="mapCanvas"></div>

    		<div style="display:none" id="infoPanel">
    		    <b>Marker status:</b>
    		    <div id="markerStatus"><i>Click and drag the marker.</i></div>
    		    <b>Current position:</b>
    		    <div id="info"></div>
    		    <b>Closest matching address:</b>
    		</div>
    	</div>
    	<script type='text/javascript'>



    	      var geocoder = new google.maps.Geocoder();

    	        function geocodePosition(pos) {
    	          geocoder.geocode({
    	            latLng: pos
    	          }, function(responses) {
    	            if (responses && responses.length > 0) {
    	              updateMarkerAddress(responses[0].formatted_address);
    	            } else {
    	              updateMarkerAddress('Cannot determine address at this location.');
    	            }
    	          });
    	        }

    	        function updateMarkerStatus(str) {
    	          document.getElementById('markerStatus').innerHTML = str;
    	        }

    	       function updateMarkerPosition(latLng) {
    	          document.getElementById('info').innerHTML = [
    	            latLng.lat(),
    	            latLng.lng()
    	          ].join(', ');
    	          document.getElementById('contacto-coordenadas-coordenadas').value = [ latLng.lat(), latLng.lng() ].join(', ');
    	        }

    	        function updateMarkerAddress(str) {
    	          //elemento.val(str);

    	        }

    	        function geolocate() {
    	          if (navigator.geolocation) {
    	            navigator.geolocation.getCurrentPosition(function(position) {
    	              var geolocation = new google.maps.LatLng(
    	                  position.coords.latitude, position.coords.longitude);
    	              var circle = new google.maps.Circle({
    	                center: geolocation,
    	                radius: position.coords.accuracy
    	              });
    	              autocomplete.setBounds(circle.getBounds());
    	            });
    	          }
    	        }

    	    	function initialize() {

    	    	  var coordenadasSTR = document.getElementById('contacto-coordenadas-coordenadas').value;



    	    	  if (coordenadasSTR === ''){
                        coordenadasSTR = '(-31.4241, -64.4998)';
                        coordenadasIniciales = new google.maps.LatLng(-31.4241, -64.4998);}

    	    	  else

					{
						coordenadas = coordenadasSTR.split(',');
    	    	  		coordenadasIniciales = new google.maps.LatLng(coordenadas[0],coordenadas[1]);
    	    	  	}



    	    	  var markers = [];
    	    	  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    	    	  	zoom: 15,
	  		        center: coordenadasIniciales,
	  		        mapTypeId: google.maps.MapTypeId.ROADMAP
    	    	  });


					var marker = new google.maps.Marker({
					map: map,

					draggable: true,

					position: coordenadasIniciales
					});



    	    	  // Create the search box and link it to the UI element.
    	    	  var input = /** @type {HTMLInputElement} */(
    	    	      document.getElementById('pac-input'));
    	    	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    	    	  var searchBox = new google.maps.places.SearchBox(
    	    	    /** @type {HTMLInputElement} */(input));

    	    	  // Listen for the event fired when the user selects an item from the
    	    	  // pick list. Retrieve the matching places for that item.
    	    	  google.maps.event.addListener(searchBox, 'places_changed', function() {
    	    	    var places = searchBox.getPlaces();

    	    	    if (places.length == 0) {
    	    	      return;
    	    	    }
    	    	    for (var i = 0, marker; marker = markers[i]; i++) {
    	    	      marker.setMap(null);
    	    	    }

    	    	    // For each place, get the icon, place name, and location.
    	    	    markers = [];
    	    	    var bounds = new google.maps.LatLngBounds();

	    	    	    for (var i = 0, place; place = places[i]; i++) {


	    	    	      // Create a marker for each place.
	    	    	      var marker = new google.maps.Marker({
	    	    	        map: map,

	    	    	        draggable: true,
	    	    	        title: place.name,
	    	    	        position: place.geometry.location
	    	    	      });

	    	    	      markers.push(marker);

	    	    	      bounds.extend(place.geometry.location);
	    	    	      console.log(place.geometry.location.F);
	    	    	      document.getElementById('contacto-coordenadas-coordenadas').value = place.geometry.location.A+','+place.geometry.location.F;
	    	    	    }

    	    	    map.fitBounds(bounds);

					google.maps.event.addListener(map, 'bounds_changed', function() {
	    	    	    var bounds = map.getBounds();
	    	    	    searchBox.setBounds(bounds);
	    	    	  });


    	    	    // Add Suelte en la posicion deceada event listeners.
    	    	    google.maps.event.addListener(marker, 'dragstart', function() {
    	    	      updateMarkerAddress('Suelte en la posicion deceada...');
    	    	    });

    	    	    google.maps.event.addListener(marker, 'drag', function() {
    	    	      updateMarkerStatus('Suelte en la posicion deceada...');
    	    	      updateMarkerPosition(marker.getPosition());
    	    	    });

    	    	    google.maps.event.addListener(marker, 'dragend', function() {
    	    	      updateMarkerStatus('Drag ended');
    	    	      geocodePosition(marker.getPosition());
    	    	    });


    	    	  });

    	    	  // Bias the SearchBox results towards places that are within the bounds of the
    	    	  // current map's viewport.
    	    	  google.maps.event.addListener(map, 'bounds_changed', function() {
    	    	    var bounds = map.getBounds();
    	    	    searchBox.setBounds(bounds);
    	    	  });


    	    	  // Update current position info.
    	    	  updateMarkerPosition(coordenadasIniciales);
    	    	  geocodePosition(coordenadasIniciales);

    	    	  // Add Suelte en la posicion deceada event listeners.
    	    	  google.maps.event.addListener(marker, 'dragstart', function() {
    	    	    updateMarkerAddress('Suelte en la posicion deceada...');
    	    	  });

    	    	  google.maps.event.addListener(marker, 'drag', function() {
    	    	    updateMarkerStatus('Suelte en la posicion deceada...');
    	    	    updateMarkerPosition(marker.getPosition());
    	    	  });

    	    	  google.maps.event.addListener(marker, 'dragend', function() {
    	    	    updateMarkerStatus('Drag ended');
    	    	    geocodePosition(marker.getPosition());
    	    	  });


    	    	}

    	        initialize();

    	</script>
