<?php
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: /user/dashboard");
}
include '../../function.php';
include_once '../../dbconnect.php';
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = $conn->query("SELECT COUNT(*) FROM users WHERE email='".$email."'");
    $count = mysqli_fetch_assoc($sql);
    $emailexist = $count['COUNT(*)'];
    $sql = $conn->query("SELECT COUNT(*) FROM users WHERE flname='".$username."'");
    $count = mysqli_fetch_assoc($sql);
    $userexist = $count['COUNT(*)'];
    if ($userexist < 1 && $emailexist < 1) {
        $psswd = hash('sha256', $password);
        $hash = hash('sha256', rand(1, 100000));
        $userdata = array (
            'active'        => 0,
            'prevstuco'     => 0,
            'createdon'     => time(),
            'key'           => $psswd
        );
        $userdata = store_userdata($userdata);
        $sql = $conn->query("INSERT INTO users (flname, email, password, userdata) VALUES ('".$username."', '".$email."', '".$psswd."', '".$userdata."')");
        if ($sql != FALSE) {
            $cid = mysqli_insert_id($conn);
            $_SESSION['user'] = $cid;
            header('Location: '. '/');
        }
    } else {
        echo 'Username or Email already exists';
    }
    

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
            .content {
                margin-left: 40%;
                margin-right: 40%;
                text-align: center;
                
            }
            .back {
                display: inline;
            }
            .back p {
                text-decoration: none;
                color: grey;
                margin-left: 3%;
                cursor: default;
                font-size: 24pt;
            }
            .mid-content {
                border-radius: 4px;
                text-align: left;
                padding: 5%;
                padding-left: 10%;
                padding-right: 10%;
                background-color: white;
                border: 1px solid lightgrey;
            }
            .bottom-content {
                border-radius: 4px;
                text-align: left;
                padding: 5%;
                padding-left: 10%;
                padding-right: 10%;
                border: 1px solid lightgrey;
                padding-bottom: 2%;
                margin-top: 5%;
            }
            .input-field {
                border-radius: 4px;
                border: 1px solid lightgrey;
                width: 100%;
                padding-left: 10px;
                height: 35px;
                margin-bottom: 3%;
            }
            .input-submit {
                border-radius: 4px;
                background-color: #29ab46;
                color: white;
                border: none;
                width: 100%;
                height: 35px;
                margin-top: 6%;
            }
            .input-submit:hover {
                cursor: pointer;
            }
            .headertxt {
                font-size: 18pt;
                color: black;
                margin-bottom: 7%;
            }
        </style>
        <script>
            function goBack() {
                window.history.back()
            }
        </script>
    </head>
    <body>
    <?php include '../../header.php'?>
        <br><br>
        <div class="content">
            <p class="headertxt">Sign up for Priory Stuco</p>
            <div class="mid-content">
            <form method="POST">
                <label>Full Name:</label><br>
                <input class="input-field" type="text" name="username" required>
                <label>Email:</label><br>
                <input class="input-field" type="email" name="email" required>
                <label>Password:</label><br>
                <input class="input-field" type="password" name="password" required><br>
                <button class="input-submit" type="submit" name="signup">Sign up</button>
            </form>
            </div>
            <div class="bottom-content">
                <p>Already registered? <a class="main-link" href="/user/login">Login here</a></p>
            </div>
        </div>
    </body>
</html>
