<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - Edit Tournament</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<?php 
	include "db_connect.php"; 
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
            <h1>EDIT TOURNAMENT</h1>
			<?php
			$userID = $_SESSION['userID'];
			$tournamentID = $_GET['id'];

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
				}
			}
			if(isset($_POST['submitTournament']))
			{
				$newTournamentName = $_POST['tournamentName'];
				$newGenre = $_POST['genre'];
				$newVenue = $_POST['venue'];
				$newDate = $_POST['dateTournament'];
				$newDetails = $_POST['details'];
				$newPrice = $_POST['price'];
				$newLimit = $_POST['limit'];
				
				$sqlUpdate = "SELECT * FROM tournament WHERE ORG_ID = '$userID'";
				$sqlUpdate = "UPDATE tournament SET T_NAME='$newTournamentName' , T_GENRE = '$newGenre' , T_VENUE = '$newVenue' , T_LIMIT = $newLimit , T_DATE = '$newDate' , T_DETAILS = '$newDetails' , T_PRICE = '$newPrice' WHERE T_ID = '$tournamentID'";
				
				$sendsqlUpdate = mysqli_query($connect,$sqlUpdate);
				
				if($sendsqlUpdate)
				{
					echo "<b>Saved changes!</b><br><br>";
				}
				else
					echo "Failed! Make sure you fill in the right information!";
			}
			?>
			<form action="" method="post">
			<fieldset style="padding: 20px">
				<legend>EDIT SECTION</legend>
				Competition Name: <input type="text" style="width:350px" name="tournamentName" value="<?php echo $name; ?>" required><br><br>
				Game Genre:
				<select name="genre" required>
					<?php if($genre == "Sports")
{
	echo "<option value='Sports' selected='selected'>Sports</option> 
					<option value='Strategy'>Strategy</option>
					<option value='Fighting'>Fighting</option>
					<option value='Racing'>Racing</option>";
}
					else if ($genre == "Strategy")
					{
						echo "<option value='Sports'>Sports</option> 
					<option value='Strategy' selected='selected'>Strategy</option>
					<option value='Fighting'>Fighting</option>
					<option value='Racing'>Racing</option>";
					}
					else if ($genre == "Fighting")
					{
						echo "<option value='Sports'>Sports</option> 
					<option value='Strategy'>Strategy</option>
					<option value='Fighting' selected='selected'>Fighting</option>
					<option value='Racing'>Racing</option>";
					}
					else if($genre == "Racing")
					{
						echo "<option value='Sports'>Sports</option> 
					<option value='Strategy'>Strategy</option>
					<option value='Fighting'>Fighting</option>
					<option value='Racing' selected='selected'>Racing</option>";
					}
					?>
				</select> Max Participant: <input style="width:80px" type="text" name="limit" placeholder="example: 50" value="<?php echo $limit; ?>"><br><br>
				Venue: <input type="text" name="venue" value="<?php echo $venue; ?>" required>
			    Date: <input type="date" name="dateTournament" value="<?php echo $date; ?>" required><br><br>
				Details: <br><textarea rows="10" cols="50" name="details" maxlength="200" placeholder="Write your additional details here..."><?php echo $details; ?></textarea><br><br>
				Entry fee (RM) : <input type="text" name="price" placeholder="Enter 0 if no entrance fee" value="<?php echo $fee; ?>"><br><br>
				<input type="submit" name="submitTournament" value="Save">
			</fieldset>
			</form>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>