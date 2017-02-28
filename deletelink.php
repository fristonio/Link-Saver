<?php 
	include './showerror.php';
	require_once './config.php';
	session_start();
	if (!isset($_SESSION["user"])) {
		header("location:index.php");
	}
	else{
		$conn= new mysqli($host,$user,$cpass,$dbname);
		if($conn->connect_error){
			die ("<div class='phperror'>Sorry the connection to database failed  :  ".$conn->connect_error."</div>");
		}
		else{
			$query="DELETE FROM links WHERE email='".$_SESSION['email']."'AND lid={$_GET["listid"]}";
			$result=$conn->query($query);
			header("location:dashboard.php");
		}	
	}
 ?>