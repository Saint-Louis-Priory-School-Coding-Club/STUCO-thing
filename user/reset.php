<?php session_start(); ?>
<!DOCTYPE html>
<br><br><br><br><br>
<?php include '../dbconnect.php';
if (isset($_POST['reset'])) {
  if (isset($_POST['email'])) {
$email = trim($_POST['email']);
$resethash = md5( rand(0,1000));
}

$search = "SELECT email, resethash, username FROM users WHERE email='".$email."'";
$res = $conn->query("SELECT * FROM users WHERE email='".$email."'");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
$result = $conn->query($search);
$match = $result->num_rows;
if($match > 0){
$sql = "UPDATE users SET resethash='".$resethash."' WHERE email='".$email."'";
$query = $conn->query($sql);
$username = $userRow['username'];
echo $username;
$to = $email;
$subject = 'Password | Reset';
$message = '
Someone has requested to reset the password on user account '.$username.'. If this was not you please change your password immidatly
In order to reset your password please click on the link below:

'.$site.'/resetverify.php?email='.$email.'&token='.$resethash.'';
$headers = 'From:noreply@'.$sitemail . '\r\n';
mail($to, $subject, $message, $headers);
}
}
?>
<html>
<head>
    <?php include 'setup2.php';?>
    <title>Reset Password</title>
</head>
<body>
<div class="container">

    <div id="reset-form">
        <form method="post" autocomplete="off">

            <div class="col-md-12 text-center">
                <div class="form-group">
                    <h2>Request Password Reset</h2>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required/>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="reset" id="reset">Send Password Reset Link</button>
                </div>
                <div class="form-group">
                    <hr/>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
