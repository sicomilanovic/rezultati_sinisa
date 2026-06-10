<?php
include "db.php";

$user=$_POST['username'];
$pass=$_POST['password'];

$stmt=$conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s",$user);
$stmt->execute();

$res=$stmt->get_result();
$data=$res->fetch_assoc();

if($data && password_verify($pass,$data['password'])){
    $_SESSION['user']=$data['username'];
    header("Location:index.php");
}else{
    echo "Pogresan login";
}
?>