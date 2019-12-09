<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - E-Sports Management</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<script>
		function showPass()
		{
			var pass = document.getElementById("loginPass");
			if(pass.type === "password")
				pass.type = "text";
			else if(pass.type === "text")
				pass.type = "password";
		}
	</script>
	<?php 
	include "db_connect.php";
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("Location: index.php");
		exit;
	}
	?>
</head>
<body>
        <header>
           <img src="icon.png" alt="webIcon">
            <nav>
                <ul> 
                    <li><a href="index.php">Home</a></li>
                    <li><a href="view.php">View Tournaments</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
					<li><a href="login.php" class="active">Login</a></li>
                </ul>
            </nav>
        </header>
        <main>
			<?php 
			if(isset($_SESSION["registerStatus"]))
			{
				if($_SESSION["registerStatus"])
					echo "Register is successful! Login now!";
			}
			?>
            <h1>LOGIN TO EGMS NOW!</h1>
			<form action="" method="post">
				<table cellpadding="10">
					<tr><td>Username</td><td>: <input type="text" name="username" required></td></tr>
					<tr><td>Password</td><td>: <input type="password" name ="password" id="loginPass" required></td></tr>
					<tr><td></td><td><input type="checkbox" onclick="showPass()">Show Password</td></tr>
				</table>
				<br>
				  <input style="margin-left:10px;" type="submit" name="login" value="Login">
			</form>
			<?php
			if(isset($_POST['login'])){
				if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
				header("location: index.php");
				exit;
				}
			$username = $_POST['username']; // assign textbox to variable
			$password = $_POST['password'];
			$queryOrg = "SELECT * FROM organiser where ORG_USER='$username' AND ORG_PASS='$password'";
			$queryPar = "SELECT * FROM participant where PAR_USER='$username' AND PAR_PASS='$password'";
			
			$sendsqlOrg = mysqli_query($connect,$queryOrg) or die ("Query Failed");
			$sendsqlPar = mysqli_query($connect, $queryPar) or die("Query failed");
			
			if(mysqli_num_rows($sendsqlOrg) <= 0 && mysqli_num_rows($sendsqlPar) <= 0) //check if the user exists
				echo "<br><font color = 'red'>Username or Password that you entered is false</font><br/>";
			else 
			{
				if(mysqli_num_rows($sendsqlOrg)>0)
				{
					$user_info = mysqli_fetch_array($sendsqlOrg);
					$_SESSION['user'] = $user_info['ORG_USER'];
					$_SESSION['userID'] = $user_info['ORG_ID'];
					$_SESSION['userType'] = 1;
					$_SESSION['loggedin'] = true;
					header("Location: index.php");
				}
				else if(mysqli_num_rows($sendsqlPar)>0)
				{
					$user_info = mysqli_fetch_array($sendsqlPar);
					$_SESSION['user'] = $user_info['PAR_USER'];
					$_SESSION['userID'] = $user_info['PAR_ID'];
					$_SESSION['userType'] = 2;
					$_SESSION['loggedin'] = true;
					header("Location: index.php");
				}
			}
			}
			?>
			<br>Don't have an account yet? <a href="signup.php">SIGN UP</a> now!
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>