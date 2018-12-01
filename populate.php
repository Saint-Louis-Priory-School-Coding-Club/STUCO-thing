<?php
require 'dbconnect.php';
$tcomments = $conn->query("SELECT COUNT(*) FROM tcomments");
$bcomments = $conn->query("SELECT COUNT(*) FROM bcomments");
$ctasks = $conn->query("SELECT COUNT(*) FROM ctask");
$blog = $conn->query("SELECT COUNT(*) FROM blog");
$suggestion = $conn->query("SELECT COUNT(*) FROM suggestion");
if ($ctasks == FALSE) {
    $sql = $conn->query("INSERT INTO ctask (title, author, solution, date, suggestion_id) VALUES ('Bonfire', 'Stuco Member', 'Thank you for your suggestion Tariq, we think that a bonfire would be a great idea although we do not like the idea of actually having to do something so it proabaly will not happen', '1543637640', '1')");
}
if ($blog == FALSE) {
    $sql = $conn->query("INSERT INTO blog (title, author, date, content, upvote, downvote, reports) VALUES ('Example Entry', 'You', '1578934', 'A cool example entry to demonstrate the look of this page', 15, 3, 0)");
}
if ($suggestion == FALSE) {
    $sql = $conn->query("INSERT INTO suggestion (title, author, content, date) VALUES ('Bonfire', 'Tariq', 'It would be cool if we could have a bonfire some time in the next ever', '1578973')");
}

?>
