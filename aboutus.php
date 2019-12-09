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
								echo "<li><a href='joinedTournaments.php'>Joined Tournaments</a></li>";
							}
							echo "<li><a href='acc_info.php'>Account</a></li>";
							echo "<li><a href='aboutus.php' class='active'>About Us</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}
						else
						{
							echo "<li><a href='aboutus.php' class='active'>About Us</a></li>";
							echo "<li><a href='login.php'>Login</a></li>";
						}
						?>
                </ul>
            </nav>
        </header>
        <main>
            <h1>ABOUT US</h1>
			<table>
						<tr>
							<th><b><h2><i>WE ARE eGMS<b></i></h2></th>
							<th></th>
						</tr>
							<td><p><font size='4'>Founded in 2019, eGMS has been developed into the world’s largest esports website
							leading the industry across the most popular video games with numerous online and offline
							competitions. It operates high profile services, with offices all over the world. We provide ease for gamers to joining or creating
							an competition events. eGMS is leading esports forward on a global scale. </font></p></td>
							<td align="center"><img src="iconn.png" alt="webIcon"width="400" height="200"></td>
					 </table>
			<table >
                    <tr>
                        <th></th>
						<th><b><h2><i>OUR SERVICE<b></i></h2></th>
					</tr>
						<td align="center"><img src="pic6.png" alt="webIcon"width="400" height="200"></td>
                        <td>
						<p><font size='4'>We cover a broad field of services in esports and gaming technology, people can join tournament in Malaysia by register from our website,
						to gain information on current tournaments,
						event management, advertising and
						fully catering to the needs of the esports ecosystem. 
						</font><p>
						<p><font size='4'>We create a place where everybody can be somebody, turn niche games into global sensations,
						and moments of brilliance into everlasting legacy.</font></P>
						</td>
                 </table>
				 
				    <table>
                    <tr>
                        <th><b><h2><i>ABOUT ESPORT<b></i></h2></th>
						<th></th>
					</tr>
						<td><p><font size='4'>Esports enjoys worldwide recognition as the fastest growing segment
						of media and entertainment,with the youngest and most coveted fan base. 
						ESL has shaped the history of esports, creating more opportunities for participation
						and progression than any other sport.</p>
						<p><font size='4'>It’s a sport where anybody can experience the 
						thrill of victory.For us it's more than business, it’s a form of entertainment where 
						every fan has a voice and where everyone fits in and anybody can stand out.</p></font>
						</td>
                        <td align="center"><img src="pic5.png" alt="webIcon"width="400" height="200"></td>
                 </table>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>