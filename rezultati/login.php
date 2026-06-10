<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
<b>Login</b>
<a href="index.php">Back</a>
</div>

<div class="container">

<div class="form-box">

<h2>🔐 Login</h2>

<form method="POST">
<input name="u" placeholder="username">
<input name="p" type="password" placeholder="password">
<button name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
    $u=$_POST['u'];
    $p=$_POST['p'];

    $q=$conn->query("SELECT * FROM users WHERE username='$u'");
    $r=$q->fetch_assoc();

   if($r && password_verify($p,$r['password'])){
    $_SESSION['user'] = $r['username'];
    $_SESSION['user_id'] = $r['id'];
    header("Location:index.php");
}
}
?>

</div>

</div>

</body>
</html>