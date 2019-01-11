<?php
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
require_once 'header.php';
?>

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
    <title>Login</title>
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
<?php require_once 'footer.php';?>