<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - E-Sports Management</title>
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
								echo "<li><a href='myTournaments.php'>My Tournaments</a></li>";
								echo "<li><a href='addTournaments.php' class='active'>Add Tournament</a></li>";
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
            <h1>CREATE NEW TOURNAMENT</h1>
			
			<form action="" method="post">
			<fieldset style="padding: 20px">
				<legend>Tournament Details</legend>
				Competition Name: <input type="text" style="width:350px" name="tournamentName" required><br><br>
				Game Genre:
				<select name="genre" required>
					<option value="Sports">Sports</option> 
					<option value="Strategy">Strategy</option>
					<option value="Fighting">Fighting</option>
					<option value="Racing">Racing</option>
				</select> Max Participant: <input style="width:80px" type="text" name="limit" placeholder="example: 50"><br><br>
				Venue: <input type="text" name="venue" required>
			    Date: <input type="date" name="dateTournament" required><br><br>
				Entry fee (RM) : <input type="text" name="price" placeholder="Enter 0 if no entrance fee"><br><br>
				Details: <br><textarea rows="10" cols="50" name="details" maxlength="200" placeholder="Write your additional details here..."></textarea><br><br>
				<input type="submit" name="submitTournament" value="Create Tournament">
			</fieldset>
			</form>
			<?php
			if(isset($_POST['submitTournament']))
			{
				$tournamentName = $_POST['tournamentName'];
				$genre = $_POST['genre'];
				$venue = $_POST['venue'];
				$date = $_POST['dateTournament'];
				$details = $_POST['details'];
				$price = $_POST['price'];
				$limit = $_POST['limit'];
				$orgID = $_SESSION['userID'];
				
				$sql = "INSERT INTO tournament(T_NAME,T_GENRE,T_VENUE,T_DATE,T_DETAILS,T_PRICE,T_LIMIT,ORG_ID)
				VALUES('$tournamentName','$genre','$venue','$date','$details','$price','$limit','$orgID')";
				
				$sendsql = mysqli_query($connect,$sql);
				
				if($sendsql)
				{
					header("location: myTournaments.php?add=1"); 
				}
				else
					echo "Failed! Make sure you fill in the right information!";
			}
			?>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>