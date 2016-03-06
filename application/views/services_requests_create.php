<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>requests services</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

</head>
<body>

<!-- Form Start -->
<header class="row jumbotron bg-img-4">
    <div class="container text-white">

        <p class="inline-block bg-drk-20"></p>
    </div>
</header><!-- jumbotron End -->

<div class="container">


    <div class="row">
        <div class="col-md-12">
            <div style="display: none" id="alert" role="alert" class="alert alert-warning notices attentionimg alert-dismissible"></div>
            <?php echo form_open('services/services_requests/create/', array('class' => 'form-horizontal', 'role' => 'form-form')) ?>


            <div class="form-group">
                <label for="sr_address" class="col-md-4 control-label">Search for the address</label>
                <input class="form-control col-md-8" id="geocomplete" name="sr_address" type="text" value=""/><br>
                <?php echo form_error('sr_address'); ?>
            </div>
            <div class="form-group">
                <label for="sr_address" class="col-md-4 control-label">Select the location by the marker</label>

                <div class="map_canvas"></div>
                <a id="reset" href="#" style="display:none;"></a>
            </div>

            <div class="form-group">
                <div class="col-md-9">
                    <input type="hidden" name="sr_lat" value="<?= set_value('sr_lat') ?>"/>
                    <input type="hidden" name="sr_lng" value="<?= set_value('sr_lng') ?>"/>
                    <?php echo form_error('sr_lat'); ?>
                    <?php echo form_error('sr_lng'); ?>
                </div>
            </div>


            <div class="center">
                <input id="reset" type="reset" value="reset" class="btn btn-default"/>
                <input id="submit" type="submit" value="new request" class="btn btn-primary"/>
            </div>
            <?= form_close() ?>
            <!-- Horizontal Form End -->
        </div>
    </div>
</div>

<script src="http://maps.googleapis.com/maps/api/js?libraries=places&ar=AR"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/map.css"/>
<script src="<?= base_url() ?>assets/js/geocomplete.min.js"></script>

<script>
    $(function () {
        ////// geo location check you location if it is ok it will showlocation()
        // ////// if something wrong it will showerror()
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation, showError,
                {
                    enableHighAccuracy: true,
                    timeout: 10000 // 10s
                    //maximumAge : 0
                }
            );
        }

        ////// geo location showlocation by passing latitude and longitude to geocomplete ////////

        function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            $("input[name=sr_lat]").val(latitude);
            $("input[name=sr_lng]").val(longitude);

            getAddress(latitude, longitude);

            $("#geocomplete").geocomplete({
                map: ".map_canvas",
                details: "form ",
                location: [latitude, longitude]
                // location: [latLng.lat, latLng.ln]

            });

            ////// handle marker : if you click in any location then set lang and lat to inputs ////////

            $("#geocomplete").bind("geocode:click", function (event, latLng) {
                $("input[name=sr_lat]").val(latLng.lat());
                $("input[name=sr_lng]").val(latLng.lng());
                $(this).geocomplete('marker')
                    .setOptions({position:latLng,map:$(this).geocomplete("map")});

                $("#reset,#sr_lat,#sr_lng").show();
        };
        }
            ////// geo location display error type if something happens ////////

            function showError(error)
            {
                var x= document.getElementById("alert");

                switch(error.code)
                {
                    case error.PERMISSION_DENIED:
                        x.innerHTML="User denied the request for Geolocation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        x.innerHTML="Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        x.innerHTML="The request to get user location timed out.";
                        break;
                    case error.UNKNOWN_ERROR:
                        x.innerHTML="An unknown error occurred.";
                        break;
                }

                $(x).show();

                // then set default latitude and longitude to geocomplete
                // because there is no location came from geo location /////

                $("#geocomplete").geocomplete({
                    map: ".map_canvas",
                    details: "form ",
                    location: [24.713551699,46.675295699]


                });

                ////// handle marker : if you click in any location then set lang and lat to inputs ////////

                $("#geocomplete").bind("geocode:click", function (event, latLng) {
                    $("input[name=sr_lat]").val(latLng.lat());
                    $("input[name=sr_lng]").val(latLng.lng());
                    $(this).geocomplete('marker')
                        .setOptions({position:latLng,map:$(this).geocomplete("map")});

                    $("#reset,#sr_lat,#sr_lng").show();
                });

            }

            /// use this function to get adress by passing latitude and longitude that came from geo location

            function getAddress(myLatitude,myLongitude) {

                var geocoder	= new google.maps.Geocoder();							// create a geocoder object
                var location	= new google.maps.LatLng(myLatitude, myLongitude);		// turn coordinates into an object

                geocoder.geocode({'latLng': location}, function (results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {						// if geocode success
                        var ad =  results[0].formatted_address;
                        $("input[name=sr_address]").val(ad);									// write address to field
                    } else {
                        alert("Geocode failure: " + status);								// alert any other error(s)
                        return false;
                    }
                });
            }

        });
</script>

</body>
</html>

<!-- Page Content Goes Here -->
