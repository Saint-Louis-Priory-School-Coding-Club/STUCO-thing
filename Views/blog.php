<?php
$model = new Userdata;
if (isset($userRow)) $userData = $model->use_userdata($userRow['userdata'], $userRow['password']);
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
    $userData = $model->store_userdata($userData);
    $conn->query("UPDATE users SET userdata='".$userData."' WHERE id = '".$useid."'");
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
        $userData = $model->store_userdata($userData);
        $conn->query("UPDATE users SET userdata='".$userData."' WHERE id = '".$useid."'");
            }
        }
        
    }
 else {
    $_SESSION['loginNeeded'] = TRUE;
}
require_once 'header.php';
?>

<title>Announcements</title>
<link rel="stylesheet" type="text/css" href="<?php echo __URL?>/Library/CSS/blog-stylesheet.css">
<div class="container-fluid text-center">
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#announcmentm">
Add
</button><h1>STUCO Announcements</h1>
</div>
<div class="modal fade" id="announcmentm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $date = time();
    $stmts = "INSERT INTO blog (title,content,author,date) VALUES('". $title ."', '". $content ."', '". $author ."', '". $date ."')";
    $query = $conn->query($stmts);
    $check = $conn->query("SELECT id FROM blog WHERE date=$date");
    $checks = mysqli_fetch_array($check, MYSQLI_ASSOC);
    $id = $checks['id'];
    echo '<meta http-equiv="Refresh" content="0; url=posts/'.$id.'">';
}
?>
<div class="container">
    <form method="POST" autocomplete="off"  enctype="multipart/form-data">

        <div class="col-md-12">

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="title" class="form-control" placeholder="Title" required/>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="author" class="form-control" placeholder="Authors" required/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <textarea name="content" class="form-control" placeholder="Description" required></textarea>
                </div>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="add" id="add">Publish</button>
            </div>

        </div>

    </form>

</div>
      </div>
    </div>
  </div>
</div>
<?php
$paginator = new Tasks_Model;
$paginator->paginate($conn, 'blog', 5);
?>

<?php
require_once 'footer.php';
?>