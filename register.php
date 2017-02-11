<?php 
	include 'showerror.php';
	$host="localhost";
	$user="root";
	$pass="Pathak@123";
	$dbname="savelink";

	function sanitize($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$name=$email=$pass='';

	$conn= new mysqli($host,$user,$pass,$dbname);
	if($conn->connect_error){
		die ("Sorry the connection to database failed  :  ".$conn->connect_error);
	}
	else{
		if (isset($_POST["reg-submit"])) {
			$name=sanitize($_POST["name"]);
			$email=sanitize($_POST["email"]);
			$pass=hash("sha256",sanitize($_POST["pass"]));

			$sql="INSERT INTO 
				users(username,password,email)
				VALUES('$name','$pass','$email');";
			$result=$conn->query($sql);
			if($result==true){
				echo "User has been added to the databases Click here to go to HOMEPAGE";
			}
			else{
				echo "Sorry the data cannot be entered to the databases.... TRY AGAIN";
			}
		}
	}
 ?>