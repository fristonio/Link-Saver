<?php 
	include './showerror.php';
 ?>
 <html>
 	<head>
 		<title>Dashboard</title>
 		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
 		<link rel="stylesheet" href="./style.css">
 	</head>
 	<body>
 		<nav class="navbar navbar-inverse">
 			<div class="container-fluid">
 			    <div class="navbar-header">
 			      <a class="navbar-brand" href="#"><?php //echo $_SESSION["user"]; ?>Fristonio</a>
 			    </div>
 			    <ul class="nav navbar-nav">
     				 <li class="active"><a href="#">DASHBOARD</a></li>
   				</ul>
 			    <ul class="nav navbar-nav navbar-right">
 			      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>
 			    </ul>
 			 </div>
 		</nav>
	
 		<div id="add-links" class="container">
 			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="link-form" method="post">
 				<div class="input">
 					Link : <input type="text"><br>
 					Description : <input type="textarea">
 				</div>
 				<div class="button">
 					<input type="submit" value="Submit">
 				</div>
 				
 			</form>
 		</div>	

 		<div id="show-links" class="container">
 			<h2>Saved Links</h2>
 		</div>
 	</body>
 </html>