<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$occ = $_POST['occ'];
	$work = $_POST['work'];
	$intro = $_POST['intro'];
	$hob = $_POST['hob'];

	// Database connection
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(name, email, number, occ, work, intro,hob) values(?, ?, ?, ?, ?, ?,?)");
		$stmt->bind_param("ssssssi",$name,$email,$number,$occ,$work,$intro,$hob);
		$execval = $stmt->execute();
		echo $execval;
		echo '<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Home</title>
			<link rel="stylesheet" href="home.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
			<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		</head>
		<body style="background-color:light-green;">
		<div class="alert alert-success alert-lg">
		<center><strong>Thank you For submitting the form</strong>
	  </div></center>
	  </body>
	  </html>';
		$stmt->close();
		$conn->close();
	}
?>