<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Participants</title>
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
            <h1>LIST OF REGISTERED PARTICIPANT(S)</h1>
			<?php
			$orgID = $_SESSION['userID'];
			$tourID = $_GET['id'];
			if(isset($_GET['status']) && $_GET['status'] == 1)
				echo "REMOVED SUCCESSFULLY";
			$sql = "SELECT PAR_ID FROM join_tournament WHERE T_ID = '$tourID'";

			$sendsql = mysqli_query($connect,$sql);
			if($sendsql)
			{
				$counter = 1;
				echo "<table style= 'border-collapse: collapse' bgcolor='#F8F8FF' class='gtext'><tr>
				<th>No.</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Full Name</th>
				<th>Action</th>
				</tr>";
				
				foreach($sendsql as $row)
				{
					$idCheck = $row['PAR_ID'];
					$sqlCheck = "SELECT PAR_NAME, PAR_ID, PAR_USER, PAR_EMAIL, PAR_PHONE FROM participant WHERE PAR_ID = '$idCheck'";
					$sendCheck = mysqli_query($connect, $sqlCheck);
					if($sendCheck)
					{
						if(mysqli_num_rows($sendCheck)>0)
						{
							foreach($sendCheck as $user)
							{
								echo "<tr><td>".$counter.".</td>";
								echo "<td>".$user['PAR_USER']."</td>";
								echo "<td>".$user['PAR_NAME']."</td>";
								echo "<td>".$user['PAR_EMAIL']."</td>";
								echo "<td>".$user['PAR_PHONE']."</td>";
								echo "<td>".$user['PAR_NAME']."</td>";
								echo "<td align='center'><a href='remove_user.php?idU=".$user['PAR_ID']."&idT=".$tourID."' target='_blank'>Remove</a></td>";
								$counter++;
							}
						}
					}

				}
				echo "</table>";
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