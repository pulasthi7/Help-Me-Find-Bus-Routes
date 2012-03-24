<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<title>Eazz Travel::Add New Route</title>


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
    
</style>


</head>
<body>
	<div id="page">
		<div style="width: 400px; float: center">
			<form action="../controller/addRouteController.php" id="addrfrm" method="post">
                            
                            <div class="title_heading">Help Me Find Bus !</div>
            <div class="empty" id="upper"></div>

            <div class="empty" id="upper"></div>
            <div id="intro_line">Add A Route</div>
            <div class="empty" id="upper"></div>
				
				<br />
				<div id="addrt" border="0" align="left" cellpadding="0"
					cellspacing="0" style="padding-left:10%; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 18; font-weight: bold ">
					<div>
						<div><label for="rt_number">Route Number</label>
						</div>
						<div><input name="rt_number" id="rt_num" type="text" />
						</div>
					</div>
					<div>
						<div><label for="rt_start">Start From</label>
						</div>
						<div><input name="rt_start" id="rt_s" type="text"/>
						</div>
					</div>
					<div>
						<div><label for="rt_end">Ends At</label>
						</div>
						<div><input name="rt_end" id="rt_e" type="text"/>
						</div>
					</div>
					<br />
				</div>
				<input type="submit" value="Submit" name="submit"
					style="text-align: center; width: 100px; height: 35px; background-color: #69F; background-image: url(../css/images/img07.gif)" />
			</form>
		</div>
	</div>
</body>
</html>
