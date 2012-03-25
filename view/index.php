<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bus Route</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>



        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
    <script>
            function suggest(inputString,num){
                if(inputString.length == 0) {
                    $('#suggestions'+num).fadeOut();
                } else {
                    $('#txtbox'+num).addClass('load');
                    $.post("autosuggest.php", {queryString: ""+inputString+"",number:num}, function(data){
                        if(data.length >0) {
                            $('#suggestions'+num).fadeIn();
                            $('#suggestionsList'+num).html(data);
                            $('#txtbox'+num).removeClass('load');
                        }
                    });
                }
            }

            function fill1(thisValue,lng,lat,id) {
                $('#txtbox1').val(thisValue); 
                $('#txtboxfrmid').val(id);
//                if(lng!=''||lat!=''){alert(lng+"hey"+lat);}
                setMarker(lng,lat);
               
                setTimeout("$('#suggestions1').fadeOut();", 600);
                
               
            }
			
			function fill2(thisValue,lng,lat,id) {
                $('#txtbox2').val(thisValue);
                $('#txtboxtoid').val(id);
                setMarker(lng,lat);
                setTimeout("$('#suggestions2').fadeOut();", 600);
                
            }

        </script>


        <style type="text/css">
            #result {
                height:20px;
                font-size:16px;
                font-family:Arial, Helvetica, sans-serif;
                color:#333;
                padding:5px;
                margin-bottom:10px;
                background-color:#FFFF99;
            }

            .suggestionsBox {
	position: relative;
	left: 0px;
	width: 90%;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
	float: left;
	margin-top: 1px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
            }
            .suggestionList {
                margin: 0px;
                padding: 0px;
            }
            .suggestionList ul li {
                list-style:none;
                margin: 0px;
                padding: 6px;
                border-bottom:1px dotted #666;
                cursor: pointer;
            }
            .suggestionList ul li:hover {
                background-color: #69F;
                color:#000;
            }
            ul {
                font-family:Arial, Helvetica, sans-serif;
                font-size:11px;
                color:#FFF;
                padding:0;
                margin:0;
            }

            .load{
                background-image:url(loader.gif);
                background-position:right;
                background-repeat:no-repeat;
            }

            #suggest {
                position:relative;
            }
            


            .side_pane {
                background-color: #E5ECF9;
                float: left;
                height: 1000px;
                width: 80px;
            }
            .heading {
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
            #form {
                margin: 0.5%;
                float: left;
                height: 30%;
                width: 100%;
                padding-bottom: 0px;
                padding-left: 3%;
            }
            #map {
	float: left;
	height: 350px;
	width: 45%;
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
            .image {
                float: left;
                height: 300px;
                width: 100%;
                padding-top: 1%;
                padding-right: 4%;
                padding-bottom: 1%;
                padding-left: 4%;
            }
            .container {
                font-family: Arial, Helvetica, sans-serif;
                float: left;
                height: 100%;
                width: 90%;
                padding-left: 1%;
            }
            #form_detail {
	float: left;
	height: 80%;
	width: 55%;
            }
            .frm_lbl {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 160%;
	font-weight: bold;
	color: #000;
	float: left;
	height: 10%;
	width: 17%;
	margin-top: 2%;
	margin-right: 1%;
	margin-bottom: 0%;
	margin-left: 5%;
            }
            .frm_txt {
                margin: 1%;
                float: left;
                height: 50%;
                width: 70%;
            }
            .txtbox {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 24px;
                font-weight: bold;
                float: left;
                height: 90%;
                width: 90%;
            }
            .button {
                text-align: right;
                float: left;
                height: 10%;
                width: 80%;
            }
            #go_button {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 36px;
                font-weight: bold;
                color: #FFF;
                background-image: url(button_image.png);
                height: 58px;
                width: 151px;
                background-color: #FFF;
            }
        </style>
    </head>
    <body>
        <!--  <div class="side_pane" id="left_pane"></div> -->
        <div class="container">
        <div class="heading">Help Me Find Bus !</div>
          <div class="empty" id="upper"></div>
<!--          <div class="image">
                <img src="header2.jpg" width="100%" height="300"></div>-->
            <div class="empty" id="upper"></div>
            <div id="intro_line">I Want To Go</div>
              <div class="empty" id="upper"></div>
            <div id="form">
                <div id="map"><script  src="googlemapscript.js"></script></div>

<form action="#" method="post" name="form1" id="form1">
                <div id="form_detail">
                    <div class="frm_lbl" id="from_lbl_1">From</div>
                    <div class="frm_txt" id="frm_text_1"><input name="from" class="txtbox" id="txtbox1" size="25" type="text" onkeyup="suggest(this.value,1);" onblur="fill1();">
          <div class="suggestionsBox" id="suggestions1" style="display: none;"> 
                            <div class="suggestionList" id="suggestionsList1"> &nbsp; </div>
                           
                      </div>
                        <input name="from_id" class="txtboxfrm" id="txtboxfrmid" type="text" style="display: none;" >
                    </div>

                    <div class="frm_lbl" id="from_lbl_2">To</div>
                    <div class="frm_txt" id="frm_text_2"><input name="to" class="txtbox" id="txtbox2" type="text" size="25" onkeyup="suggest(this.value,2);" onblur="fill2();">
          <div class="suggestionsBox" id="suggestions2" style="display: none;"> 
                            <div class="suggestionList" id="suggestionsList2"> &nbsp; </div>
                            
                        </div>
                        <input name="from_id" class="txtboxto" id="txtboxtoid" type="text" style="display: none;">
                    </div>


                    <div class="button"><input name="go" id="go_button" type="button" value="GO !"></div>
                </div>
                </form>
            </div>
    </div>
<!--   <div class="side_pane" id="right_pane"></div>-->




        <?php
        // put your code here
        ?>
    </body>
</html>
