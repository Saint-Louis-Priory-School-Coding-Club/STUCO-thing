<?php 
include 'dbconnect.php';
include 'postbuttons.php';
?>
<div class="container-fluid text-center">
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#announcmentm">
Add
</button><h1>Announcments:</h1>
</div>
<div class="modal fade" id="announcmentm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Announcment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'create.php' ?>
      </div>
    </div>
  </div>
</div>
<?php
$announcments = $conn->query("SELECT * FROM blog");
foreach ($announcments as $post) {
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $name = $post['author'];
    $isdate = time() - $post['date'];
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
    if(isset($_COOKIE['report'.$id])) {
        $decodedreport = json_decode($_COOKIE['report'.$id]);
        $reportcolor= $decodedreport[1];
    } else {
        $reportcolor = 'black';
    }
    echo '
    <div class="post rounded" id="'.$id.'">
        <form method="POST" id="reportform'.$id.'"></form>
        <h1><a href="/blog/posts/'.$id.'" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">'.$title.'</a><span class="date">'.$date.'</span></h1>
        <h2>by '.$name.'</h2>
        <p>'.$content.'</p>
        <div class="post-options row">
            <div class="vote col-sm-4">
            <div class="square rounded" style="background: '.$upvotecolor.'; color:white; text-align:center;">
            <form method="POST" id="upvoteform'.$id.'">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="votetype'.$id.'" value="up">
            </form>
            <button class="voteup" type="submit" form="upvoteform'.$id.'" name="vote'.$id.'">↑&nbsp;</button>
            </div> '.$popularity.' <div class="square rounded" style="background: '.$downvotecolor.'; color:white; text-align:center;">
            <form method="POST" id="downvoteform'.$id.'">
            <input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="votetype'.$id.'" value="down">
            </form>
            <button class="votedown" type="submit" form="downvoteform'.$id.'" name="vote'.$id.'">↓&nbsp;</button>
            </div></div>
            <div class="comments col-sm-4">
            <a href="/blog/commentfunc.php" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
            </div>';
            echo '<div class="report col-sm-4"><button type="submit" form="reportform'.$id.'" name="report'.$id.'" style="background: transparent; border:none; color:'.$reportcolor.'">⚐ Report</button></div>
        </div>
    </div>';
}
?>
