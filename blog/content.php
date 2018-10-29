<?php 
include 'dbconnect.php';
include 'votefunc.php';
?>
<div class="container-fluid text-center">
<h1>Announcments:</h1>
</div>
<?php
$announcments = $conn->query("SELECT * FROM blog");
foreach ($announcments as $post) {
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $name = $post['author'];
    $idate = time() - $post['date'];
    include 'timefunc.php';
    $comments = $conn->query("SELECT * FROM comments WHERE post_id=$id");
    $commenttotal = 0;
    foreach ($comments as $commentcount) {
    $commenttotal= $commenttotal + 1;
    }
    $popularity = $post['upvote'] - $post['downvote'];
    $cookienum = 'vote' . $id;
    if (isset($_COOKIE[$cookienum])) {
    $decodedcookie = json_decode($_COOKIE[$cookienum]);
    if ($decodedcookie[0] == 'up' || $decodedcookie[0] == 'neither') {
        $upvotecolor = $decodedcookie[1];
    } else {
        $upvotecolor = '#aaa';
    }
    } else {
        $upvotecolor = '#aaa';
    }
    if (isset($_COOKIE[$cookienum])) {
        $decodedcookie = json_decode($_COOKIE[$cookienum]);
        if ($decodedcookie[0] == 'down' || $decodedcookie[0] == 'neither') {
            $downvotecolor = $decodedcookie[1];
        } else {
            $downvotecolor = '#aaa';
        }
        } else {
            $downvotecolor = '#aaa';
        }
    echo '
    <div class="post rounded">
        <h1>'.$title.'<span class="date">'.$date.'</span></h1>
        <h2>by '.$name.'</h2>
        <p>'.$content.'</p>
        <div class="post-options row">
            <div class="vote col-sm-4">
            <div class="square rounded" style="background: '.$upvotecolor.'; color:white; text-align:center;">
            <form method="POST" id="upvoteform'.$id.'">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="votetype'.$id.'" value="up">
            </form>
            <button class="voteup" type="submit" form="upvoteform'.$id.'" name="vote'.$id.'">↑</button>
            </div> '.$popularity.' <div class="square rounded" style="background: '.$downvotecolor.'; color:white; text-align:center;">
            <form method="POST" id="downvoteform'.$id.'">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="votetype'.$id.'" value="down">
            </form>
            <button class="votedown" type="submit" form="downvoteform'.$id.'" name="vote'.$id.'">↓</button>
            </div></div>
            <div class="comments col-sm-4">
            <a href="/blog/commentfunc.php" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
            </div>';
            echo '<div class="report col-sm-4">⚐ Report</div>
        </div>
    </div>
    <script>
        $(".square").width($(".square").height());
    </script>';
}
?>
