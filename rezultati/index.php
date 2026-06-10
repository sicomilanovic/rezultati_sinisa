<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Sports Portal</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <b>⚽ SPORTS PORTAL</b>

    <div>
        <a href="index.php">Matches</a>
        <a href="table.php">Table</a>
        <a href="register.php">Register</a>

        <?php if(isset($_SESSION['user'])): ?>
            <a href="add_match.php">Add</a>
            <a href="predictions.php">Predictions</a>
            <a href="leadboard.php"> Leadboard </a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">

<h1>⚽ Matches</h1>

<?php
$res=$conn->query("
SELECT m.*, t1.name h, t1.logo hl,
t2.name a, t2.logo al
FROM matches m
JOIN teams t1 ON m.home_team=t1.id
JOIN teams t2 ON m.away_team=t2.id
ORDER BY m.id DESC
");

while($r=$res->fetch_assoc()):
?>

<div class="match-card">

    <div class="team">
        <img src="<?= $r['hl'] ?>">
        <?= $r['h'] ?>
    </div>

    <div class="score">
        <?= $r['home_score'] ?> : <?= $r['away_score'] ?>
    </div>

    <div class="team" style="justify-content:flex-end;">
        <?= $r['a'] ?>
        <img src="<?= $r['al'] ?>">
    </div>

</div>

<?php endwhile; ?>

</div>

</body>
</html>