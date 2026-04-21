<?php
$conn = mysqli_connect("localhost:3307", "root", "", "portfolio_system");
if (!$conn) {
    die("Холболтын алдаа: " . mysqli_connect_error());
}
session_start();

function is_logged_in()
{
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }
}
?>