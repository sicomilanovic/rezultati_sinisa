<?php
include "db.php";

$user=$_POST['username'];
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);

$stmt=$conn->prepare("INSERT INTO users(username,password) VALUES(?,?)");
$stmt->bind_param("ss",$user,$pass);

$stmt->execute();

header("Location: login.php");
?>