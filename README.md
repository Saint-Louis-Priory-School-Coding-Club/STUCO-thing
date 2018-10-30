There is a live version of the site currently at gzghost.me (last updated 10/30/18)

In order to properly set up the website with the PHP databases on your personal machine
you must import the database via the file labeled "database.sql". If you make changes to the database, 
outside of data(I.E. new table or changed structure), please update the .sql file via the export function and rename it. 
Also you must add your own dbconnect.php file under /blog. It should container:
<?php
$db_host = 'localhost';
$db_name = 'stuco';
$db_user = 'root';
$db_pass = 'password';
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
except with your password. if this file gets updated at anytime, it should also be updated here
