<?php
include "db.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>League Table</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <b>🏆 TABLE</b>

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

<h1>🏆 League Table</h1>

<?php
$sql = "
SELECT 
t.id,
t.name,
t.logo,

COALESCE(SUM(
CASE WHEN m.home_team=t.id THEN m.home_score
WHEN m.away_team=t.id THEN m.away_score END
),0) AS goals_for,

COALESCE(SUM(
CASE WHEN m.home_team=t.id THEN m.away_score
WHEN m.away_team=t.id THEN m.home_score END
),0) AS goals_against,

COALESCE(SUM(
CASE 
WHEN (m.home_team=t.id AND m.home_score>m.away_score)
OR (m.away_team=t.id AND m.away_score>m.home_score)
THEN 3 ELSE 0 END
),0) AS points

FROM teams t
LEFT JOIN matches m 
ON t.id = m.home_team OR t.id = m.away_team

GROUP BY t.id, t.name, t.logo
";

$res = $conn->query($sql);

// ubacujemo u niz da možemo sortirati PHP-om (fix za MySQL bug)
$data = [];

while($r = $res->fetch_assoc()){
    $r['goal_diff'] = $r['goals_for'] - $r['goals_against'];
    $data[] = $r;
}

// SORTIRANJE (PROPER FIX)
usort($data, function($a, $b){
    if($a['points'] == $b['points']){
        return $b['goal_diff'] <=> $a['goal_diff'];
    }
    return $b['points'] <=> $a['points'];
});

$rank = 1;

foreach($data as $r):
?>

<div class="table-card">

    <!-- TEAM -->
    <div style="display:flex;align-items:center;gap:12px;">

        <div class="badge"><?= $rank++ ?></div>

        <?php if(!empty($r['logo'])): ?>
            <img src="<?= $r['logo'] ?>" width="30" height="30" style="border-radius:50%;">
        <?php endif; ?>

        <b><?= $r['name'] ?></b>
    </div>

    <!-- STATS -->
    <div style="display:flex;gap:15px;align-items:center;">

        <span>⚽ <?= $r['goals_for'] ?></span>
        <span>❌ <?= $r['goals_against'] ?></span>

        <span class="badge"><?= $r['points'] ?> pts</span>

    </div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>