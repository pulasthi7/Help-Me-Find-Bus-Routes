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

        // For a single sloution
        class Solution {

            public $discription;
            public $bus_list = array();
            private $count = 0;

            public function add_bus_item($bus) {
                $this->count = sizeof($this->bus_list);
                $this->bus_list[$this->count] = $bus;
            }

        }

        // for a single bus in a single solution
        class bus_item {

            public $route_no;
            public $start_from;
            public $end_to;
            public $geton_at;
            public $getoff_at;
            public $geton_longitude;
            public $geton_latitude;
            public $getoff_longitude;
            public $getoff_latitude;

            public function __construct($route_no, $start_from, $end_to, $geton_at, $getoff_at, $geton_longitude, $geton_latitude, $getoff_longitude, $getoff_latitude) {

                $this->route_no = $route_no;
                $this->start_from = $start_from;
                $this->end_to = $end_to;
                $this->geton_at = $geton_at;
                $this->getoff_at = $getoff_at;
                $this->geton_longitude = $geton_longitude;
                $this->geton_latitude = $geton_latitude;
                $this->getoff_longitude = $getoff_longitude;
                $this->getoff_latitude = $getoff_latitude;
            }

        }

        // For solution 

        class solution_set {

            public static $selected_index = 0;
            public $solutions = array();
            private $count = 0;

            public function add_solution($a_solution) {
                $this->count = sizeof($this->solutions);
                $this->solutions[$this->count] = $a_solution;
            }

        }

        // For Solution -1
        $solution = new Solution();

// $route_no,$start_from,$end_to,$geton_at,$getoff_at,$geton_longitude,$geton_latitude,$getoff_longitude,$getoff_latitude
        $bus = new bus_item('5', 'matara', 'galle', 'matara', 'galle',  '80.5427778', '5.9486111','80.2116667', '6.0536111');
        $solution->add_bus_item($bus);
        $bus = new bus_item('2', 'colombo', 'galle', 'moratuwa', 'galle', '79.8477778', '6.9319444', '80.2116667', '6.0536111');
        $solution->add_bus_item($bus);
        $bus = new bus_item('255', 'kottawa', 'mt.lavnia', 'piliyandala', 'moratuwa', '80.2116667', '6.0536111', '79.8825', '6.7733333');
        $solution->add_bus_item($bus);

        $set_of_solutions = new solution_set();
        $set_of_solutions->add_solution($solution);

        // For Solution -2
        $solution = new Solution();

// $route_no,$start_from,$end_to,$geton_at,$getoff_at,$geton_longitude,$geton_latitude,$getoff_longitude,$getoff_latitude
        $bus = new bus_item('255', 'kottawa', 'mt.lavnia', 'piliyandala', 'moratuwa', '80.2116667', '6.0536111', '79.8825', '6.7733333');
        $solution->add_bus_item($bus);
        $bus = new bus_item('5', 'galle', 'matara', 'galle', 'matara', '80.2116667', '6.0536111', '80.5427778', '5.9486111');
        $solution->add_bus_item($bus);
        $bus = new bus_item('2', 'colombo', 'galle', 'moratuwa', 'galle', '79.8477778', '6.9319444', '80.2116667', '6.0536111');
        $solution->add_bus_item($bus);


        
        $set_of_solutions->add_solution($solution);



        for ($x = 0; $x < sizeof($set_of_solutions->solutions); $x++) {

            echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_buses" type="text" value="' . sizeof($set_of_solutions->solutions[$x]->bus_list) . '" readonly="true">';

            for ($y = 0; $y < sizeof($set_of_solutions->solutions[$x]->bus_list); $y++) {

                $current_bus = $set_of_solutions->solutions[$x]->bus_list[$y];



                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_routeno" type="text" value="' . $current_bus->route_no . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_startfrom" type="text" value="' . $current_bus->start_from . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_endto" type="text" value="' . $current_bus->end_to . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonat" type="text" value="' . $current_bus->geton_at . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getoffat" type="text" value="' . $current_bus->getoff_at . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonlongitude" type="text" value="' . $current_bus->geton_longitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getonlatitude" type="text" value="' . $current_bus->geton_latitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getofflongitude" type="text" value="' . $current_bus->getoff_longitude . '" readonly="true">';
                echo'<input style="display:none" name="info_solution_bus_" id="info_solution_' . $x . '_bus_' . $y . '_getofflatitude" type="text" value="' . $current_bus->getoff_latitude . '" readonly="true">';
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
for ($i = 0; $i < sizeof($set_of_solutions->solutions); $i++) {

    display_info($set_of_solutions->solutions[$i], $i);
}

function display_info($a_solution, $index) {
    ?>
                    <p class="heading" onclick="initialize(<?php echo($index); ?>)"><?php echo 'Solution - '.($index+1).' |  No Of Buses - '.sizeof($a_solution->bus_list); ?> </p>
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

    for ($i = 0; $i < sizeof($a_solution->bus_list); $i++) {
        ?>
                        <div class="businfo">
                            <div class="businfo_header">
                                <div class="businfo_no">Route no <?php echo $a_solution->bus_list[$i]->route_no; ?></div>
                                <div class="businfo_dest"><?php echo $a_solution->bus_list[$i]->start_from.' - '.$a_solution->bus_list[$i]->end_to; ?></div>
                            </div>
                            <div class="businfo_getin">Get In At</div>
                            <div class="businfo_getin">Get Off At</div>
                            <div class="businfo_getin_place"><?php echo $a_solution->bus_list[$i]->geton_at ?></div>
                            <div class="businfo_getin_place"><?php echo $a_solution->bus_list[$i]->getoff_at ?></div>
                        </div>

        <?php
    }
}
?>
            </div>  <!--layer ends here -->


        </div>  <!-- data section ends here-->
    </body>
</html>
