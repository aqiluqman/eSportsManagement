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
	<style>
	.gtext {
    color: black;
	}
	table td,th{
		padding : 10px;
		border: 1px solid black;
		
	}
	td{
		padding : 10px;
	}
	.green{
	color: green;
		}
	.red{
	color:red;
		}
	</style>
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
            <h1>YOUR JOINED TOURNAMENTS</h1>
				<?php
			if(isset($_GET['status']))
				echo "You've successfully joined.";
				$userID = $_SESSION['userID'];
				$sqlGet = "SELECT * FROM join_tournament WHERE PAR_ID = '$userID'";
				$sendSqlGet = mysqli_query($connect, $sqlGet);
				if($sendSqlGet)
				{
					if(mysqli_num_rows($sendSqlGet)>0)
					{
						echo "<table style= 'border-collapse: collapse' bgcolor='#F8F8FF' class='gtext'><tr>
								<th>No.</th>
								<th>Tournament Name</th>
								<th>Tournament Genre</th>
								<th>Tournament Venue</th>
								<th>Tournament Date</th>
								<th>Remaining Day(s) to Start</th>
								<th>Tournament Details</th>
								<th>Registered Participants</th>
									<th>Status</th>
								<th>Action</th>
								</tr>";
						$counter = 1;
						foreach($sendSqlGet as $joined)
						{
							$joinedTourID = $joined['T_ID'];
							$sqlGetTourney = "SELECT * FROM tournament WHERE T_ID = '$joinedTourID'";
							$sendsql = mysqli_query($connect, $sqlGetTourney);
							if($sendsql)
							{
								if(mysqli_num_rows($sendsql)>0){
									$row = mysqli_fetch_assoc($sendsql);
									$idCheck = $row['T_ID'];
									$sqlCheck = "SELECT * FROM join_tournament WHERE T_ID = '$idCheck'";
								    $sendCheck = mysqli_query($connect, $sqlCheck);
								if($sendCheck)
									$parNo = mysqli_num_rows($sendCheck);
								echo "<tr><td>" . $counter . ".</td>";
								echo "<td>".$row['T_NAME'] . "</td>";
								echo "<td align='center'>".$row['T_GENRE']. "</td>";
								echo "<td align='center'>".$row['T_VENUE']. "</td>";
								echo "<td align='center'>".$row['T_DATE']. "</td>";
								$future = $row['T_DATE'];
								$now = time(); // or your date as well
								$your_date = strtotime("$future");
								$datediff = $your_date - $now; 
								echo "<td align='center'>".round($datediff / (60 * 60 * 24))." day(s) left</td>";
								echo "<td>".$row['T_DETAILS']."</td>";
								echo "<td align='center'>".$parNo."</td>";
								if($parNo <= $row['T_LIMIT'] && round($datediff / (60 * 60 * 24))>0)
									echo "<td align='center' class='green'>OPEN</td>";
								else
								{
									if(round($datediff / (60 * 60 * 24)) == 0)
										echo "<td align='center' class='green'>OPEN TODAY</td>";
									else
										echo "<td align='center' class='red'>FULL</td>";
								}					
								echo "<td align='center'><a href='tournament_details.php?id=".$row['T_ID']."' target='_blank'>Detailed View</a></td></tr>";
								$counter++;
								}	
							}
						}
						echo "</table>";
					}
					else
						echo "You have not joined any tournaments :-(";
				}
				else
					echo "Query failed.";
				?>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>