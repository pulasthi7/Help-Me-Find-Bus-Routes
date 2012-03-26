<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

        <title>Eazz Travel::Search Results</title>


        <?php
        include_once '../model/finders/SolutionSet.php';
        include_once '../model/finders/Finder.php';
        if(!isset ($_GET['sourceID']) || !$_GET['destID']){
            //header("Location:../index.php");
            //exit();
        }
        $from = $_GET['sourceID'];
        $to = $_GET['destID'];
        $solutionSet = new SolutionSet();
        $finder = new Finder();
        $result = $finder->findRouteWithHeuristics($from, $to);
        array_pop($result); //remove the tail which is the source
        $solutionSet->add_solution($result);
        
        for ($x = 0; $x < count($solutionSet->solutions); $x++) {
            $currentSolution = $solutionSet->solutions[$x];
            echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' .
                    $x.'_buses" type="text" value="'.count($currentSolution).
                    '" readonly="true">';
            $y=0;
            while ($current_bus = array_pop($result)) {
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_routeno" type="text" value="' . $current_bus->getRouteObj()->description. '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonat" type="text" value="' . $current_bus->getFromObj()->name . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getoffat" type="text" value="' . $current_bus->getToObj()->name . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonlongitude" type="text" value="' . $current_bus->getFromObj()->longitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonlatitude" type="text" value="' . $current_bus->getFromObj()->latitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getofflongitude" type="text" value="' . $current_bus->getToObj()->longitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getofflatitude" type="text" value="' . $current_bus->getToObj()->latitude . '" readonly="true">';
                $y++;
            }
        }
        ?>




        <script type="text/javascript">
            //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
            jQuery(document).ready(function(){
                $("#layer1 p.heading").click(function()
                {
                    $(this).next("div.content").slideToggle(300).siblings("div.content").slideUp("slow");
    
                }).next("div.content").hide();
            });


            //showing google map

            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map;


            function initialize(index) {
   
                directionsDisplay = new google.maps.DirectionsRenderer();
                var mid=new google.maps.LatLng(6.9319444,79.8477778);
                var myOptions = {
                    zoom:7,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: mid
                }
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                directionsDisplay.setMap(map);

                
  
                calcRoute(index);
            }

            function calcRoute(index) {
                
                var solutionText="info_solution_".concat( index , "_buses");
                var no_of_buses= document.getElementById(solutionText).value;
              
                
                
                var i;
                var start,end;
                var waypts=[];
                
                
                for(i=0;i<no_of_buses;i++){
                    
                    var infoText="info_solution_".concat( index );
                    var geton_longitude=document.getElementById(infoText.concat( "_bus_" , i , "_getonlongitude")).value; 
                    var geton_latitude =document.getElementById(infoText.concat( "_bus_" , i , "_getonlatitude")).value;
                    var getoff_longitude=document.getElementById(infoText.concat( "_bus_" , i , "_getofflongitude")).value;
                    var getoff_latitude =document.getElementById(infoText.concat( "_bus_" , i , "_getofflatitude")).value;
                    
             
                    
                    // to store starting point
                    if(i==0){
                        
                        start=new google.maps.LatLng(geton_latitude,geton_longitude);
                         

                    }
                    
                    //to store ending point
                    else if(i==no_of_buses-1){
                        
                        end=new google.maps.LatLng(getoff_latitude,getoff_longitude);
                        
                        // add last geton point
                        waypts.push({
                            location:new google.maps.LatLng(geton_latitude,geton_longitude) ,
                            stopover:true
                        });    
                

                    }
                    
                    //to store way-points
                    else {
                        waypts.push({
                            location:new google.maps.LatLng(geton_latitude,geton_longitude) ,
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
            }

        </script>

        <style type="text/css">
            .layer1 {
                margin: 0;
                padding: 0;
                width: 101%;
                float: left;
            }

            .heading {
                color: #fff;
                cursor: pointer;
                position: relative;
                background-color:#227AFF;
                float: left;
                padding-top: 3px;
                padding-right: 10px;
                padding-bottom: 3px;
                padding-left: 10px;
                width: 100%;
                margin-top: 1px;
                margin-right: 1px;
                margin-bottom: 1px;
                margin-left: 2%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 24px;
            }
            .content {
                background-color:#fafafa;
                float: left;
                padding-top: 5px;
                padding-right: 10px;
                padding-bottom: 5px;
                padding-left: 10px;
                margin-left: 5%;
            }
            #datasection {
                float: left;
                padding-left: 20%;
                width: 60%;
            }
            p { padding: 5px 0; }
            .businfo {
                float: left;
                height: 70%;
                width: 100%;
            }
            .businfo_header {
                float: left;
                height: 10%;
                width: 100%;
                background-image: none;
            }
            .businfo_no {
                float: left;
                height: 10%;
                width: 49%;
                background-image: none;
                background-color: #46B4DD;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                padding-top: 1%;
                padding-bottom: 1%;
                padding-left: 1%;
            }
            .businfo_dest {
                float: left;
                height: 10%;
                width: 49%;
                background-color: #46B4DD;
                background-image: none;
                font-family: Arial, Helvetica, sans-serif;
                padding-top: 1%;
                padding-right: 1%;
                padding-bottom: 1%;
                padding-left: 0px;
                font-weight: bold;
                text-align: right;
            }
            .businfo_getin {
                float: left;
                height: 40%;
                width: 49%;
                background-color: #FF9;
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 18px;
                text-align: center;
                padding-top: 1%;
                padding-right: 0px;
                padding-bottom: 1%;
                padding-left: 0px;
                margin-left: .5%;
            }
            .businfo_getin_place {
                float: left;
                height: 40%;
                width: 49%;
                background-color: #FF9;
                font-family: "Arial Black", Gadget, sans-serif;
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                margin-left: 0.5%;
            }
            .map {
                float: left;
                height: 350px;
                width: 740px;
                margin-left: 3%;
                margin-right: 3%;
            }
            .title_heading {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 250%;
                font-weight: bold;
                color: #FFF;
                background-color: #69F;
                float: left;
                height: 10%;
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
                height: 1%;
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
        </style>




    </head>
    <body >
        <div id="datasection">

            <div class="title_heading">Help Me Find Bus !</div>
            <div class="empty" id="upper"></div>

            <div class="empty" id="upper"></div>
            <div id="intro_line">Results</div>
            <div class="empty" id="upper"></div>


<?php
// getting results array

?>

            <div class="layer1" id="layer1">


                <!--              ******** Area to display map-->

                <div class="map" id="map_canvas"  >

                    <script>initialize(0);</script>
                </div>


<?php
for ($i = 0; $i < count($solutionSet->solutions); $i++) {

    display_info($solutionSet->solutions[$i], $i);
}

function display_info($a_solution, $index) {
    ?>
                    <p class="heading" onclick="initialize(<?php echo($index); ?>)"><?php echo 'Solution - '.($index+1).' |  No Of Buses - '.count($a_solution); ?> </p>
                    <div class="content">
                    <?php
                    echo 'Solution'.($index+1) . ' discription is here ....';

                    display_bus_list($a_solution);

                    // draw map function goes here
                    ?>
                    </div> <!-- content ends here -->   
                        <?php
                    }
                    ?>





<?php
//$route_no,$start_from,$end_to,$geton_at,$getoff_at,$geton_longitude,$geton_latitude,$getoff_longitude,$getoff_latitude
function display_bus_list($a_solution) {
    while ($busTour = array_pop($a_solution)) {
        ?>
                        <div class="businfo">
                            <div class="businfo_header">
                                <div class="businfo_no">Route no <?php echo $busTour->getRouteObj()->description; ?></div>
                            </div>
                            <div class="businfo_getin">Get In At</div>
                            <div class="businfo_getin">Get Off At</div>
                            <div class="businfo_getin_place"><?php echo $busTour->getFromObj()->name ?></div>
                            <div class="businfo_getin_place"><?php echo $busTour->getToObj()->name  ?></div>
                        </div>

        <?php
    }
}
?>
            </div>  <!--layer ends here -->


        </div>  <!-- data section ends here-->
    </body>
</html>
