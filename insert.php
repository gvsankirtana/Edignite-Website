<?php
$Name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$occ = $_POST['occ'];
$work = $_POST['work'];
$intro = $_POST['intro'];
$hob = $_POST['hi'];
if(!empty($Name)||!empty($email)||!empty($phone)||!empty($occ)||!empty($work)||!empty($intro)||!empty($hob)){
    $host = "localhost";
    $dbUsername="root";
    $dbPassword = "";
    $dbname = "edignite volunteers";
    $conn =  new mysqli('localhost','root','','test');
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error){
        die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT="SELECT email From register  Where email = ? LIMIT 1";
        $INSERT ="INSERT Into register (email,phone,occ,work,intro,hob,Name)values(?,?,?,?,?,?,?)";
        $stmt = $conn -> prepare($SELECT);
        $stmt -> bind_param("s",$email);
        $stmt -> execute();
        $stmt -> bind_result($email);
        $stmt -> store_result(); 
        rnum = $stmt -> num_rows;
        if(rnum == 0){
            $stmt->close();
            $stmt=$conn -> prepare($INSERT);
            $stmt->bind_param("ssssii",$Name,$phone,$email,$occ,$work,$intro,$hob);
            $stmt-> execute();
        }
        else{
            echo "Someone already registered";
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo "all field are required";
    die();
}
?>