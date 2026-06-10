<?php
include "db.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>Leaderboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <b>🏆 LEADERBOARD</b>
    <div>
      <a href="index.php">Matches</a>
        <a href="table.php">Table</a>
       
          <?php if(isset($_SESSION['user'])): ?>
            <a href="add_match.php">Add</a>
            <a href="predictions.php">Predictions</a>
            <a href="leadboard.php">Lista</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    
    </div>
</div>

<div class="container">

<h1>🏆 Top Players</h1>

<?php
$sql = "
SELECT 
u.username,
COALESCE(SUM(p.correct),0) AS points,
COUNT(p.id) AS total
FROM users u
LEFT JOIN predictions p ON u.id = p.user_id
GROUP BY u.id
ORDER BY points DESC, total DESC
";

$res = $conn->query($sql);

$rank = 1;

while($r = $res->fetch_assoc()):
?>

<div class="table-card">

    <div>
        <div class="badge">#<?= $rank++ ?></div>
        <b><?= $r['username'] ?></b>
    </div>

    <div>
        🎯 <?= $r['points'] ?> pts |
        📊 <?= $r['total'] ?> picks
    </div>

</div>

<?php endwhile; ?>

</div>

</body>
</html>