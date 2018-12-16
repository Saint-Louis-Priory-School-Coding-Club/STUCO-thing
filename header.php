<?php
if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
}
?>
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
