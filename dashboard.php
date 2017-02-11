<?php 
	include './showerror.php';
 ?>
 <html>
 	<head>
 		<title>Dashboard</title>
 		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
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
 			      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>
 			    </ul>
 			 </div>
 		</nav>
 	</body>
 </html>