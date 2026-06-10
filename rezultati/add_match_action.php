<?php
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>

<div class="container">

<?php include "navbar.php"; ?>

<h2>➕ Dodaj utakmicu</h2>

<div class="form-box">

<form method="POST" action="add_match_action.php">

<select name="home_team">
<?php
$t=$conn->query("SELECT * FROM teams");
while($r=$t->fetch_assoc()):
?>
<option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
<?php endwhile; ?>
</select>

<select name="away_team">
<?php
$t=$conn->query("SELECT * FROM teams");
while($r=$t->fetch_assoc()):
?>
<option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
<?php endwhile; ?>
</select>

<input type="number" name="home_score" placeholder="Golovi domaćin">
<input type="number" name="away_score" placeholder="Golovi gost">
<input type="date" name="match_date">

<button>Sačuvaj</button>

</form>

</div>

</div>