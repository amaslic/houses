@include('layouts.header')
 @include('layouts.nav')


<style>
	body,
	html {
		height: 100%;
		width: 100%;
	}

	.modal {
		z-index: 999;
	}

	.modal-backdrop {
		z-index: 990;
	}

	.modal-dialog {
		padding-top: 150px;
	}

	#map {

		min-height: 884px;
		height: 100%;
	}
</style>

<div class="container-main">

	<div class="pac-card" id="pac-card">
		<div>
			<div id="title">
				Search by address
			</div>
			<div id="type-selector" class="pac-controls">
				<input type="radio" name="type" id="changetype-all" checked="checked">
				<label for="changetype-all">All</label>

				<input type="radio" name="type" id="changetype-establishment">
				<label for="changetype-establishment">Establishments</label>

				<input type="radio" name="type" id="changetype-address">
				<label for="changetype-address">Addresses</label>

				<input type="radio" name="type" id="changetype-geocode">
				<label for="changetype-geocode">Geocodes</label>
			</div>
			<div id="strict-bounds-selector" class="pac-controls">
				<input type="checkbox" id="use-strict-bounds" value="">
				<label for="use-strict-bounds">Strict Bounds</label>
			</div>
		</div>
		<div id="pac-container">
			<input id="pac-input" type="text" placeholder="Enter a location">
		</div>
	</div>
	<div id="map"></div>
	<div id="infowindow-content">
		<img src="" width="16" height="16" id="place-icon">
		<span id="place-name" class="title"></span>
		<br>
		<span id="place-address"></span>
	</div>
	<button type="button" id="modal" class="btn btn-secondary" style="display:none;" data-toggle="modal" data-target="#myModal">
	Launch demo modal</button>
	<button type="button" id="tooltip" class="createTerritoryAlert btn btn-warning" style="display:none;">ToolTip</button>
<div id="preloader">
                <div class="inner">
                    <span class="loader"></span>
                </div>
            </div><!-- /PRELOADER -->
    </div>
</div>
<div class="modal fade" name="markers" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title">Create territory</h4>
			</div>
			<div class="modal-body">
				<div class="row ">
					<div class="col-md-12">
						<form class="form-horizontal" method="POST" id="addTerritory" action="createTerritory">
							{{ csrf_field() }}
							<input type="hidden" name="ltdlng" id="ltdlng" />
							<input type="text" name="address" id="address" style="display: none" />
							<input type="text" value="1" name="active" id="active" style="display: none">
							<input type="text" value="none" name="username" class="username" id="username" style="display: none">
							<fieldset>
								<!-- Form Name -->
								<!-- Text input-->
								<div class="form-group">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-user "></i>
											</span>
											<select class="usr_name" name="user_id">
												@foreach($users as $user)
												<option name="{{$user->id}}" value="{{$user->id}}">
													{{$user->name}} ({{$user->email}})
												</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-paint-brush"></i>
											</span>
											<input class="jscolor color-picker form-control" value="ab2567" name="color">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-file-text"></i>
											</span>
											<textarea class="form-control" value="ab2567" name="description"> </textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">

										<button type="submit" class="btn btn-warning pull-right">Add territory
											<span class="glyphicon glyphicon-send"></span>
										</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script>
 $('.createTerritoryAlert').click();
	var lineCoords = [];

    initMap = function() {

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: 38.89103282648846,
            lng: -90.703125
        },
        zoom: 13,

    });

    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var types = document.getElementById('type-selector');
    var strictBounds = document.getElementById('strict-bounds-selector');

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        // marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }
        //marker.setPosition(place.geometry.location);
        //marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        /* infowindowContent.children['place-icon'].src = place.icon;
         infowindowContent.children['place-name'].textContent = place.name;
         infowindowContent.children['place-address'].textContent = address;
         infowindow.open(map, marker);*/
    });

    function setupClickListener(id, types) {
        var radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
        });
    }

    setupClickListener('changetype-all', []);
    setupClickListener('changetype-address', ['address']);
    setupClickListener('changetype-establishment', ['establishment']);
    setupClickListener('changetype-geocode', ['geocode']);

    document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
            console.log('Checkbox clicked! New state=' + this.checked);
            autocomplete.setOptions({
                strictBounds: this.checked
            });
        });


    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
        },

        polygonOptions: {
            // fillColor: color,
            strokeWeight: 3,
            // strokeColor: color,
            clickable: true,
            editable: true,
            zIndex: 1
        }
    });

    drawingManager.setMap(map);

    var i = 0;
    var z = [];

    @foreach($territory as $t)
    q = '{{$t->ltdlng}}';
    var y = q.replace(/&quot;/g, '\"');
    z.push(JSON.parse('[' + y + ']'));

    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(150, 50)
    });

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
    });

    if ("{{$t->active}}" == 1)
        var x = new google.maps.Polygon({

            path: z[i],
            strokeColor: '#98fb98',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#' + '{{$t->color}}',
            fillOpacity: 0.35,
            // infowindow: contentString,
            clickable: true,
            editable: false
        });
    else
        var x = new google.maps.Polygon({
            path: z[i],
            strokeColor: '#800000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#' + '{{$t->color}}',
            fillOpacity: 0.35,
            // infowindow: contentString,
            clickable: true,
            editable: false
        });

    google.maps.event.addListener(x, 'click', function(event) {
        var contentString = "{{$t->description}}";
        infowindow.setContent(contentString);
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
    });
    google.maps.event.addListener(x, 'click', function(event) {
        var contentString = "<h5>{{$t->address}}</h3>  <i>{{$t->username}}</i> <br><br>{{$t->description}} <br><br>";
        // @activeTerr


        if ("{{$t->active}}" == 1)
            contentString += "<a href='{{ URL::to('deactivateTerritory/'.$t->id) }}'>Deactivate</a>";
        else
            contentString += "<a href='{{ URL::to('activateTerritory/'.$t->id) }}'>Activate</a>";
        //@endactiveTerr
        infowindow.setContent(contentString);
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
    });
    i++;
    x.setMap(map);

    @endforeach


    google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
        drawingManager.setDrawingMode(null);
        var arr = [];
        polygon.getPath().forEach(function(latLng) {
            arr.push(JSON.stringify(latLng));
        })
        lineCoords.push(arr);
        drawingManager.setOptions({
            fillColor: "black"
        });
        $("#ltdlng").val(lineCoords);

        // alert($( "#ltdlng" ).val() + " " + color);
        // $( "#addTerritory" ).submit();
        getAdd();
        document.getElementById("modal").click();

    });

}

function getAdd() {
    var i = 0;
    var z = [];
    var q = $("#ltdlng").val();
    var y = q.replace(/&quot;/g, '\"');
    // console.log(y);
    z.push(JSON.parse('[' + y + ']'));
    // console.log(z);
    var ltd = y.split('t').pop().split(',').shift();
    var ldt = ltd.substring(2, 50);
    var lng = y.split('g').pop(1).split('}').shift(1);
    var lng = lng.substring(2, 50);

    google.maps.event.addListener(map, 'click', function() {

        infowindow.close();

    });

    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;
    geocodeLatLng(geocoder, map);
    var input = ldt + ',' + lng;
    var latlngStr = input.split(',', 2);
    var latlng = {
        lat: parseFloat(latlngStr[0]),
        lng: parseFloat(latlngStr[1])
    };
    geocoder.geocode({
        'location': latlng
    }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {

                $("#address").val(innerHTML = results[0].formatted_address);

            } else {
                window.alert('No results found');
            }
        } else {
            window.alert('Geocoder failed due to: ' + status);

        }
    });
}

function geocodeLatLng(geocoder, map) {

}

function GetAddress(latLng) {
    var address;
    /* var lat = parseFloat(document.getElementById("txtLatitude").value);
     var lng = parseFloat(document.getElementById("txtLongitude").value);
     var latlng = new google.maps.LatLng(lat, lng);*/
    var geocoder = geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'latLng': latLng
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                console.log(results[1].formatted_address);
            }
        }
    });
}
initMap();
</script>
<script>
   jQuery(function(){
      jQuery('#tooltip').click();
   });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAAKddZzBqbk8aba9FhoWo22G3NyuJ85o&libraries=drawing,places&callback=initMap"
 async defer></script>



@include('layouts.footer')