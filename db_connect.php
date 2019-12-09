<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Connection Test</title>
</head>

<body>
	<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbname = "egms";
	
	$connect = mysqli_connect($hostname, $username, $password, $dbname) 
			   OR DIE ("Connection failed");
	?>
</body>
</html>