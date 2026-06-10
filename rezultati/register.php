<?php
include "db.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <b>🧾 REGISTER</b>
    <a href="index.php">Home</a>
</div>

<div class="container">

<div class="form-box">

<h2>🧾 Create account</h2>

<form method="POST">

<input type="text" name="u" placeholder="Username / Email" required>
<input type="password" name="p" placeholder="Password" required>

<button type="submit" name="reg">Register</button>

</form>

<?php
if(isset($_POST['reg'])){

    $u = $_POST['u'];
    $p = password_hash($_POST['p'], PASSWORD_DEFAULT);

    
    $check = $conn->query("SELECT * FROM users WHERE username='$u'");

    if($check->num_rows > 0){

        echo "<div style='margin-top:15px;color:#ff4d4d;font-weight:bold;text-align:center;'>
                ❌ Korisnik sa ovim emailom već postoji!
              </div>";

    } else {

        // INSERT
        $conn->query("INSERT INTO users(username,password) VALUES('$u','$p')");

        echo "<div style='margin-top:15px;color:#22c55e;font-weight:bold;text-align:center;'>
                ✅ Uspešna registracija! Preusmeravanje...
              </div>";

        // redirect na login
        echo "<script>
                setTimeout(function(){
                    window.location.href='login.php';
                },1500);
              </script>";
    }
}
?>

</div>

</div>

</body>
</html>