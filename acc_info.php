<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - E-Sports Management</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<?php include "db_connect.php"; 
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
		$status = true;
	else
		$status = false;
	?>
</head>
<body>
        <header>
           <img src="icon.png" alt="webIcon">
            <nav>
                <ul> 
                    <li><a href="index.php">Home</a></li>
                    <li><a href="view.php">View Tournaments</a></li>
						<?php 
						if(isset($status) && $status)
						{
							if($_SESSION['userType'] == 1)
							{
								echo "<li><a href='myTournaments.php'>My Tournaments</a></li>";
								echo "<li><a href='addTournaments.php'>Add Tournament</a></li>";
							}
							else{
								echo "<li><a href='joinedTournaments.php'>Joined Tournaments</a></li>";
							}
							echo "<li><a href='acc_info.php' class='active'>Account</a></li>";
							echo "<li><a href='aboutus.php'>About Us</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}
						else
						{
							echo "<li><a href='aboutus.php'>About Us</a></li>";
							echo "<li><a href='login.php'>Login</a></li>";
						}
						?>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Account Info</h1>
			<p>Edit your account info.</p><br>
			<?php
			$id = $_SESSION['userID'];
			if(isset($_POST['submitEdit']))
			{
				$newName = $_POST['name'];
				$newEmail = $_POST['email'];
				$newPhone = $_POST['phone'];
				$newPass = $_POST['password'];
			}
			if($_SESSION['userType'] == 1 )
			{
				$sql = "SELECT * FROM organiser WHERE ORG_ID = '$id'";
				if(isset($_POST['submitEdit']))
				{
					$sqlUpdate = "UPDATE organiser 
					SET ORG_NAME = '$newName' , ORG_EMAIL = '$newEmail' , ORG_PHONE = '$newPhone' , ORG_PASS = '$newPass' 
					WHERE ORG_ID = '$id'";
				}
			}
			else
			{
				$sql = "SELECT * FROM participant WHERE PAR_ID = '$id'";
				if(isset($_POST['submitEdit']))
				{
					$sqlUpdate = "UPDATE participant 
					SET PAR_NAME = '$newName' , PAR_EMAIL = '$newEmail' , PAR_PHONE = '$newPhone' , PAR_PASS = '$newPass' 
					WHERE PAR_ID = '$id'";
				}
			}
			$sendsql = mysqli_query($connect, $sql);
			
			if($sendsql)
			{
				if(mysqli_num_rows($sendsql) > 0)
				{
					$acc_info = mysqli_fetch_assoc($sendsql);
					if($_SESSION['userType'] == 1 )
					{
						$username = $acc_info['ORG_NAME'];
						$email = $acc_info['ORG_EMAIL'];
						$phone = $acc_info['ORG_PHONE'];
						$passAcc = $acc_info['ORG_PASS'];
					}
					else{
						$username = $acc_info['PAR_NAME'];
						$email = $acc_info['PAR_EMAIL'];
						$phone = $acc_info['PAR_PHONE'];
						$passAcc = $acc_info['PAR_PASS'];
					}
				}
			}
			if(isset($_POST['submitEdit']))
			{
				$sendSqlUpdate = mysqli_query($connect, $sqlUpdate);
				if(mysqli_affected_rows($connect) == 0)
					echo "Unable to change, make sure you enable edit first.<br>";
				else
				{
					echo "Changes Saved!<br>";
					header("Refresh:5; url=acc_info.php", true, 303); 
				}
					
			}
				
			?>
			<script>
	function enableEdit() //to enable the edit form for user to update their info
	{
		document.getElementById("name").disabled = false;
		document.getElementById("email").disabled = false;
		document.getElementById("phone").disabled = false;
		document.getElementById("pass").disabled = false;
	}
</script>
			<fieldset>
			<form name="edit" method="post">
				<table>
					<tr>
						<tr><td>Name</td><td>: <input id="name" type="text" name="name" value="<?php echo $username; ?>" disabled="true"></td></tr>
					</tr>
				    <tr>
						<tr><td>Email</td><td>: <input id="email" type="text" name="email" value="<?php echo $email; ?>" disabled="true"></td></tr>
					</tr>
				     <tr>
						<tr><td>Phone</td><td>: <input id="phone" type="text" name="phone" value="<?php echo $phone; ?>" disabled="true"></td></tr>
					</tr>
			         <tr>
						<tr><td>Password</td><td>: <input id="pass" type="text" name="password" value="<?php echo $passAcc; ?>" disabled="true"></td></tr>
					</tr>
				</table>
	<br><input type="button" name="edit" value="Enable Edit" onclick="enableEdit()"></td><td>    <input type="submit" name="submitEdit" value="Save Changes" onclick="enableEdit()">
			</form>
			</fieldset>

        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>