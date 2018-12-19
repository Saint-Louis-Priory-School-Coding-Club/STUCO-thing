<?php 
$posts = $conn->query("SELECT * FROM blog");
if (isset($userData)) {
    foreach ($posts as $ind) {
        $id = $ind['id'];
        $postraw = $conn->query("SELECT * FROM blog WHERE id=$id");
        $post = mysqli_fetch_array($postraw, MYSQLI_ASSOC);
        if (isset($_POST[$id.'vote'])) {
            if ($_POST[$id.'vote'] == 'up') {
                    if(isset($userData[$id.'vote'])) {
                        if ($userData[$id.'vote'] == 'up') {
                            $conn->query("UPDATE blog SET upvote -= 1 WHERE id = '".$id."'");
                            unset($userData[$id.'vote']);
                        } else {
                            $conn->query("UPDATE blog SET upvote += 1 WHERE id = '".$id."'");
                            $userData[$id.'vote'] = 'up';
                        }
                    } else {
                        $conn->query("UPDATE blog SET upvote += 1 WHERE id = '".$id."'");
                        $userData[$id.'vote'] = 'up';
                    }
                } elseif ($_POST[$id.'vote'] == 'down') {
                    if(isset($userData[$id.'vote'])) {
                        if ($userData[$id.'vote'] == 'down') {
                            $conn->query("UPDATE blog SET downvote -= 1 WHERE id = '".$id."'");
                            unset($userData[$id.'vote']);
                        } else {
                            $conn->query("UPDATE blog SET downvote += 1 WHERE id = '".$id."'");
                            $userData[$id.'vote'] = 'down';
                        }
                    } else {
                        $conn->query("UPDATE blog SET downvote += 1 WHERE id = '".$id."'");
                        $userData[$id.'vote'] = 'down';
                    }
                } else {
                    echo 'FUCK!';
                }
                var_dump($userData);
            $useid = $_SESSION['user'];
    $userData = store_userdata($userData);
    $conn->query("UPDATE users SET userdata='".$userData."' WHERE id = '".$useid."'");
            }
            
        }
        if (isset($_POST[$id.'report'])) {
            if (isset($userData[$id.'report'])) {
                $conn->query("UPDATE blog SET reports -= 1 WHERE id = '".$id."'");
                unset($userData[$id.'report']);
            } else {
                $conn->query("UPDATE blog SET reports += 1 WHERE id = '".$id."'");
                $userData[$id.'report'] = TRUE;
            }
            $useid = $_SESSION['user'];
    $userData = store_userdata($userData);
    $conn->query("UPDATE users SET userdata='".$userData."' WHERE id = '".$useid."'");
        }
    }
 else {
    $_SESSION['loginNeeded'] = TRUE;
}
?>