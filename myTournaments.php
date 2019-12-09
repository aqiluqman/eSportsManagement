<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - My Tournaments</title>
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
            <h1>MY TOURNAMENTS</h1>
			<?php
			$orgID = $_SESSION['userID'];
			$sql = "SELECT * FROM tournament WHERE ORG_ID = '$orgID'";
			
			if(isset($_GET['del']))
			{
				echo "<b>Delete successful!<b>";
			}
			if(isset($_GET['add']))
				echo "<b>New tournament has been added!</b>";

			$sendsql = mysqli_query($connect,$sql);
			if($sendsql)
			{
				$counter = 1;
				echo "<table style= 'border-collapse: collapse' bgcolor='#F8F8FF' class='gtext'><tr>
				<th>No.</th>
				<th>Tournament Name</th>
				<th>Tournament Genre</th>
				<th>Tournament Venue</th>
				<th>Tournament Date</th>
				<th>Tournament Details</th>
				<th>Registered Participants</th>
				<th>Status</th>
				<th colspan='2' >Action</th>
				</tr>";
				
				foreach($sendsql as $row)
				{
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
					echo "<td>".$row['T_DETAILS']."</td>";
					echo "<td align='center'>".$parNo." <a href='view_participant.php?id=".$idCheck."'>[Click to View]</a></td>";
					
					if($parNo <= $row['T_LIMIT'])
						echo "<td align='center' class='green'>OPEN</td>";	
					else
						echo "<td align='center' class='red'>FULL</td>";
					echo "<td align='center'><a href='edit_tournament.php?id=".$row['T_ID']."'>Edit</a></td>";
					echo "<td align='center'><a href='delete_tournament.php?id=".$row['T_ID']."'>Delete</a></td></tr>";	
					$counter++;
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