<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">Priory STUCO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/suggestion">Suggestions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/tasks">Tasks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Announcements</a>
        </li>
      </ul>
      <?php
        if (!isset($_SESSION)) die('<h1 style="color:red"><strong>START SESSION</strong></h1>');
        if (!isset($_SESSION['user'])) {
          ?>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="/user/register">Sign Up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/user/login">Login</a>
              </li>
            </ul>
          <?php
        } else {
          if (!isset($userRow)) {
            //copy dbconnect.php to here
            $db_host = 'localhost';
            $db_name = 'stuco';
            $db_user = 'root';
            $db_pass = '';
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if (isset($_SESSION['user'])) {
                $res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);

                $userRow = mysqli_fetch_assoc($res);
            }
          }
          $fname = explode(' ',$userRow['flname']);
          $name = $fname[0];
          ?>
            <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="" id="account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/profile.png" height=30px;>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item">Signed in as <strong><?php echo $name?></strong></li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/user/dashboard">Dashboard</a>
                <a class="dropdown-item" href="/user/setting">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?logout">Logout</a>
              </ul>
            </li>
              </ul>
          <?php
        }
      ?>
    </div>
      </div>
  </nav>

<br><br><br><br>
<div class="container-fluid text-center">
<h1 style="color:red"><strong>404 Error: Page not found</strong></h1>
    <p>Ruh roh! Looks like you took a wrong turn!</p>
    <p>The page you are looking for doesn't exist or has been moved to a different address.</p>
</div>
</body>
</html>