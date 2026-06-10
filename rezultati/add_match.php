<?php
include "db.php";



// ako nije ulogovan
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// dodavanje utakmice
if(isset($_POST['add'])){

    $home = $_POST['home'];
    $away = $_POST['away'];
    $hs   = $_POST['hs'];
    $as   = $_POST['as'];
    $user_id = $_SESSION['user_id'];

    // zabrana istog tima
    if($home == $away){
        die("❌ Ne može isti tim protiv samog sebe!");
    }

    // INSERT
    $stmt = $conn->prepare("
        INSERT INTO matches(home_team, away_team, home_score, away_score, match_date, user_id)
        VALUES(?,?,?,?,NOW(),?)
    ");

    $stmt->bind_param("iiiii", $home, $away, $hs, $as, $user_id);
    $stmt->execute();

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Match</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <b>➕ ADD MATCH</b>

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

<div class="form-box">

<h2>➕ Add new match</h2>

<form method="POST">

<!-- HOME TEAM -->
<select name="home" required>
    <option value="">Home team</option>
    <?php
    $t = $conn->query("SELECT * FROM teams");
    while($r = $t->fetch_assoc()):
    ?>
        <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
    <?php endwhile; ?>
</select>

<!-- AWAY TEAM -->
<select name="away" required>
    <option value="">Away team</option>
    <?php
    $t = $conn->query("SELECT * FROM teams");
    while($r = $t->fetch_assoc()):
    ?>
        <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
    <?php endwhile; ?>
</select>

<!-- SCORE -->
<input type="number" name="hs" placeholder="Home goals" required>
<input type="number" name="as" placeholder="Away goals" required>

<button type="submit" name="add">Save Match</button>

</form>

</div>

</div>

</body>
</html>