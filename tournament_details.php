<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tournarment Details</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<?php 
	include "db_connect.php"; 
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		if(isset($_SESSION['userID']))
			$userID = $_SESSION['userID'];
		$status = true;
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
								echo "<li><a href='joinedTournaments.php' class='active'>Joined Tournaments</a></li>";
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
			<?php
			$tournamentID = $_GET['id'];
			$userType= $_SESSION['userType'];

			$sqlGet = "SELECT * FROM tournament WHERE T_ID = '$tournamentID'";
			$getData = mysqli_query($connect, $sqlGet);
			if($getData)
			{
				if(mysqli_num_rows($getData) > 0)
				{
					$tournamentInfo = mysqli_fetch_assoc($getData);
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
						if(mysqli_num_rows($sendOrg))
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
				echo "<p>Genre : " . $genre . "</p>";	
				echo "<p>Venue : " . $venue . "</p>";
				echo "<p>Fee : RM" . $fee . "</p>";
				echo "<p>Details : " . $details . "</p>";
				?>
			</fieldset>

        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>