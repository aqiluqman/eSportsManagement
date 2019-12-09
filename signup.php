<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>eGMS - E-Sports Management</title>
	<link rel="stylesheet" href="style.css"> <!-- To link the css file, simplify the coding  -->
</head>
	<link rel="icon" href="webicon.png">
<body>
        <header>
           <img src="icon.png" alt="webIcon">
            <nav>
                <ul> 
                    <li><a href="index.php">Home</a></li>
                    <li><a href="view.php">View Tournaments</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
					<li><a href="login.php" class="active">Login</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <center><h1>SIGN UP WITH EGMS TO JOIN / CREATE TOURNAMENTS</h1></center>
			<fieldset style="text-align: center;width:550px;margin: auto">
				<legend>Sign Up Form</legend>
				<table align = "center" style="text-align:left" cellpadding="5"> 
					<form action="register.php" method="post" >
						<tr><td> Full Name</td> <td>: <input name="fullname" type="text" required="required"></td></tr>
						<tr><td>Email</td><td>: <input name="email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must be in the following order: characters@characters.domain" required="required"><br></td><br></tr>
						<tr><td>Phone Number</td><td>: <input name="phone" type="text" required="required"></td></tr>
						<tr><td>Username</td><td>: <input name="user" type="text" pattern=".{6,}" title="Must be atleast 6 or more characters" required="required"></td></tr>
						<tr><td>Password</td> <td>: <input name="pass" id="pass" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="required"></td></tr>
						<tr><td>Register as</td><td> <input type="radio" name="type" value="organiser">Organiser <input type="radio" name="type" value="participant" required>Participant</td></tr>
			    </table><br>	
				<input type="submit" name="regSubmit" value="Sign Up">
				</form>
			 </fieldset>
			<div id="message">
				<h3>Password must contain the following:</h3>
				<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number" class="invalid">A <b>number</b></p>
				<p id="length" class="invalid">Minimum <b>8 characters</b></p>
			</div>
			<script>
				var myInput = document.getElementById("pass");
				var letter = document.getElementById("letter");
				var capital = document.getElementById("capital");
				var number = document.getElementById("number");
				var length = document.getElementById("length");
				// When the user clicks on the password field, show the message box
				myInput.onfocus = function() {
					document.getElementById("message").style.display = "block";
				}
				// When the user clicks outside of the password field, hide the message box
				myInput.onblur = function() {
					document.getElementById("message").style.display = "none";
				}
				// When the user starts to type something inside the password field
				myInput.onkeyup = function() {
					// Validate lowercase letters
					var lowerCaseLetters = /[a-z]/g;
					if(myInput.value.match(lowerCaseLetters)) { 
						letter.classList.remove("invalid");
						letter.classList.add("valid");
					} else {
						letter.classList.remove("valid");
						letter.classList.add("invalid");
					}

					// Validate capital letters
					var upperCaseLetters = /[A-Z]/g;
					if(myInput.value.match(upperCaseLetters)) { 
						capital.classList.remove("invalid");
						capital.classList.add("valid");
					} else {
						capital.classList.remove("valid");
						capital.classList.add("invalid");
					}
					// Validate numbers
					var numbers = /[0-9]/g;
					if(myInput.value.match(numbers)) { 
						number.classList.remove("invalid");
						number.classList.add("valid");
					} else {
						number.classList.remove("valid");
						number.classList.add("invalid");
					}
					// Validate length
					if(myInput.value.length >= 8) {
						length.classList.remove("invalid");
						length.classList.add("valid");
					} else {
						length.classList.remove("valid");
						length.classList.add("invalid");
					}
				}
			</script>	
        </main>
	<div class="footer">
		eGMS &copy; All rights reserved.
	</div>
    </body>
</html>