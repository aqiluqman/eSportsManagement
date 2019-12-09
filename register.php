<!doctype html>
<html>
<head>
<title>Sign Up</title>
</head>
	
<body>
<?php
	session_start();
	include "db_connect.php";
	
	if(isset($_POST['regSubmit']))
	{
		$fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$phone = mysqli_real_escape_string($connect, $_POST['phone']);
		$user = mysqli_real_escape_string($connect, $_POST['user']);
		$pass = mysqli_real_escape_string($connect, $_POST['pass']);
		$type = mysqli_real_escape_string($connect, $_POST['type']);
		
		if(empty($fullname) || empty($email) || empty($phone) || empty($user) || empty($pass))
		{
			if(empty($fullname))
			{
				echo "<font color = 'red'>Name field is empty!</font><br/>";
			}
			if(empty($email))
			{
				echo "<font color = 'red'>Email field is empty!</font><br/>";
			}
			if(empty($phone))
			{
				echo "<font color = 'red'>Phone Number field is empty!</font><br/>";
			}
			if(empty($user))
			{
				echo "<font color = 'red'>Username field is empty!</font><br/>";
			}
			if(empty($pass))
			{
				echo "<font color = 'red'>Password field is empty!</font><br/>";
			}
			echo "<br/><a href='javascript:self.history.back();'>Go back</a>";
		}
		else
		{
		if($type === "organiser")
		{
			$sendsql = "INSERT INTO organiser (ORG_NAME,ORG_EMAIL,ORG_PHONE,ORG_USER,ORG_PASS)
			VALUES('$fullname','$email','$phone','$user','$pass')";
			
		} else {
			$sendsql = "INSERT INTO participant (PAR_NAME,PAR_EMAIL,PAR_PHONE,PAR_USER,PAR_PASS)
			VALUES('$fullname','$email','$phone','$user','$pass')";
		}
		$result = mysqli_query($connect,$sendsql);
		if($result)
		{
			$_SESSION["registerStatus"] = true;
			header("Location: login.php"); 
		}
		else
		{
			echo "Query failed!";
		}
		}
	}
	?>
</body>
</html>