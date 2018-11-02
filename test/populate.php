<?php
include '../blog/dbconnect.php';

for ($x = 0; $x < 106; $x++) {
   $number = rand(100,999);
   $sql = "INSERT INTO numbers (number) VALUES ($number)";
   $query = $conn->query($sql);
}
?>