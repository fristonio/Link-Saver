<?php 
	include './showerror.php';
	session_destroy();
	header("location:index.php");
 ?>