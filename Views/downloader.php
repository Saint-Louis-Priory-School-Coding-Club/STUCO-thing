<?php
if (!isset($_SESSION['fileName'])) {
    header('Location: ' . '/');
}
$fileName = $_SESSION['fileName'];
$fileExtention = explode('.', $fileName);
if (!isset($fileExtention[1])) {
    $viewer = new View;
    $viewer->e4041('No Extention Given');
    die();
}
$fileExtention = $fileExtention[1];
if (!file_exists('./Library/Storage/'.$fileName)) {
    $viewer = new View;
    $viewer->e4041('Error 400: File Not Found');
    die();
}
header("Content-disposition: attachment; filename=$fileName");
header("Content-type: application/$fileExtention");
readfile('./Library/Storage/'.$fileName);
?>