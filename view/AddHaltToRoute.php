<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eazz Travel::Add A Halt To Route</title>

        <style> 

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

            .txt_lbl {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                font-size: 24px;
                font-weight: bold;
                float: left;
                width: 15%;
                padding-left: 10%;
            }
            .jumpMenu {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 16px;
                float: left;
                width: 20%;
                margin-left:2%;

            }
            #page #addrfrm #add_button {
                font-family: Arial, Helvetica, sans-serif;
                background-color: #69C;
                float: left;
                margin-left: 50%;
                height: 50px;
                width: 150px;
                font-size: 18px;
                font-weight: bold;
                margin-top: 5%;
            }
            .map {
                float: left;
                height: 350px;
                width: 90%;
                margin-left: 3%;
                margin-right: 3%;
                margin-top: 2%;
            </style>

            <script type="text/javascript">
                var directionsDisplay;
                var directionsService = new google.maps.DirectionsService();
                var map;  
                
            
                function initialize(){
                    //alert ("Hello!");
                    directionsDisplay = new google.maps.DirectionsRenderer();
                    var mid=new google.maps.LatLng(6.9319444,79.8477778);
                    var myOptions = {
                        zoom:12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        center: mid
                    }
                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                    directionsDisplay.setMap(map);

                }
        
                function showRoute(routeId){
                    // var solutionText="route_info_".concat( routeId);
           
                    var no_of_points= document.getElementById("route_info_pointcount_"+routeId).value;//
                          
                    var i;
                    var start,end;
                    var waypts=[];
                    
                
                
                    for(i=0;i<no_of_points;i++){
                    
                   
                        var longitude=document.getElementById("route_info_lng_"+routeId+"_"+i ).value; 
                        var latitude =document.getElementById("route_info_lat_"+routeId+"_"+i).value;
                   
                     
                        
                    
                        // to store starting point
                        if(i==0){
                        
                            start=new google.maps.LatLng(latitude,longitude);
                         

                        }
                    
                        //to store ending point
                        else if(i==no_of_points-1){
                        
                            end=new google.maps.LatLng(latitude,longitude);
                       
                       
                        }
                    
                        //to store way-points
                        else {
                            waypts.push({
                                location:new google.maps.LatLng(latitude,longitude) ,
                                stopover:true
                            });         
                            
                        
                        }
                    
                                     
                    }
                
                
                    var request = {
                                    
                        origin:start,
                        destination:end,
                        waypoints: waypts,
                        optimizeWaypoints: true,
                        avoidHighways:true,
                        travelMode: google.maps.TravelMode.DRIVING
                    };
                
                    directionsService.route(request, function(result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(result);
                        }
                    });
                    
                 document.getElementById('route_no').value=document.getElementById("route_info_id_"+routeId).value;  
                 
                }
        
                function showHalt(haltId){
                    var latt=document.getElementById("halt_info_lng_"+haltId).value;
                    var lngt=document.getElementById("halt_info_lat_"+haltId).value;
                    var location=new google.maps.LatLng(latt,lngt);
                    marker=new google.maps.Marker({position:location,map:map,animation: google.maps.Animation.DROP});
                    document.getElementById('halt_no').value=document.getElementById("halt_info_id_"+haltId).value;
                }

      
                function onClick_route(targ,selObj,restore){
      
                    document.getElementById('route_no').value=selObj.selectedIndex;
                    if (restore) selObj.selectedIndex=0;
                    showRoute(selObj.selectedIndex);
                }
            
                function onClick_halt(targ,selObj,restore){
      
                    document.getElementById('halt_no').value=selObj.selectedIndex;
                    if (restore) selObj.selectedIndex=0;
                    showHalt(selObj.selectedIndex);
                }

            </script>




            <?php
            $route_array = array('erer', 'dsdfs', 'sddf');
            $route_array_id = array();
            $halt_array = array('dsfsew', 'dds', 'sfsdfsf');
            $halt_array_id = array();

            class Route {

                public $routeId;
                public $routeName;
                public $lnglat = array();

                function __construct($rid, $rname) {
                    $this->routeId = $rid;
                    $this->routeName = $rname;
                }

                public function addlnglat($lng, $lat) {
                    $point = array('lng' => $lng, 'lat' => $lat);
                    array_push($this->lnglat, $point);
                }

            }

            class Halt {

                public $haltId;
                public $haltName;
                public $lng;
                public $lat;

                function __construct($hid, $hname, $lng, $lat) {
                    $this->haltId = $hid;
                    $this->haltName = $hname;
                    $this->lng = $lng;
                    $this->lat = $lat;
                }

            }

            $routeset = array();
            array_push($routeset, new Route('sd', 'sdsa'));
            $routeset[0]->addlnglat('80.2116667', '6.0536111');
            $routeset[0]->addlnglat('80.2118667', '6.0536111');
            $routeset[0]->addlnglat('80.2116867', '6.0546111');
            array_push($routeset, new Route('kgf', 'erf'));
            $routeset[1]->addlnglat('80.6', '5.2');
            $routeset[1]->addlnglat('80.6', '5.3');
            //var_dump($routeset);
            //echo '<br />';

            $haltset = array();
            array_push($haltset, new Halt('sdPPPP', 'sBBBdsa', '7', '4'));
            array_push($haltset, new Halt('kgfQQQQ', 'eHHHHrf', '6', '17'));
            //var_dump($haltset);
            // hidden fields
            // echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_routeno" type="text" value="' . $current_bus->route_no . '" readonly="true">';

            for ($x = 0; $x < sizeof($routeset); $x++) {
                echo '<input style="display:none" name="route_info" id="route_info_name_' . $x . '" value="' . $routeset[$x]->routeName . '">'; //routename
                echo '<input style="display:none" name="route_info" id="route_info_id_' . $x . '" value="' . $routeset[$x]->routeId . '">'; // route id
                echo '<input style="display:none" name="route_info" id="route_info_pointcount_' . $x . '" value="' . sizeof($routeset[$x]->lnglat) . '">'; // no of points available

                for ($y = 0; $y < sizeof($routeset[$x]->lnglat); $y++) {
                    echo '<input style="display:none" name="route_info" id="route_info_lng_' . $x . '_' . $y . '" value="' . $routeset[$x]->lnglat[$y]['lng'] . '">'; //lng
                    echo '<input style="display:none" name="route_info" id="route_info_lat_' . $x . '_' . $y . '" value="' . $routeset[$x]->lnglat[$y]['lat'] . '">'; //lat
                }
            }

            for ($x = 0; $x < sizeof($haltset); $x++) {

                echo '<input style="display:none" name="halt_info" id="halt_info_id_' . $x . '" value="' . $haltset[$x]->haltId . '">'; // halt id
                echo '<input style="display:none" name="halt_info" id="halt_info_name_' . $x . '" value="' . $haltset[$x]->haltName . '">'; // halt name
                echo '<input style="display:none" name="halt_info" id="halt_info_lng_' . $x . '" value="' . $haltset[$x]->lng . '">'; // halt lng
                echo '<input style="display:none" name="halt_info" id="halt_info_lat_' . $x . '" value="' . $haltset[$x]->lat . '">'; // halt lat
            }
            ?>

        </head>
        <body onLoad="initialize()">



            <div id="page">
                <div style="width: 680px; float: center; padding-left: 30%">


                        <div class="title_heading">Help Me Find Bus !</div>
                        <div class="empty" id="upper"></div>
                        <div class="empty" id="upper"></div>
                        <div id="intro_line">Add A Halt To A Route</div>
                        <div class="empty" id="upper"></div>
                        <br />
                    </div>

                    <form action="../controller/#" id="addrfrm" method="get">

                        <div class="txt_lbl">Add Halt </div>

                        <select name="jumpMenu" id="jumpMenu1" class="jumpMenu" onChange="onClick_halt('parent',this,0)">
                            <?php
                            $i = 0;
                            for ($i = 0; $i < sizeof($haltset); $i++) {
                                echo '<option> ' . $haltset[$i]->haltName . '</option>';
                            }
                            ?>
                        </select>

                        <div class="txt_lbl">To Route </div>

                        <select name="jumpMenu2" id="jumpMenu2" class="jumpMenu" onChange="onClick_route('parent',this,0)">
                            <?php
                            $i = 0;
                            for ($i = 0; $i < sizeof($routeset); $i++) {
                                echo '<option> ' . $routeset[$i]->routeName . '</option>';
                            }
                            ?>
                        </select>

                        <!--                hidden fields to get the id of halt and route  -->
                        <input type="text" id="halt_no" style="display:none"/>
                        <input type="text" id="route_no" style="display:none"/>

                        <input name="add_halt" type="submit" id="add_button" value="ADD HALT">

                    </form>

                    <div class="map" id="map_canvas"  ></div>



                </div>



            </body>
        </html>
