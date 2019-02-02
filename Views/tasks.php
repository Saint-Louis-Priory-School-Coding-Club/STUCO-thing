<?php

require_once 'header.php';
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT stuco, flname FROM users WHERE id=$id");
    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $name = $res['flname'];
    $stuco = $res['stuco'];
} else {
    $stuco = 0;
}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo __URL?>/Library/CSS/task-stylesheet.css">
<title>Tasks</title>
<div class="pagecontent">
    <br>
    <div class="row">
        <?php if($stuco==1){?>
        <div class="col-sm-2">
            <div class="side-bar-container">
                <?php
                if (isset($_SESSION['user'])) {
                    if ($stuco == 1) {
                        ?>
                        <div class="modal fade" id="announcmentm" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php include 'Tasks/create.php';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Hello, <?php echo $name?>.</h3>
                        <p>Click the button below to add a task.</p>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#announcmentm">Add</button>
                        <?php
                    } else {
                        ?>
                        <h3>Hello, <?php echo $name?>.</h3>
                        <?php
                    }
                } else {
                    ?>
                    <p>Hello!</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="col-sm-<?php if($stuco == 1){ echo '8'; } else { echo '10'; } // make this panel bigger if not stuco to fit page?>">
            <div class="task-body">
                <?php
                $model = new Tasks_Model;
                $model->paginate($conn, 'ctask',5)
                //paginate('ctask', 5);
                ?>
            </div>

        </div>
        <div class="col-sm-2">
            <div class="side-bar-container">
                <?php
                $address = $_SERVER['PHP_SELF'];
                $fromextern = TRUE;
                if (isset($_SESSION['user'])) {
                    $id = $_SESSION['user'];
                    $sql = $conn->query("SELECT * FROM users WHERE id=$id");
                    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                    $imgurl = '/library/images/profile.png';
                    ?>
                    <form method="POST" id="logout"><input type="hidden" name="logout"></form>
                    <h4 class="mitems">Hello, <?php echo $name;?>.</h4>
                    <img height=60px width=60px src="<?php echo $imgurl;?>">
                    <br>
                    <a class="mitems" href="/user/dashboard">Dashboard</a>
                    <br>
                    <a class="mitems" href="/user/profile">Profile</a>
                    <br>
                    <a class="mitems" href="?logout">Logout</a>
                    <?php
                } else {?>
                    <p>You're not logged in. Please log in to view account details.</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="fillerr"></div>
</div>
<?php
require_once 'footer.php';
?>

