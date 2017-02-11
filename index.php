<?php  
	include 'showerror.php';
	$nameErr=$emailErr=$passErr='';
	$SeeError=0;
	if (isset($_POST["reg-submit"])) {
		$host="localhost";
		$user="root";
		$cpass="Pathak@123";
		$dbname="savelink";

		function sanitize($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		$name=$email=$pass='';

		$conn= new mysqli($host,$user,$cpass,$dbname);
		if($conn->connect_error){
			die ("<div class='phperror'>Sorry the connection to database failed  :  ".$conn->connect_error."</div>");
		}
		else{	
				//Sanitizing the data 
				$name=sanitize($_POST["name"]);
				$email=sanitize($_POST["email"]);
				$pass=hash("sha256",sanitize($_POST["pass"]));

				//FORM VALIDATION
				if (empty($name)) {
					$nameErr="Name is Required ";
					$SeeError=1;
				}
				else{
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		              $nameErr = "Entered name is not a valid name";
		              $SeeError=1;
		            }
				}
				if (empty($email)) {
					$emailErr="Email req ... No yahoo plz...!!";
					$SeeError=1;
				}
				else{
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					  $emailErr = "Don't u know the format of email ..."; 
					  $SeeError=1;
					}
				}

				//See if any error is found 
				if ($SeeError==0) {
					$sql="INSERT INTO 
						users(username,password,email)
						VALUES('$name','$pass','$email');";
					$result=$conn->query($sql);
					if($result==true){
						echo "<div class='phpsuccess'>User has been added to the databases Click here to go to HOMEPAGE</div>";
					}
					else{
						echo "<div class='phperror'>Sorry the data cannot be entered to the databases.... TRY AGAIN</div>";
					}
				}

				else{
					echo "<div class='phperror'>Correct the problem with the form submitted</div>";
					echo "<script>setTimeout(function(){
						document.getElementById('register-nav').click();
						$('.phperror').delay(2000).fadeOut();},500);</script>";
				}		
		}
	}
 ?>

<?php 
	
 ?>
<html>
	<head>
		<title>Linksaver</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<!-- Main div is for login and register purpose -->
		<div class="maindiv">
			<!--div for preloader-->
			<div id="preloader">
				<img src="http://cdn.ndtv.com/vp/static/images/preloader.gif" alt="">
			</div>
			<div class="navpage">
				<div class="login-nav">
					<button id="login-nav">Login</button>
				</div>
				<div class="register-nav">
					<button id="register-nav">Register</button>
				</div>
			</div>
			<div class="log-reg">
				<div class="login">
					<div>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="log-form" method="post">
							<input type="email" placeholder="user@example.com" name="email" ><br>
							<input type="password" placeholder="*****" name="pass"><br>
							<input type="submit" value="Submit" name="log-submit"><br>
						</form>
					</div>
				</div>

				<div class="register">
					<div>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="reg-form" method="post">
							<input type="text" name="name" placeholder="Username"><?php echo "<span class='error'>*".$nameErr."</span>"; ?><br>
							<input type="email" placeholder="user@example.com" name="email"><?php echo "<span class='error'>*".$emailErr."</span>"; ?><br>
							<input type="password" placeholder="*****" name="pass"><br>
							<input type="submit" value="Submit" name="reg-submit"><br>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="./script.js"></script>
	</body>
</html>