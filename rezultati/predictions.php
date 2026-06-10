<?php
include "db.php";


if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// 5 RANDOM MEČEVA (bez ponavljanja u jednoj rundi)
$matches = $conn->query("
SELECT m.id,
t1.name AS home,
t2.name AS away
FROM matches m
JOIN teams t1 ON m.home_team = t1.id
JOIN teams t2 ON m.away_team = t2.id
WHERE m.home_team != m.away_team
ORDER BY RAND()
LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Predictor</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <b>🔮 PREDICTOR</b>
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

<h1>🔮 Predict Matches</h1>

<form method="POST">

<?php
$used_pairs = [];
while($m = $matches->fetch_assoc()):

    // 🔥 blokira duple parove u istoj rundi
    $pair = $m['home']."-".$m['away'];
    if(in_array($pair, $used_pairs)) continue;
    $used_pairs[] = $pair;
?>

<div class="match-card" style="flex-direction:column;">

    <b><?= $m['home'] ?> vs <?= $m['away'] ?></b>

    <input type="hidden" name="match_id[]" value="<?= $m['id'] ?>">

    <select name="pick[]" required>
        <option value="1">Home win</option>
        <option value="X">Draw</option>
        <option value="2">Away win</option>
    </select>

</div>

<?php endwhile; ?>

<button type="submit" name="submit" style="margin-top:20px;">
    Submit Predictions
</button>

</form>

<?php
if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    $ids = $_POST['match_id'];
    $picks = $_POST['pick'];

    for($i=0; $i<count($ids); $i++){

        $id = $ids[$i];
        $pick = $picks[$i];

        $m = $conn->query("
            SELECT home_score, away_score
            FROM matches
            WHERE id=$id
        ")->fetch_assoc();

        if($m['home_score'] > $m['away_score']){
            $result = "1";
        } elseif($m['home_score'] < $m['away_score']){
            $result = "2";
        } else {
            $result = "X";
        }

        $correct = ($pick == $result) ? 1 : 0;

        // 🔥 SAVE PREDICTION
        $conn->query("
            INSERT INTO predictions(user_id, match_id, pick, correct)
            VALUES($user_id,$id,'$pick',$correct)
            ON DUPLICATE KEY UPDATE correct=$correct
        ");
    }

   $score = 0;

for($i=0; $i<count($ids); $i++){

    $id = $ids[$i];
    $pick = $picks[$i];

    $m = $conn->query("
        SELECT home_score, away_score
        FROM matches
        WHERE id=$id
    ")->fetch_assoc();

    if($m['home_score'] > $m['away_score']){
        $result = "1";
    } elseif($m['home_score'] < $m['away_score']){
        $result = "2";
    } else {
        $result = "X";
    }

    $correct = ($pick == $result) ? 1 : 0;

    if($correct == 1){
        $score++;
    }

    // SAVE PREDICTION
    $conn->query("
        INSERT INTO predictions(user_id, match_id, pick, correct)
        VALUES($user_id,$id,'$pick',$correct)
        ON DUPLICATE KEY UPDATE correct=$correct
    ");
}

// 🔥 POPUP + REDIRECT
echo "<script>
alert('🏆 You got $score correct predictions!');
window.location='leadboard.php';
</script>";
exit;
}
?>

</div>

</body>
</html>