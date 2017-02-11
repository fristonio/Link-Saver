<?php 
	$host="localhost";
	$user="root";
	$pass="Pathak@123";

	$conn= new mysqli($host,$user,$pass);
	if($conn->connect_error){
		die ("Sorry the connection failed  :  ".$conn->connect_error);
	}
	else{
		echo "Connection to mysql successful  <br>  ";
		$query="CREATE DATABASE savelink;";
		$result=$conn->query($query);
		if ($result==TRUE) {
			echo "DATABASE created successfully  <br> ";
		}
		else{
			echo "Database creation Unsuccessfull  <br> ".$conn->error;
		}
	}
	$conn->close();
	$dbname="savelink";
	$conn=new mysqli($host,$user,$pass,$dbname);

	if($conn->connect_error){
		die("For the creation of the database the connection cannot be established ...   :   ".$conn->connect_error);
	}
	else{
		echo "Connection successfull  ";
		$query2="CREATE TABLE links(
				lid int not null auto_increment,
				email varchar(30) NOT NULL,
				link varchar(60) NOT NULL,
				UNIQUE (email),
				PRIMARY KEY (lid)
				);";
		$query="CREATE TABLE users(
				uid int NOT NULL AUTO_INCREMENT,
				username varchar(30) NOT NULL,
				password varchar(50) NOT NULL,
				email varchar(50) NOT NULL,
				UNIQUE (email),
				PRIMARY KEY (uid));";
		$result=$conn->query($query);
		$result2=$conn->query($query2);
		if ($result==true) {
			echo "TABLE users CREATED  <br> ";
		}
		if ($result2==true) {
			echo "TABLE LINKS CREATED  <br>";
		}
	}
 ?>