<?php
if(!isset($_SESSION)) {
    session_start();
}
include '../../dbconnect.php';
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn,$_POST['user']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $logintype = stripos($user, '@') !== FALSE;
    if ($logintype != FALSE) {
        $sql = $conn->query("SELECT id, password FROM users WHERE email = '".$user."'");
    } else {
        $sql = $conn->query("SELECT id, password FROM users WHERE flname = '".$user."'");
    }
    if ($sql != FALSE) {
        $psswd = hash('sha256', $password);
        $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        if ($psswd == $res['password']) {
            $_SESSION['user'] = $res['id'];
            header('Location: '. '/');
        } else {
            echo 'Bad Password';
        }
    } else {
        echo 'User does not exist';
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
                cursor: default;
                margin-left: 3%;
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
            <p class="headertxt">Login to Priory Stuco</p>
            <div class="mid-content">
            <form method="POST">
                <label>Full Name or Email:</label><br>
                <input class="input-field" type="text" name="user" required>
                <label>Password:</label><br>
                <input class="input-field" type="password" name="password" required><br>
                <button class="input-submit" type="submit" name="login">Login</button>
                <form method="POST">
            </form>
            </div>
            <div class="bottom-content">
                <p>Need an account? <a class="main-link" href="/user/register">Register here</a></p>
            </div>
        </div>
    </body>
</html>