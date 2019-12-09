<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Remove Confirmation</title>
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
            <h1>USER REMOVAL CONFIRMATION</h1>
			<?php
			$orgID = $_SESSION['userID'];
			$tourID = $_GET['idT'];
			$parID = $_GET['idU'];
			
			$sql = "SELECT PAR_USER FROM participant WHERE PAR_ID = '$parID'";
			$sendsql = mysqli_query($connect,$sql);
			if($sendsql)
			{
				if(mysqli_num_rows($sendsql)>0)
				{
					$participant = mysqli_fetch_assoc($sendsql);
					echo "Are you sure you want to remove ".$participant['PAR_USER']." from the tournament?";
					echo "<form method='post' action=''>";
					echo "<br><input type='submit' name='confirm' value='Yes'>";
					echo " <input type='submit' name='cancel' value='Cancel'>";
					echo "</form>";
					if(isset($_POST['confirm']))
					{
						$sqlDel = "DELETE FROM join_tournament WHERE PAR_ID = '$parID' AND T_ID = '$tourID'";
						$sendDel = mysqli_query($connect, $sqlDel);
						if($sendDel)
						{
							if(mysqli_affected_rows($connect)==0)
								echo "Delete fail!";
							else
								header("location: view_participant.php?id=".$tourID."&status=1");
						}
					}
					if(isset($_POST['cancel']))
						header("location: view_participant.php?id=".$tourID);
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