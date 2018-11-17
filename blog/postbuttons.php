<?php 
$posts = $conn->query("SELECT * FROM blog");
//$posts = mysqli_fetch_array($postsraw, MYSQLI_ASSOC);
foreach ($posts as $ind) {
    $id = $ind['id'];
    $postraw = $conn->query("SELECT * FROM blog WHERE id=$id");
    $post = mysqli_fetch_array($postraw, MYSQLI_ASSOC);
    if (isset($_POST['vote'.$id])) {
        $postcookie = 'vote' . $id;
        if (isset($_COOKIE[$postcookie])) {
            $data = json_decode($_COOKIE[$postcookie]);
        } else {
            $data = ['neither', '#aaa'];
        }
        if ($_POST['votetype'.$id] == 'up') {
            if (!isset($_COOKIE[$postcookie]) || $data[0] == 'neither' || $data[0] == 'down') {
            if ($data[0] == 'down') {
                $change = $post['upvote'] + 1;
                $sql = "UPDATE blog SET upvote=$change WHERE id=$id";
                $query = $conn->query($sql);
                $changedown = $post['downvote'] - 1;
                $othersql = "UPDATE blog SET downvote=$changedown WHERE id=$id";
                $newquery = $conn->query($othersql);
            } else {
                $change = $post['upvote'] + 1;
                $sql = "UPDATE blog SET upvote=$change WHERE id=$id";
                $query = $conn->query($sql);
            }
            $cookievalue = ['up', 'green'];
            setcookie($postcookie, json_encode($cookievalue));
            } else {
                $change = $post['upvote'] - 1;
                $sql = "UPDATE blog SET upvote=$change WHERE id=$id";
                $query = $conn->query($sql);
                $cookievalue = ['neither', '#aaa'];
                setcookie($postcookie, json_encode($cookievalue));
            }
        }
        if ($_POST['votetype'.$id] == 'down') {
            if (!isset($_COOKIE[$postcookie]) || $data[0] == 'neither' || $data[0] == 'up') {
                if ($data[0] == 'up') {
                    $change = $post['downvote'] + 1;
                    $sql = "UPDATE blog SET downvote=$change WHERE id=$id";
                    $query = $conn->query($sql);
                    $changedown = $post['upvote'] - 1;
                    $othersql = "UPDATE blog SET upvote=$changedown WHERE id=$id";
                    $newquery = $conn->query($othersql);
                } else {
                    $change = $post['downvote'] + 1;
                    $sql = "UPDATE blog SET downvote=$change WHERE id=$id";
                    $query = $conn->query($sql);
                }
                $cookievalue = ['down', 'red'];
                setcookie($postcookie, json_encode($cookievalue));
                } else {
                    $change = $post['downvote'] - 1;
                    $sql = "UPDATE blog SET downvote=$change WHERE id=$id";
                    $query = $conn->query($sql);
                    $cookievalue = ['neither', '#aaa'];
                    setcookie($postcookie, json_encode($cookievalue));
                }
        }
        echo '<meta http-equiv="Refresh" content="0; url=#'.$id.'">';
    }
    if(isset($_POST['report'.$id])) {

        if(isset($_COOKIE['report'.$id])) {
            $cdata = json_decode($_COOKIE['report'.$id]);
        } else {
            $cdata = ['notset', 'black'];
        }
        if ($cdata[0] == 'notset') {
            $reportval = ['reported', 'red'];
            setcookie('report'.$id, json_encode($reportval));
            $change = $post['reports'] + 1;
            $sql = $conn->query("UPDATE blog SET reports=$change WHERE id=$id");
        } else {
            $reportval = ['notset', 'black'];
            setcookie('report'.$id, json_encode($reportval));
            $change = $post['reports'] - 1;
            $sql = $conn->query("UPDATE blog SET reports=$change WHERE id=$id");
        }
        echo '<meta http-equiv="Refresh" content="0; url=#'.$id.'">';
    }
}
?>