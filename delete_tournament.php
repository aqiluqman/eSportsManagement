<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Confirmation</title>
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
                    <li><a href="view.php">View Tournaments</a></li>
						<?php 
						if(isset($status) && $status)
						{
							if($_SESSION['userType'] == 1)
							{
								echo "<li><a href='myTournaments.php' class='active'>My Tournaments</a></li>";
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
            <h1>Are you sure you want to delete ?</h1>
			<?php
			$tournamentID = $_GET['id'];
			
			$sqlGet = "SELECT * FROM tournament, organiser WHERE T_ID = '$tournamentID'";
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
				}
			}
			?>
			<fieldset style="padding: 20px">
				<legend>Tournament Details</legend>
				<?php 
				echo "<h2>" . $name . "</h2>";
				echo "<p>Date : " . $date . "</p>";
				echo "<p>Genre : " . $genre . "</p>";	
				echo "<p>Venue : " . $venue . "</p>";
				echo "<p>Fee : RM" . $fee . "</p>";
				echo "<p>Details : " . $details . "</p>";
				?>

			</fieldset>
			<form method="post" action="">
				<br>
				<input type="submit" name="confirmDelete" value="Delete">
				<input type="submit" name="cancelDelete" value="Cancel">
			</form>
			<?php
			if(isset($_POST['confirmDelete']))
			{
				$sqlDel = "DELETE FROM tournament WHERE T_ID = '$tournamentID'";
				$sendsqlDel = mysqli_query($connect,$sqlDel);
				if($sendsqlDel)
				{
					if(mysqli_affected_rows($connect) == 0)
					{
						echo "Delete is not successful!";
					}
					else
						header("location: myTournaments.php?del=1");
				}
			}
			if(isset($_POST['cancelDelete']))
			header("location: myTournaments.php");
			?>
			
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>