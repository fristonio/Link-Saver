<?php  
	include './showerror.php';
	$nameErr=$emailErr=$passErr='';
	$SeeError=0;
	function sanitize($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	if (isset($_POST["reg-submit"])) {
		$host="localhost";
		$user="root";
		$cpass="Pathak@123";
		$dbname="savelink";

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
						$('.phperror').delay(2000).fadeOut();},1500);</script>";
				}		
		}
	}
 ?>

<?php 
	$emailerror='';
	$email=$pass='';
	$error=$validate=0;
	if (isset($_POST["log-submit"])) {
		$host="localhost";
		$user="root";
		$cpass="Pathak@123";
		$dbname="savelink";

		$conn= new mysqli($host,$user,$cpass,$dbname);
		if($conn->connect_error){
			die ("<div class='phperror'>Sorry the connection to database failed  :  ".$conn->connect_error."</div>");
		}
		else{
			$email=sanitize($_POST["email"]);
			$pass=hash("sha256",sanitize($_POST["pass"]));
			echo "<script>setTimeout(function(){console.log(".$pass.");},1000);</script>";
			if (empty($email)) {
					$emailerror="Email req ... No yahoo plz...!!";
					$error=1;
			}
			else{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailerror = "Don't u know the format of email ..."; 
					$error=1;
				}
			}

			if($error==0){
				$sql="SELECT * FROM users";
				$result=$conn->query($sql);
				if(!$result){
					die("Cannot get the required information from the database");
				}
				else{
					while($row=$result->fetch_assoc()){
						if ($email==$row["email"] and $pass==$row["password"]) {
							$validate=1;
							session_start();
							$_SESSION["user"]=$row["username"];
							$_SESSION["email"]=$row["email"];
							$_SESSION["password"]=$row["password"];
							header("location:dashboard.php");
							setcookie("username", $row["username"], time() + (86400 * 30));
							setcookie("email", $row["email"], time() + (86400 * 30));
						}
					}
					if ($validate==0) {
						echo "<div class='phperror'>Sorry the username and password cannot be validated  .... Try again</div>";
						echo "<script>setTimeout(function(){
							document.getElementById('login-nav').click();
							$('.phperror').delay(2000).fadeOut();},1500);</script>";
						}
				}
			}
			else{
				//echo "<div class='phperror'>Correct the problem with the form submitted</div>";
				echo "<script>setTimeout(function(){
					document.getElementById('login-nav').click();
					$('.phperror').delay(2000).fadeOut();},1500);</script>";
			}	

		}

	}	

 ?>

<html>
	<head>
		<title>Linksaver</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
					<button id="login-nav"><h3>Login</h3></button>
				</div>
				<div class="register-nav">
					<button id="register-nav"><h3>Register</h3></button>
				</div>
			</div>
			<div class="log-reg">
				<div class="login">
					<div class="logindiv">
						<h1>Login</h1>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="log-form" method="post">
								<div class="input-group">
									<label for=""><?php echo "<span class='error'>".$emailerror."</span>"; ?></label>
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="email" placeholder="user@example.com" name="email" class="form-control" >
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="password" placeholder="*****" name="pass" class="form-control" id="password">
								</div>
								<div class="input-group">
									<input type="submit" value="Submit" name="log-submit" class="form-control btn btn-info">
								</div>
						</form>
					</div>
				</div>

				<div class="register">
					<div class="registerdiv">
						<h1>Register</h1>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="reg-form" method="post">
							<div class="input-group">
								<input type="text" name="name" placeholder="Username" class="form-control"><?php echo "<span class='error'>".$nameErr."</span>"; ?>
							</div>
							<div class="input-group">
								<input type="email" placeholder="user@example.com" name="email" class="form-control"><?php echo "<span class='error'>".$emailErr."</span>"; ?>
							</div>
							<div class="input-group">
								<input type="password" placeholder="*****" name="pass" class="form-control">
							</div>
							<div class="input-group">
								<input type="submit" value="Submit" name="reg-submit" class="form-control btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="./script.js"></script>
	</body>
</html>