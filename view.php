<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View All Tournaments</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
	<link rel="icon" href="webicon.png">
	<?php include "db_connect.php"; 
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
			<div align="right">
			<form action="" method="get">
			<input type="text" name="search" style="width:200px; align:right" placeholder="Search tournament name"> <input type="submit" name="submit" value="Search" >
			</form>
			</div>
            <h1>AVAILABLE TOURNAMENTS</h1>
			<?php
			$sql = "SELECT * FROM tournament ORDER BY T_DATE ASC";
			if(isset($_GET['submit']))
			{
				$searchTourney = $_GET['search'];
				$sql = "SELECT * FROM tournament WHERE T_NAME = '$searchTourney' ORDER BY T_DATE";
			}
			
			$sendsql = mysqli_query($connect,$sql);
			if($sendsql)
			{
				if(mysqli_num_rows($sendsql)>0){
				$counter = 1;
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
				
				foreach($sendsql as $row)
				{
					$future = $row['T_DATE'];
					$now = time(); // or your date as well
					$your_date = strtotime("$future");
					$datediff = $your_date - $now; 
					if(round($datediff / (60 * 60 * 24))>=0)
					{
						$idCheck = $row['T_ID'];
					$sqlCheck = "SELECT * FROM join_tournament WHERE T_ID = '$idCheck'";
					$sendCheck = mysqli_query($connect, $sqlCheck);
					if($sendCheck)
						$parNo = mysqli_num_rows($sendCheck);
					echo "<tr><td align='center'>" . $counter . ".</td>";
					echo "<td>".$row['T_NAME'] . "</td>";
					echo "<td align='center'>".$row['T_GENRE']. "</td>";
					echo "<td align='center'>".$row['T_VENUE']. "</td>";
					echo "<td align='center'>".$row['T_DATE']. "</td>";
					echo "<td align='center'>".round($datediff / (60 * 60 * 24))." day(s) left</td>";
					echo "<td>".$row['T_DETAILS']."</td>";
					echo "<td><center>".$parNo."</center></td>";
					if($parNo < $row['T_LIMIT'] && round($datediff / (60 * 60 * 24)) > 0)
					{
						echo "<td align='center' class='green'><b>OPEN</b></td>";
						echo "<td align='center'><a href='confirm_join.php?id=".$row['T_ID']."' target='_blank'>Join</a></td></tr>";
					}	
					else
					{
						if(round($datediff / (60 * 60 * 24)) == 0)
							echo "<td align='center' class='red'>REGISTRATION CLOSED</td>";
						else
							echo "<td align='center' class='red'>FULL</td>";
						echo "<td align='center'>Join</td></tr>";
					}
						
					
					$counter++;
					}
					
				}
				echo "</table>";
				}
				else
				{
					if(isset($_GET['submit']))
						echo $searchTourney . " not found.";
					else
						echo "No tournament(s) yet.";
				}
					
			}
			else
				echo "Query Failed!";
			?>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>