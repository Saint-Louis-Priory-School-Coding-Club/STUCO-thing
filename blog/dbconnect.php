<?php
$db_host = 'localhost';
$db_name = 'stuco';
$db_user = 'root';
$db_pass = '#XFCE4life!';
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_SESSION['user'])) {
    $res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);

    if ($res != false) {
        $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
}
?>