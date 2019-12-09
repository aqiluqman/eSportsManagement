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
		* {box-sizing: border-box;}
		.mySlides {display: none;}
		img {vertical-align: middle;}
		header {
			position:absolute;
			position:fixed;
			z-index: 5;
		}
		/* Slideshow container */
		.slideshow-container {
		  max-width: 1000px;
		  position: relative;
		  margin: auto;
		}

		/* Caption text */
		.text {
		  color: #f2f2f2;
		  font-size: 15px;
		  padding: 8px 12px;
		  position: absolute;
		  bottom: 8px;
		  width: 100%;
		  text-align: center;
		}

		/* Number text (1/3 etc) */
		.numbertext {
		  color: #f2f2f2;
		  font-size: 12px;
		  padding: 8px 12px;
		  position: absolute;
		  top: 0;
		}

		/* The dots/bullets/indicators */
		.dot {
		  height: 15px;
		  width: 15px;
		  margin: 0 2px;
		  background-color: #bbb;
		  border-radius: 50%;
		  display: inline-block;
		  transition: background-color 0.6s ease;
		}

		.active {
		  background-color: #717171;
		}

		/* Fading animation */
		.fade {
		  -webkit-animation-name: fade;
		  -webkit-animation-duration: 2.0s;
		  animation-name: fade;
		  animation-duration: 2.0s;
		}

		@-webkit-keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		@keyframes fade {
		  from {opacity: .4} 
		  to {opacity: 1}
		}

		/* On smaller screens, decrease text size */
		@media only screen and (max-width: 300px) {
		  .text {font-size: 11px}
		}
</style>
</head>
<body>
        <header>
           <img src="icon.png" alt="webIcon">
            <nav>
                <ul> 
                    <li><a href="index.php" class="active">Home</a></li>
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
            <h1>WELCOME TO E-GAMES MANAGEMENT SYSTEM  <?php 
				if($status)
					echo ", " . $_SESSION['user'] . ".";
				?></h1>
			<div class="slideshow-container">

            <div class="mySlides fade">
            <div class="numbertext">1 / 5</div>
            <img src="pic5.png" style="width:100% " >
            <div class="text">ESPORT GAMING</div>
            </div>

            <div class="mySlides fade">
            <div class="numbertext">2 / 5</div>
            <img src="pic2.png" style="width:100%">
            <div class="text">ESPORT GAMING</div>
            </div>

            <div class="mySlides fade">
            <div class="numbertext">3 / 5</div>
            <img src="pic3.png" style="width:100%">
            <div class="text">ESPORT GAMING</div>
            </div>

            <div class="mySlides fade">
            <div class="numbertext">4 / 5</div>
            <img src="pic4.png" style="width:100%">
            <div class="text">ESPORT GAMING</div>
            </div>

            <div class="mySlides fade">
            <div class="numbertext">5 / 5</div>
            <img src="pic1.png" style="width:100%">
            <div class="text">ESPORT GAMING</div>
            </div>

            </div>
            <br>

            <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            </div>

            <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 5000); // Change image every 2 seconds
            }
            </script>
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>