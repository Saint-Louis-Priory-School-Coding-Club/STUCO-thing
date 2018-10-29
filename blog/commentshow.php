<?php
$comments = $conn->query("SELECT * FROM comments WHERE post_id=$id");
foreach ($comments as $comment) {
    $header = $comment['title'];
    $user = $comment['author'];
    $description = $comment['content'];
    echo '<div class="card"><h1>'.$header.'</h1></div><br>';
}
?>