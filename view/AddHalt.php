<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<title>Eazz Travel::Add New Place</title>
<script type="text/javascript"
	src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
<script type="text/javascript">
            var map;
            var marker;
            function initialize() {
                var myLatlng = new google.maps.LatLng(6.9,79.9);
                var myOptions = {
                    zoom: 12,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng);
                });
            }

            function placeMarker(location) {
                document.getElementById("nlat").value = location.lat();
                document.getElementById("nlng").value = location.lng();
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });

                map.setCenter(location);
            }

        </script>
</head>
<body onLoad="initialize()">
	<div id="page">
		<div style="width: 300px; float: left">
			<form action="../controller/addHaltController.php" id="addnfrm" method="post">
				<h2>Add a Location Here</h2>
				<br />
				<table id="addnd" border="0" align="left" cellpadding="0"
					cellspacing="0">
					<tr>
						<td><label for="nname">Name</label>
						</td>
						<td><input name="nname" id="nname" type="text" />
						</td>
					</tr>
					<tr>
						<td><label for="nlat">Latitude</label>
						</td>
						<td><input name="nlat" id="nlat" type="text"
							onfocus='alert("Do not Enter Here.\n Click the Place on the Map Instead.");' />
						</td>
					</tr>
					<tr>
						<td><label for="nlng">Longitude</label>
						</td>
						<td><input name="nlng" id="nlng" type="text"
							onfocus='alert("Do not Enter Here.\n Click the Place on the Map Instead.");' />
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td><h2>Or Add a Route Here</h2>
						</td>
					</tr>
					<tr>
						<td><label for="rno">Route No&nbsp;&nbsp;</label>
						</td>
						<td><input name="rno" id="rno" type="text" size="7" maxlength="7" />
						</td>
					</tr>
				</table>
				<input type="submit" value="Submit" name="submit"
					style="text-align: center; width: 100px; height: 35px; background-image: url(../css/images/img07.gif)" />
			</form>
		</div>
		<div id="map_canvas" style="width: 400px; height: 300px; float: left"></div>
	</div>
</body>
</html>
