<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<title>Eazz Travel::Add New Place</title>
</head>
<body>
	<div id="page">
		<div style="width: 300px; float: left">
			<form action="../controller/addRouteController.php" id="addrfrm" method="post">
				<h2>Add a Location Here</h2>
				<br />
				<table id="addrt" border="0" align="left" cellpadding="0"
					cellspacing="0">
					<tr>
						<td><label for="rt_number">Route Number</label>
						</td>
						<td><input name="rt_number" id="rt_num" type="text" />
						</td>
					</tr>
					<tr>
						<td><label for="rt_start">Start From</label>
						</td>
						<td><input name="rt_start" id="rt_s" type="text"/>
						</td>
					</tr>
					<tr>
						<td><label for="rt_end">Ends At</label>
						</td>
						<td><input name="rt_end" id="rt_e" type="text"/>
						</td>
					</tr>
					<tr></tr>
				</table>
				<input type="submit" value="Submit" name="submit"
					style="text-align: center; width: 100px; height: 35px; background-image: url(../css/images/img07.gif)" />
			</form>
		</div>
	</div>
</body>
</html>
