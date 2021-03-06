<?php 
	include './showerror.php';
	require_once './config.php';
	session_start();
	if (!isset($_SESSION["user"])) {
		header("location:index.php");
	}
	$msg="";
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "xm0rtis09@gmail.com";
	$mail->Password = $mailpass;	
	$mail->setFrom($mailemail, 'Sys_admin');
	$mail->addAddress($_SESSION["email"]);
	$mail->Subject = "Links You Saved ..";
	$mail->isHTML(true);
	
	function sanitize($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	$linkerr='';
	//Link Save Form
	if (isset($_POST["link-submit"])) {
		$email=$link=$description='';

		$conn=new mysqli($host,$user,$cpass,$dbname);
		if ($conn->connect_error) {
			die ("<div class='phperror'>Sorry the connection to database failed  :  ".$conn->connect_error."</div>");
		}
		else{
			if(empty($_POST["link"])){
				$linkerr="Got to be kidding save link without a link -.-";
			}
			else{
				$link=sanitize($_POST["link"]);
				$description=sanitize($_POST["description"]);
				$email=$_SESSION["email"];
				$sql="INSERT INTO links(email,link,description) VALUES('$email','$link','$description');";
				$result=$conn->query($sql);
				if(!$result){
					echo "<div class='phperror'>Data cannot be entered into the database .... An error occured ".$conn->error."</div>";
				}
				else{
					echo "<div class='phpsuccess'>Link has been saved .... Aish kar :P</div>";
				}
			}
			
		}
		$conn->close();
	}
 ?>

<?php 
	$msg.="<html>
 	<head>
 		 <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
 	</head>
 	<body>";
 ?>
 <html>
 	<head>
 		<title>Dashboard</title>
 		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 		<link rel="stylesheet" href="./style.css">
 		<script src="./script.js"></script>
 	</head>
 	<body>
 		<nav class="navbar navbar-inverse">
 			<div class="container-fluid">
 			    <div class="navbar-header">
 			      <a class="navbar-brand" href="#"><?php echo $_SESSION["user"]; ?></a>
 			    </div>
 			    <ul class="nav navbar-nav">
     				 <li class="active"><a href="#">DASHBOARD</a></li>
   				</ul>
 			    <ul class="nav navbar-nav navbar-right">
 			    	<li><a href="#"><?php echo $_SESSION["email"]; ?></a></li>
 			      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>
 			    </ul>
 			 </div>
 		</nav>
	
 		<div id="add-links" class="container">
 			<h3>Enter the links you want to save</h3>
 			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="link-form" method="post">
 				<div class="input-group">
 					<label for="">Link</label>
 					<input type="text" name="link" required class="form-control">
 				</div>
 				<div class="input-group">
 					<label for="">Description</label>
 					<input type="text" name="description" class="form-control">
 				</div>
 				<div class="input-group">
 					<input type="submit" value="Submit" name="link-submit" class="form-control btn btn-danger">
 				</div>
 				
 			</form>
 		</div>	
 		<div id="show-links" class="container">
 			<h2>Saved Links</h2>
 			<?php 
 				$msg.="<table class='table table-striped'>
				 <thead>
			      <tr>
			        <th>S.No</th>
			        <th>Link</th>
			        <th>Description</th>
			      </tr>
			    </thead>
			    <tbody>";
 			 ?>

 			<table class="table table-striped">
				 <thead>
			      <tr>
			        <th>S.No</th>
			        <th>Link</th>
			        <th>Description</th>
			        <th>Delete</th>
			      </tr>
			    </thead>
			    <tbody id="tablebody">
 			<!--show links-->
				<?php 
					
					$conn=new mysqli($host,$user,$cpass,$dbname);
					if ($conn->connect_error) {
						die ("<div class='phperror'>Sorry the connection to database for showing links failed  :  ".$conn->connect_error."</div>");
					}
					else{
						$sql="SELECT * FROM links WHERE email='".$_SESSION['email']."';";
						$result=$conn->query($sql);
						if (!$result) {
							echo "<div class='phperror'>There are no links in the database</div>";
						}
						else{
							$sno=1;
							while ($row=$result->fetch_assoc()) {
								echo "<tr id=".$row["lid"].">
										<td>".$sno."</td>
										<td><a href='{$row["link"]}' target='_blank'>".$row["link"]."</a></td>
										<td>".$row["description"]."</td>
										<td class='linkdelete'><span class='glyphicon glyphicon-remove'></span></td>
									</tr>";

								$msg.="<tr>
										<td>".$sno."</td>
										<td><a href='{$row["link"]}'>".$row["link"]."</a></td>
										<td>".$row["description"]."</td>
									</tr>";
								$sno+=1;
							}
						}
					}
				 ?>
				 </tbody>	
			 </table>
			<?php
				$msg.= "</tbody>	
			 			</table>
			 			</body>
 						</html>";
				if (isset($_POST["mailme"])) {
					/*$to=$_SESSION["email"];
					$subject = "Saved links on savelinks";
					$header = "From:xm0rtis09@gmail.com \r\n";
			        $header .= "Cc:deepeshpathak09@gmail.com \r\n";
			        $header .= "MIME-Version: 1.0\r\n";
			        $header .= "Content-type: text/html\r\n";

			        $retval = mail($to,$subject,$msg,$header);
			        if ($retval==true) {
			        	echo "<div class='phpsuccess'>Mail sent Successfully </div>";
			        }
			        else{
			        	echo "<div class='phperror'>Mail could not be sent</div>";
			        }*/
			        $mail->msgHTML($msg);
			        if(!$mail->send()) {
						    echo "<div class='phperror'>Mail could not be sent.".$mail->ErrorInfo."</div>";
						} else {
						    echo "<div class='phpsuccess'>Mail sent Successfully </div>";
						}
				}
			 ?>
			 <form id="mailbtn" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			 	<input type="submit" class="btn btn-success" name="mailme" value="Mail to Me">
			 </form>
 		</div>
 		<script>setTimeout(function(){$(".phperror").delay(500).fadeOut();
 										$(".phpsuccess").delay(500).fadeOut();},1500);</script>
 	</body>
 </html>