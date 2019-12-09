<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Join Confirmation</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<?php 
	include "db_connect.php"; 
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		$userID = $_SESSION['userID'];
		$status = true;
		$userType= $_SESSION['userType'];
	}	
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
                    <li><a href="view.php" class="active">View Tournaments</a></li>
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
							echo "<li><a href='acc_info.php'>Account</a></li>";
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
            <h1>CONFIRMATION</h1>
			<?php
			$tournamentID = $_GET['id'];
			$orgID = $_SESSION['userID'];

			$sqlGet = "SELECT * FROM tournament WHERE T_ID = '$tournamentID'";
			$getData = mysqli_query($connect, $sqlGet);
			if($getData)
			{
				if(mysqli_num_rows($getData) > 0)
				{
					$tournamentInfo = mysqli_fetch_assoc($getData);
					$tourID = $tournamentInfo['T_ID'];
					$name = $tournamentInfo['T_NAME'];
					$genre = $tournamentInfo['T_GENRE'];
					$venue = $tournamentInfo['T_VENUE'];
					$limit = $tournamentInfo['T_LIMIT'];
					$date = $tournamentInfo['T_DATE'];
					$details = $tournamentInfo['T_DETAILS'];
					$fee = $tournamentInfo['T_PRICE'];
					$orgID = $tournamentInfo['ORG_ID'];
					$sqlGetOrgDet = "SELECT ORG_NAME,ORG_EMAIL,ORG_PHONE,ORG_USER FROM organiser WHERE ORG_ID = '$orgID'";
					$sendOrg = mysqli_query($connect,$sqlGetOrgDet);
					if($sendOrg)
					{
						if(mysqli_num_rows($sendOrg)>0)
						{
							$orgDetails = mysqli_fetch_assoc($sendOrg);
							$orgName = $orgDetails['ORG_NAME'];
							$orgEmail = $orgDetails['ORG_EMAIL'];
							$orgPhone = $orgDetails['ORG_PHONE'];
						}
					}

				}
			}
			?>
			<fieldset style="padding: 20px">
				<legend>Tournament Details</legend>
				<?php 
				echo "<h2>" . $name . "</h2>";
				echo "<p>Date : " . $date . "</p>";
				echo "<p>Organiser : " . $orgName . "</p>";
				echo "<p>Organiser Email : ".$orgEmail."</p>";
				echo "<p>Organiser No. Phone : ".$orgPhone."</p>";
				echo "<p>Genre : " . $genre . "</p>";	
				echo "<p>Venue : " . $venue . "</p>";
				echo "<p>Fee : RM" . $fee . "</p>";
				echo "<p>Details : " . $details . "</p>";
				?>
			</fieldset>
			<form method="post" action="">
				<br>
				<input type="submit" name="confirmJoin" value="Join">
				<input type="submit" name="cancelJoin" value="Cancel">
			</form>
			<?php
			if(isset($_POST['confirmJoin']))
			{
				if(isset($status) && $status)
				{
					if($userType == 2)
					{
						$sqlJoin = "INSERT INTO join_tournament (T_ID,PAR_ID)
						VALUES ('$tournamentID', '$userID')";
						$sqlCheckJoin = "SELECT * FROM join_tournament WHERE PAR_ID = '$userID' AND T_ID = '$tournamentID'";
						$sendSqlCheck = mysqli_query($connect, $sqlCheckJoin);
						if($sendSqlCheck)
						{
							if(mysqli_num_rows($sendSqlCheck) > 0)
								echo "<br><b>You have already joined this tournament!</b>";
							else{
							$insert = mysqli_query($connect, $sqlJoin);
							if($insert)
								header("location: joinedTournaments.php?status=1");
							else
								echo "Query failed!";
							}
						}
					}
					else
						echo "<br><br>You are an organiser! you cannot join a tournament.";
				}
				else
				{
					echo "<br><br><b>You must log in to join! you will be redirected to the login page...</b>";
					header("Refresh:5; url=login.php", true, 303); 
				}
					
			}
			if(isset($_POST['cancelJoin']))
				echo "<script>window.close()</script>"
			?>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>