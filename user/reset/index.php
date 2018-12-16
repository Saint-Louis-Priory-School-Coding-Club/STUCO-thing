<?php session_start();
include '../../dbconnect.php';
include '../../function.php';
if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $resethash = md5( rand(0,1000));

    $res = $conn->query("SELECT * FROM users WHERE email='".$email."'");
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $match = $res->num_rows;
    if($match > 0){
        $userData = decode_assoc($userRow['userdata']);
        //var_dump($userRow['userdata']);
        $resarray = array (
            'resethash'     => $resethash
        );
        $userData = array_merge($userData, $resarray);
        $userData = encode_assoc($userData);
    $query = $conn->query("UPDATE users SET userdata='".$userData."' WHERE email='".$email."'");
    $fullname = $userRow['flname'];
    $to = $email;
    $site = 'stuco.build';
    $subject = 'Password | Reset';
    $message = '
    Someone has requested to reset the password on the account under '.$fullname.'. If this was not you please ignore this message.
    In order to reset your password please click on the link below:

    '.$site.'/user/reset?email='.$email.'&token='.$resethash.'';
    $headers = 'From:noreply@'.$site. '\r\n';
    mail($to, $subject, $message, $headers);
    }
}
if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $sql = $conn->query("SELECT userdata FROM users WHERE email = '".$email."'");
    if ($sql == FALSE) die('<h1 style="color:red"><strong>Email Does Not Exist</strong></h1>');
    $res = mysqli_fetch_assoc($sql);
    if (isset($_GET['token'])) {
        $token = mysqli_real_escape_string($conn, $_GET['token']);
        $userData = decode_assoc($res['userdata']);
        $confirmtoken = $userData['resethash'];
        if ($token !== $confirmtoken) {
            echo '<h1 style="color:red"><strong>Invalid URL</strong></h1>';
        }
    } else {
        die('<h1 style="color:red"><strong>Invalid URL</strong></h1>');
    }
    if (isset($_POST['change'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['confirm']);
        if ($password !== $cpassword) exit('Passwords dont match');
        $password = hash('sha256', $password);
        $conn->query("UPDATE users SET password = '".$password."' WHERE email = '".$email."'");
        //echo 'success!';
    }
    ?>
    <!DOCTYPE html>
    <head>
        <title>Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include '../../header.php';?>
    <div style="margin-left:35%" class="text-center col-md-3">
    <br><br><br><br>
    <form method="post" autocomplete="off">
            <div class="form-group">
                <h2>Reset Password:</h2>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter New Password" required/>
                    <input type="password" name="confirm" class="form-control" placeholder="Confirm New Password" required/>
                </div>
            </div>
            <button type="submit" name="change" class="btn btn-block btn-primary">Change Password</button>
    </form>
    </div>
    </body>
    </html>
    <?php
} else {
?>
<!DOCTYPE html>
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../../header.php';?>
<div style="margin-left:35%" class="text-center col-md-3">
<br><br><br><br>
<form method="post" autocomplete="off">
        <div class="form-group">
            <h2>Reset Password:</h2>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required/>
            </div>
        </div>
        <button type="submit" name="reset" class="btn btn-block btn-primary">Send Password Reset Link</button>
</form>
</div>
</body>
</html>
<?php
}
?>