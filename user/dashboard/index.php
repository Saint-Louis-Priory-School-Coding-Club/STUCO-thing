<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../dbconnect.php';
if (!isset($userRow)) {
    header('Location: ' . '/');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <?php include '../../header.html'?>
        <div class="body">
            <div class="left">
                <h2>Controls:</h2>
                <?php
                    if($userRow['admin'] == 1) {
                        ?>
                            <h3>Stuco Members:</h3>
                            <form method="POST">
                                <input type="text" name="search" placeholder="Name" required>
                            </form>
                        <?php
                        if (isset($_POST['search'])) {
                            $name = $_POST['search'];
                            $sql = $conn->query("SELECT * FROM users WHERE flname LIKE '%".$name."%'");
                            if ($sql !== FALSE) {
                                foreach ($sql as $ind) {
                                    $iname = $ind['flname'];
                                    echo '
                                    <button class="btn btn-primary float-right" type="submit" form="add_stuco">Make Stuco</button>
                                    <p>'.$iname.'</p>
                                    ';
                                }
                            } else {
                                echo '<p style="color:red"><strong>No users with that name exist</strong></p>';
                            }
                        }
                    } elseif ($userRow['stuco'] == 1){
                        
                    } else {

                    }
                ?>
            </div>
            <div class="main">
                <h2>Profile:</h2>
            </div>
        </div>
    </body>
</html>