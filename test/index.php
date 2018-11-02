<?php
include '../blog/dbconnect.php';
$sql = $conn->query("SELECT COUNT(*) FROM numbers");
$res = mysqli_fetch_assoc($sql);
echo $res["COUNT(*)"];
$str = "test's";
echo mysqli_real_escape_string($conn,$str);
?>