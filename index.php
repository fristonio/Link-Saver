<html>
	<head>
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<?php 
			
		 ?>
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
						<form action="dashboard.php" id="log-form" method="post">
							<input type="email" placeholder="user@example.com" name="email" ><br>
							<input type="password" placeholder="*****" name="pass"><br>
							<input type="submit" value="Submit" name="log-submit"><br>
						</form>
					</div>
				</div>

				<div class="register">
					<div>
						<form action="register.php" id="reg-form" method="post">
							<input type="text" name="name" placeholder="Username"><br>
							<input type="email" placeholder="user@example.com" name="email"><br>
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