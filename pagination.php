<?php
class Paginater {
    function paginate(string $dtable, $rowsperpage, $id = NULL) {
include $_SERVER['DOCUMENT_ROOT'].'/dbconnect.php';
switch ($dtable) {
    case "bcomments":
        $idtype = 'WHERE post_id ='.$id;
    break;
    case "tcomments":
        $idtype = 'WHERE post_id ='.$id;
    break;
    case "blog":
        $idtype = NULL;
    break;
    case "ctask":
        $idtype = NULL;
    break;
    default:
        $idtype = NULL;
    break;
}
$sql = "SELECT COUNT(*) FROM $dtable $idtype";
$result = $conn->query($sql);
if (!$result) {
    echo '<h3 style="color:red; text-align:center;"><strong>There is nothing to see here folks!</strong></h3>';
} else {
    $res = mysqli_fetch_assoc($result);
$numrows = $res["COUNT(*)"];
if (!$numrows < 1) {
$totalpages = ceil($numrows / $rowsperpage);
if ($totalpages > 1){

if (isset($_GET['currentpage'])) {
   $currentpage = (int) $_GET['currentpage'];
} else {
   $currentpage = 1;
}

if ($currentpage > $totalpages) {
   $currentpage = $totalpages;
}

if ($currentpage < 1) {
   $currentpage = 1;
}

$offset = ($currentpage - 1) * $rowsperpage;
$sql = "SELECT * FROM $dtable $idtype ORDER BY id LIMIT $rowsperpage OFFSET $offset";
$result = $conn->query($sql);

while ($post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    switch ($dtable) {
        case "bcomments":
            $cid = htmlspecialchars($post['id']);
            $header = htmlspecialchars($post['title']);
            $user = htmlspecialchars($post['author']);
            $description = htmlspecialchars($post['content']);
            echo '
            <h3>'.$header.'</h3>
            <p>'.$description.'</p>
            <small>Written by '.$user.'</small>
            <hr id="'.$cid.'">';
        break;
        case "tcomments":
            $cid = htmlspecialchars($post['id']);
            $header = htmlspecialchars($post['title']);
            $user = htmlspecialchars($post['author']);
            $description = htmlspecialchars($post['content']);
            echo '
            <h3>'.$header.'</h3>
            <p>'.$description.'</p>
            <small>Written by '.$user.'</small>
            <hr id="'.$cid.'">';
        break;
        case "ctask":
        $id = htmlspecialchars($post['id']);
        $comments = $conn->query("SELECT id FROM tcomments WHERE post_id=$id");
        $commenttotal = 0;
        foreach ($comments as $c) {
        $commenttotal += 1;
        }
        $title = htmlspecialchars($post['title']);
        $author = htmlspecialchars($post['author']);
        $content = htmlspecialchars($post['solution']);
        $sugid = $post['suggestion_id'];
        $date = date("M d Y", $post['date']);
        $smtp = $conn->query("SELECT * FROM suggestion WHERE id=$sugid");
        $res = mysqli_fetch_array($smtp, MYSQLI_ASSOC);
        $sugtitle = htmlspecialchars($res['title']);
        $sugauthor = htmlspecialchars($res['author']);
        $sugcontent = htmlspecialchars($res['content']);
        $sugdate = date("M d Y", $res['date']);
        echo '
        <div class="post rounded" id="'.$id.'">
        <div class="row">
        <div class="col-sm-8"><h1>'.$title.'&nbsp;</h1></div><div class="col-sm-4 date"><h5>'.$date.'</h5></div></div>
        <h2>by&nbsp;<span class="author">'.$author.'</span></h2>
    
            <div class="inpost rounded">
                <div class="row">
                <div class="col-sm-8"><h2>'.$sugtitle.'&nbsp;</h2></div><div class="col-sm-4 date"><h6>'.$sugdate.'</h6></div></div>
    
                <h3>by&nbsp;<span class="author">'.$sugauthor.'</span></h3>
    
                <div class="inpost-body-container"><p class="inpost-body">'.$sugcontent.'<p></div>
            </div>
        
        <div class="post-body-container"><p class="post-body">'.$content.'<p>
        <!--<button type="button" class="btn btn-dark read-more">Show More</button>-->
        <p class="show-more-txt"></p>
        </div>
        <div class="post-options row noselect">
            <div class="comments col-sm-4"><i class="far fa-comments"></i><span class="comment-number">'.$commenttotal.'</span>&nbsp;comments</div>
        </div>
        </div>
        <br>
            ';
        break;
        case "blog":
            $id = htmlspecialchars($post['id']);
            $title = htmlspecialchars($post['title']);
            $content = htmlspecialchars($post['content']);
            $name = htmlspecialchars($post['author']);
            $isdate = time() - $post['date'];
            include 'timefunc.php';
            $comments = $conn->query("SELECT * FROM bcomments WHERE post_id=$id");
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
                    <a href="/blog/posts/'.$id.'#comment" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
                    </div>';
                    echo '<div class="report col-sm-4"><button type="submit" form="reportform'.$id.'" name="report'.$id.'" style="background: transparent; border:none; color:'.$reportcolor.'">⚐ Report</button></div>
                </div>
            </div>';
        break;
        default:
        die();
        break;
    }
}

$range = 2;
echo '<div>';
if ($currentpage > 1) {
   echo " <a class='btn btn-primary' href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   $prevpage = $currentpage - 1;
   echo " <a class='btn btn-primary' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
}

for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $currentpage) {
         echo " <a class='btn btn-success' href=#>$currentpage</a> ";
      } else {
         echo " <a class='btn btn-primary' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      }
   }
}

if ($currentpage != $totalpages) {
   $nextpage = $currentpage + 1;
   echo " <a class='btn btn-primary' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   echo " <a class='btn btn-primary' href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
}
echo '</div>';
} else {
$sql = "SELECT * FROM $dtable $idtype ORDER BY id";
$result = $conn->query($sql);

while ($post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    switch ($dtable) {
        case "bcomments":
            $cid = htmlspecialchars($post['id']);
            $header = htmlspecialchars($post['title']);
            $user = htmlspecialchars($post['author']);
            $description = htmlspecialchars($post['content']);
            echo '
            <h3>'.$header.'</h3>
            <p>'.$description.'</p>
            <small>Written by '.$user.'</small>
            <hr id="'.$cid.'">';
        break;
        case "tcomments":
            $cid = htmlspecialchars($post['id']);
            $header = htmlspecialchars($post['title']);
            $user = htmlspecialchars($post['author']);
            $description = htmlspecialchars($post['content']);
            echo '
            <h3>'.$header.'</h3>
            <p>'.$description.'</p>
            <small>Written by '.$user.'</small>
            <hr id="'.$cid.'">';
        break;
        case "ctask":
        $id = htmlspecialchars($post['id']);
        $comments = $conn->query("SELECT id FROM tcomments WHERE post_id=$id");
        $commenttotal = 0;
        foreach ($comments as $c) {
        $commenttotal += 1;
        }
        $title = htmlspecialchars($post['title']);
        $author = htmlspecialchars($post['author']);
        $content = htmlspecialchars($post['solution']);
        $sugid = $post['suggestion_id'];
        $date = date("M d Y", $post['date']);
        $smtp = $conn->query("SELECT * FROM suggestion WHERE id=$sugid");
        $res = mysqli_fetch_array($smtp, MYSQLI_ASSOC);
        $sugtitle = htmlspecialchars($res['title']);
        $sugauthor = htmlspecialchars($res['author']);
        $sugcontent = htmlspecialchars($res['content']);
        $sugdate = date("M d Y", $res['date']);
        echo '
        <div class="post rounded" id="'.$id.'">
        <div class="row">
        <div class="col-sm-8"><h1>'.$title.'&nbsp;</h1></div><div class="col-sm-4 date"><h5>'.$date.'</h5></div></div>
        <h2>by&nbsp;<span class="author">'.$author.'</span></h2>
    
            <div class="inpost rounded">
                <div class="row">
                <div class="col-sm-8"><h2>'.$sugtitle.'&nbsp;</h2></div><div class="col-sm-4 date"><h6>'.$sugdate.'</h6></div></div>
    
                <h3>by&nbsp;<span class="author">'.$sugauthor.'</span></h3>
    
                <div class="inpost-body-container"><p class="inpost-body">'.$sugcontent.'<p></div>
            </div>
        
        <div class="post-body-container"><p class="post-body">'.$content.'<p>
        <!--<button type="button" class="btn btn-dark read-more">Show More</button>-->
        <p class="show-more-txt"></p>
        </div>
        <div class="post-options row noselect">
            <div class="comments col-sm-4"><i class="far fa-comments"></i><span class="comment-number">'.$commenttotal.'</span>&nbsp;comments</div>
        </div>
        </div>
        <br>
            ';
        break;
        case "blog":
            $id = htmlspecialchars($post['id']);
            $title = htmlspecialchars($post['title']);
            $content = htmlspecialchars($post['content']);
            $name = htmlspecialchars($post['author']);
            $isdate = time() - $post['date'];
            include 'timefunc.php';
            $comments = $conn->query("SELECT * FROM bcomments WHERE post_id=$id");
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
                    <a href="/blog/posts/'.$id.'#comment" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
                    </div>';
                    echo '<div class="report col-sm-4"><button type="submit" form="reportform'.$id.'" name="report'.$id.'" style="background: transparent; border:none; color:'.$reportcolor.'">⚐ Report</button></div>
                </div>
            </div>';
        break;
        default:
        die();
        break;
    }
}
}
} elseif ($dtable == 'bcomments') {
    echo '<h3 style="color:red; text-align:center;"><strong>There is nothing to see here folks!</strong></h3>';
} else {
    echo '<h3 style="color:red; text-align:center;"><strong>There is nothing to see here folks!</strong></h3>';
}
}
    }
}
?>
