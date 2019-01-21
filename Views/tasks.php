<?php

require_once 'header.php';
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo __URL?>/Library/CSS/task-stylesheet.css">
<title>Tasks</title>
<div class="pagecontent">
    <div class="fillerl"></div>
    <div class="left-content">
    <?php
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT stuco,flname FROM users WHERE id=$id");
    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $name = $res['flname'];
    if ($res['stuco'] == 1) {
        ?>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#announcmentm">Add</button>
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
<h1>Hello <?php echo $name?></h1>
<?php
    } else {
        ?>
        <h3>You are a student.</h3>
        <?php
    }
} else {
    ?>
    <h1>Login to view side controls</h1>
    <?php
}
?>

    </div>
    <div class="content">
        <?php 
        $model = new Tasks_Model;
        $model->paginate($conn, 'ctask',5)
        //paginate('ctask', 5);
        ?>
    </div>
    <div class="right-content">
    <?php
$address = $_SERVER['PHP_SELF'];
$fromextern = TRUE;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $psw = mysqli_real_escape_string($conn, $_POST['password']);
    $password = hash('sha256', $psw);
    $sql = $conn->query("SELECT * FROM users WHERE email='".$username."'");
    if ($sql !== FALSE) {
        $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        if($res['password'] == $password) {
            $_SESSION['user'] = $res['id'];
            echo "<meta http-equiv='Refresh' content='0; url=".$address."'>";
        } else {
            echo 'Bad password';
        }
    } else {
        echo 'User does not exist';
    }
}
if (isset($_POST['signup'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $flname = $fname . ' ' . $lname;
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $psw = mysqli_real_escape_string($conn, $_POST['password']);
    $password = hash('sha256', $psw);
    $sql = $conn->query("SELECT email FROM users WHERE email = $email");
    if ($sql) {
        echo 'Email has already been registered';
    } else {
        $sql = $conn->query("INSERT INTO users (flname,email,password) VALUES ('".$flname."','".$email."','".$password."')");
        $user_id = mysqli_insert_id($conn);
        $_SESSION['user'] = $user_id;
        echo "<meta http-equiv='Refresh' content='0; url=".$address."'>";
    }
    
    
}
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT * FROM users WHERE id=$id");
    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $imgurl = '/library/images/profile.png';
    echo '
    <form method="POST" id="logout"><input type="hidden" name="logout"></form>
    <h3 class="mitems">Welcome</h3>
    <img height=60px width=60px src="'.$imgurl.'">
    <a class="mitems" href="/user/dashboard">Dashboard</a>
    <a class="mitems" href="/user/profile">Profile</a>
    <a class="mitems" href="?logout">Logout</a>
    ';
} elseif (isset($_GET['signup'])) {
    include 'Tasks/sidesignup.php';
} elseif (isset($_GET['forgot'])) {
    echo '<h1>Feature not implimented</h1>
    <a class="mitems" href="?signup" style="margin-left:15px;color:lime">Register</a>
    <a class="mitems" href="?" style="margin-left:15px;color:lime">Login</a>';
    
} else {
    include 'Tasks/sidelogin.php';
}   
?>
    </div>
    <div class="fillerr"></div>
</div>


<?php
require_once 'footer.php';
?>