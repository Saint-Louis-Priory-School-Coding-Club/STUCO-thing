<?php 
$posts = $conn->query("SELECT * FROM blog");
if (isset($userData)) {
    foreach ($posts as $ind) {
        $id = $ind['id'];
        $postraw = $conn->query("SELECT * FROM blog WHERE id=$id");
        $post = mysqli_fetch_array($postraw, MYSQLI_ASSOC);
        if (isset($_POST[$id.'vote'])) {
            if ($_POST[$id.'vote'] == 'up') {
                $voteupsanddowns = $conn->query("SELECT upvote, downvote FROM blog WHERE id ='".$id."'");
                $megavotes = mysqli_fetch_assoc($voteupsanddowns);
                $upminus = $megavotes['upvote'] - 1;
                $upplus = $upminus + 2;
                $downminus = $megavotes['downvote'] - 1;
                $downplus = $downminus + 2;
                    if(isset($userData[$id.'vote'])) {
                        if ($userData[$id.'vote'] == 'up') {
                            $conn->query("UPDATE blog SET upvote = $upminus WHERE id = '".$id."'");
                            unset($userData[$id.'vote']);
                        } else {
                            $conn->query("UPDATE blog SET upvote = $upplus, downvote = $downminus WHERE id = '".$id."'");
                            $userData[$id.'vote'] = 'up';
                        }
                    } else {
                        $conn->query("UPDATE blog SET upvote = $upplus WHERE id = '".$id."'");
                        $userData[$id.'vote'] = 'up';
                    }
                } elseif ($_POST[$id.'vote'] == 'down') {
                    $voteupsanddowns = $conn->query("SELECT upvote, downvote FROM blog WHERE id ='".$id."'");
                $megavotes = mysqli_fetch_assoc($voteupsanddowns);
                $upminus = $megavotes['upvote'] - 1;
                $upplus = $upminus + 2;
                $downminus = $megavotes['downvote'] - 1;
                $downplus = $downminus + 2;
                    if(isset($userData[$id.'vote'])) {
                        if ($userData[$id.'vote'] == 'down') {
                            $conn->query("UPDATE blog SET downvote = $downminus WHERE id = '".$id."'");
                            unset($userData[$id.'vote']);
                        } else {
                            $conn->query("UPDATE blog SET downvote = $downplus, upvote = $upminus WHERE id = '".$id."'");
                            $userData[$id.'vote'] = 'down';
                        }
                    } else {
                        $conn->query("UPDATE blog SET downvote = $downplus WHERE id = '".$id."'");
                        $userData[$id.'vote'] = 'down';
                    }
                }
                //var_dump($userData);
            $useid = $_SESSION['user'];
    $userData = store_userdata($userData);
    $conn->query("UPDATE users SET userdata='".$userData."' WHERE id = '".$useid."'");
            }
            
        }
        if (isset($_POST[$id.'report'])) {
            $reports = $conn->query("SELECT reports FROM blog WHERE id = '".$id."'");
            $reports = mysqli_fetch_assoc($reports);
            $repminus = $reports['reports'] - 1;
            $repplus = $repminus + 2;
            if (isset($userData[$id.'report'])) {
                $conn->query("UPDATE blog SET reports = $repminus WHERE id = '".$id."'");
                unset($userData[$id.'report']);
            } else {
                $conn->query("UPDATE blog SET reports = $repplus WHERE id = '".$id."'");
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