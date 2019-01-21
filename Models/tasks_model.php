<?php
class Tasks_Model extends Model{

    function __construct() {
        parent::__construct();
        

    }

    public function uniToTime($isdate) {
        if ($isdate > 60) {
            $imins = $isdate / 60;
            if ($imins > 60) {
                $ihours = $imins / 60;
                if ($ihours > 24) {
                    $idays = $ihours / 24;
                    if ($idays > 365 && $idays < 730) {
                        $iyears = $idays / 365;
                        $date = round($iyears) . ' year ago';
                    } elseif ($idays > 730) {
                            $iyears = $idays / 365;
                            $date = round($iyears) . ' years ago';
                        } elseif ($idays < 2) {
                            $date = round($idays) . ' day ago';
                        } else {
                            $date = round($idays) . ' days ago';
                        }
                    } else {
                        $date = round($ihours) . ' hours ago';
    
                    }
                }  elseif ($imins < 2) {
                    $date = round($imins) . ' minute ago';
                    } else {
                        $date = round($imins) . ' minutes ago'; 
                    }
            }  elseif ($isdate < 2) {
                $date = $isdate . ' second ago';
            } else {
                $date = $isdate . ' seconds ago';
            }
            return $date;   
        }


    public function paginate($conn, string $dtable, $rowsperpage, $id = NULL) {
        $udatafunc = new Userdata;
        $self = new Tasks_Model;
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
            $date = $date = $self->uniToTime($isdate);
            $comments = $conn->query("SELECT * FROM bcomments WHERE post_id=$id");
            $commenttotal = 0;
            foreach ($comments as $commentcount) {
            $commenttotal= $commenttotal + 1;
            }
            $popularity = $post['upvote'] - $post['downvote'];
            if (isset($_SESSION['user'])) {
                $cidddd = $_SESSION['user'];
                $userRow = $conn->query("SELECT * FROM users WHERE id = '".$cidddd."'") or die ($conn->error);
                $userRow = mysqli_fetch_assoc($userRow);
                $userData = $udatafunc->use_userdata($userRow['userdata'], $userRow['password']);
            } else {
                //die('An Error has occured');
            }
            if (isset($userData)) {
                //var_dump($userData);
                if (isset($userData[$id.'vote'])) {
                    //echo 'one step closer';
                   if ($userData[$id. 'vote'] == 'up') {
                       //echo 'another step';
                            $upvotecolor = 'green';
                            $downvotecolor = '#aaa';
                   } else {
                       //echo 'herm';
                            $upvotecolor = '#aaa';
                            $downvotecolor = 'red';
                   }
                   if (isset($userData[$id.'report'])) {
                    $reportcolor = 'red';
                } else {
                    $reportcolor = 'black';
                }
                    
                } 
                else {
                    //echo 'wtf';
                    $upvotecolor = '#aaa';
                    $downvotecolor = '#aaa';
                }
                if (isset($userData[$id.'report'])) {
                    $reportcolor = 'red';
                } else {
                    $reportcolor = 'black';
                }
            } else {
                $upvotecolor = '#aaa';
                $downvotecolor = '#aaa';
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
                    <form method="POST" id="upvoteform'.$id.'"><input name="'.$id.'vote" type="hidden" value="up"></form>
                    <button class="voteup" type="submit" form="upvoteform'.$id.'" value="up" name="'.$id.'votes">↑&nbsp;</button>
                    </div> '.$popularity.' <div class="square rounded" style="background: '.$downvotecolor.'; color:white; text-align:center;">
                    <form method="POST" id="downvoteform'.$id.'"><input name="'.$id.'vote" type="hidden" value="down"></form>
                    <button class="votedown" type="submit" form="downvoteform'.$id.'" value="down" name="'.$id.'votes">↓&nbsp;</button>
                    </div></div>
                    <div class="comments col-sm-4">
                    <a href="/blog/posts/'.$id.'#comment" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
                    </div>';
                    echo '<div class="report col-sm-4"><button type="submit" form="reportform'.$id.'" name="'.$id.'report" style="background: transparent; border:none; color:'.$reportcolor.'">⚐ Report</button></div>
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
   echo " <a class='btn btn-primary' href='" . __URL . "{$_GET['url']}?currentpage=1'><<</a> ";
   $prevpage = $currentpage - 1;
   echo " <a class='btn btn-primary' href='" . __URL . "{$_GET['url']}?currentpage=$prevpage'><</a> ";
}

for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $currentpage) {
         echo " <a class='btn btn-success' href=#>$currentpage</a> ";
      } else {
         echo " <a class='btn btn-primary' href='" . __URL . "{$_GET['url']}?currentpage=$x'>$x</a> ";
      }
   }
}

if ($currentpage != $totalpages) {
   $nextpage = $currentpage + 1;
   echo " <a class='btn btn-primary' href='" . __URL . "{$_GET['url']}?currentpage=$nextpage'>></a> ";
   echo " <a class='btn btn-primary' href='" . __URL . "{$_GET['url']}?currentpage=$totalpages'>>></a> ";
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
            $date = $self->uniToTime($isdate);
            $comments = $conn->query("SELECT * FROM bcomments WHERE post_id=$id");
            $commenttotal = 0;
            foreach ($comments as $commentcount) {
            $commenttotal= $commenttotal + 1;
            }
            $popularity = $post['upvote'] - $post['downvote'];
            if (isset($userRow)) {
                $userData = $udatafunc->use_userdata($userRow['userdata'], $userRow['password']);
            } else {
                //die('An Error has occured');
            }
            if (isset($userData)) {
                if (isset($userData[$id.'vote'])) {
                   if ($userData[$id. 'vote'] == 'up') {
                            $upvotecolor = 'green';
                            $downvotecolor = '#aaa';
                   } else {
                            $upvotecolor = '#aaa';
                            $downvotecolor = 'red';
                   }
                   if (isset($userData[$id.'report'])) {
                    $reportcolor = 'red';
                } else {
                    $reportcolor = 'black';
                }
                    
                } elseif (isset($userData[$id.'report'])) {
                    $reportcolor = 'red';
                }
                else {
                    $upvotecolor = '#aaa';
                    $downvotecolor = '#aaa';
                    $reportcolor = 'black';
                }
            } else {
                $upvotecolor = '#aaa';
                $downvotecolor = '#aaa';
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
                    <form method="POST" id="upvoteform'.$id.'"><input name="'.$id.'vote" type="hidden" value="up"></form>
                    <button class="voteup" type="submit" form="upvoteform'.$id.'" value="up" name="'.$id.'votes">↑&nbsp;</button>
                    </div> '.$popularity.' <div class="square rounded" style="background: '.$downvotecolor.'; color:white; text-align:center;">
                    <form method="POST" id="downvoteform'.$id.'"><input name="'.$id.'vote" type="hidden" value="down"></form>
                    <button class="votedown" type="submit" form="downvoteform'.$id.'" value="down" name="'.$id.'votes">↓&nbsp;</button>
                    </div></div>
                    <div class="comments col-sm-4">
                    <a href="/blog/posts/'.$id.'#comment" style="text-decoration:none; color:black; hover:none; cursor:context-menu;">🗩 '.$commenttotal.' comments</a>
                    </div>';
                    echo '<div class="report col-sm-4"><button type="submit" form="reportform'.$id.'" name="'.$id.'report" style="background: transparent; border:none; color:'.$reportcolor.'">⚐ Report</button></div>
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