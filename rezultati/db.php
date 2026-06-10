<?php
session_start();

$conn = new mysqli("localhost", "root", "", "sport");

if ($conn->connect_error) {
    die("Greška konekcije");
}
?>