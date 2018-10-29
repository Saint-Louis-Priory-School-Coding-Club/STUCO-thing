<?php
ob_start();
session_start();
require_once '../blog/dbconnect.php';
if (!isset($_SESSION['user'])) {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>cpanel redirect</title>
        <meta http-equiv="Refresh" content="0; url=/user/login">
    </head>
</html>';
} else {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
        <meta http-equiv="Refresh" content="0; url=/user/dashboard">
    </head>
</html>';
}
?>
