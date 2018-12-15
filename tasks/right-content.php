<?php
$address = $_SERVER['PHP_SELF'];
$fromextern = TRUE;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $psw = mysqli_real_escape_string($conn, $_POST['password']);
    $password = hash('sha256', $psw);
    $sql = $conn->query("SELECT * FROM users WHERE email='".$username."'");
    if ($sql) {
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
        $sql = $conn->query("SELECT id FROM users WHERE email = $email");
        $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $_SESSION['user'] = $res['id'];
        echo "<meta http-equiv='Refresh' content='0; url=".$address."'>";
    }
    
    
}
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT * FROM users WHERE id=$id");
    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $imgurl = $res['profile'];
    echo '
    <form method="POST" id="logout"><input type="hidden" name="getout"></form>
    <h3 class="mitems">Welcome</h3>
    <img height=60px width=60px src="'.$imgurl.'">
    <a class="mitems" href="/user/dashboard">Dashboard</a>
    <a class="mitems" href="/user/profile">Profile</a>
    <a class="mitems" href="?getout">Logout</a>
    ';
} elseif (isset($_GET['signup'])) {
    include 'sidesignup.php';
} elseif (isset($_GET['forgot'])) {
    echo '<h1>Feature not implimented</h1>
    <a class="mitems" href="?signup" style="margin-left:15px;color:lime">Register</a>
    <a class="mitems" href="?" style="margin-left:15px;color:lime">Login</a>';
    
} else {
    include 'sidelogin.php';
}
if (isset($_GET['getout'])) {
    session_destroy();
    unset($_SESSION['user']);
    echo "<meta http-equiv='Refresh' content='0; url=".$address."'>";
}     
?>