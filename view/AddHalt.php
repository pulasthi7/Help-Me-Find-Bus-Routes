<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <title>Eazz Travel::Add New Place</title>
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////


            /*
Credits: Bit Repository
Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html
             */

            pic1 = new Image(16, 16);
            pic1.src="loader.gif";

            $(document).ready(function(){

                $("#nname").change(function() { 

                    var usr = $("#nname").val();

                    if(usr.length >0)
                    {
                        $("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');

                        $.ajax({
                            type: "POST",
                            url: "check_place.php",
                            data: "username="+ usr,
                            success: function(msg){  

                                $("#status").ajaxComplete(function(event, request, settings){ 

                                    if(msg == 'OK')
                                    {
                                        $("#nname").removeClass('object_error'); // if necessary
                                        $("#nname").addClass("object_ok");
                                        $(this).html('&nbsp;<img src="tick.gif" align="absmiddle">');
                                    }
                                    else
                                    {
                                        $("#nname").removeClass('object_ok'); // if necessary
                                        $("#nname").addClass("object_error");
                                        $(this).html(msg);
                                    }  

                                });

                            } 

                        }); 

                    }
                    else
                    {
                        $("#status").html('<font color="red">' +
                            'The username should have at least <strong>1</strong> characters.</font>');
                        $("#nname").removeClass('object_ok'); // if necessary
                        $("#nname").addClass("object_error");
                    }

                });

            });

            //-->






        </script>

        <style>
            #page {
                float: left;
                width: 80%;
                margin-left: 5%;
                height: 100%;
            }
            #addnfrm .form_item_lbl {
	float: left;
	width: 18%;
	margin-left: 2%;
	height: 27px;
            }

            .title_heading {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 250%;
                font-weight: bold;
                color: #FFF;
                background-color: #69F;
                float: left;
                height: auto;
                width: 100%;
                margin-top: 0%;
                margin-left: 2%;
                text-align: center;
                padding: 2%;
            }
            #intro_line {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 150%;
                font-weight: bold;
                color: #FFF;
                background-color: #69F;
                float: left;
                height: auto;
                width: 101%;
                padding-top: 1%;
                padding-right: 1%;
                padding-bottom: 1%;
                padding-left: 2%;
                margin-left: 2%;
            }
            .empty {
                float: left;
                height: 25px;
                width: 100%;
            }
            #addnfrm .form_item_input {
	float: left;
	width: 80%;
	height: 27px;
            }
        #status {
	float: left;
	width: 45%;
	height: 27px;
	font-size: 12px;
}
        #addnfrm .form_item_input_name {
	float: left;
	height: 27px;
	width: 32%;
}
        #submitbutton {
	text-align: right;
	float: left;
	width: 70%;
	margin: 2%;
}
        </style>


    </head>
    <body onLoad="initialize()">
      <div id="page">

            <div class="title_heading">Help Me Find Bus !</div>
            <div class="empty" id="upper"></div>

            <div class="empty" id="upper"></div>
            <div id="intro_line">Add Location</div>
            <div class="empty" id="upper"></div>



            <div style="width: 50%; float: left; margin-left:4%; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold " >
                <form action="../controller/addHaltController.php" id="addnfrm" method="post">

                    <br />
                    <div class="form_item_lbl"><label for="nname">Name </label>   </div>
                <div class="form_item_input_name">	<input name="nname" id="nname" type="text" /></div>
                    
					<div class="status" id="status"></div>
                    
<div class="form_item_lbl">	<label for="nlat">Latitude </label>   </div>
                    <div class="form_item_input"><input name="nlat" id="nlat" type="text"
                                                        onfocus='alert("Do not Enter Here.\n Click the Place on the Map Instead.");' /></div>

                    <div class="form_item_lbl"><label for="nlng">Longitude </label></div>
                    <div class="form_item_input"><input name="nlng" id="nlng" type="text"
                                                        onfocus='alert("Do not Enter Here.\n Click the Place on the Map Instead.");' /></div>
                    <div id="submitbutton">
<input type="submit" value="Submit" name="submit"
                           style="text-align: center; width: 100px; height: 35px; background-image: url(../css/images/img07.gif); background-color:#69F" />
                           </div>
                </form>
            </div>
            <div id="map_canvas" style="width: 400px; height: 300px; float: left; margin-left:2%"></div>
        </div>
    </body>
</html>
