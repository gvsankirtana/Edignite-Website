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
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>