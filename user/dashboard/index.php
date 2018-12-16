<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../dbconnect.php';
if (!isset($userRow)) {
    header('Location: ' . '/');
}
if (isset($_GET['name'])) {
    $defval = $_GET['name'];
} else {
    $defval = NULL;
}
if (isset($_POST['stucoshift'])) {
    $idtochange = $_POST['stucoshift'];
    $namer = $_POST['stucoshifter'];
    $stuco = $_POST['stuco'];
    $conn->query("UPDATE users SET stuco=".$stuco." WHERE id= ".$idtochange."");
    $_SESSION['stucoadd'] = $namer;
    $_SESSION['stucoadds'] = $stuco;
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
        <script>
            function alertm(message, type) {
                document.getElementById('alerts').style.display = 'block';
                document.getElementById('messages').innerHTML = message;
                document.getElementById('spacer').style.display = 'none';
                switch (type) {
                    case 'error':
                        document.getElementById('alerts').style.backgroundColor = 'red';
                    break;
                    case 'success':
                        document.getElementById('alerts').style.backgroundColor = 'lightgreen';
                    break;
                    default:
                        document.getElementById('alerts').style.backgroundColor = 'yellow';
                    break;
                }

            }

            function closem() {
                document.getElementById('alerts').style.display = 'none';
                document.getElementById('spacer').style.display = 'block';
            }
        </script>
    </head>
    <body>
        <?php include '../../header.php'?>

        <div id="alerts" class="alert" style="display:none">
            <button class="float-right closer" type="button" onclick="closem()">X</button>
            <h1 class="messages" id="messages"></h1>
        </div>
        <div class="alert-spacer" id="spacer"></div>
        <?php
            if (isset($_SESSION['stucoadd'])) {
                $names = $_SESSION['stucoadd'];
                $stuco = $_SESSION['stucoadds'];
                if ($stuco == 1) {
                    echo "
                    <script>
                        alertm('$names is now in STUCO!', 'success');
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                        alertm('$names is not in STUCO!', 'error');
                    </script>
                    ";
                }
                unset($_SESSION['stucoadds']);
                unset($_SESSION['stucoadd']);
            }
        ?>
        <div class="body">
            <div class="left">
                <?php
                    if($userRow['admin'] == 1) {
                        ?>
                            <h2>Site Members:</h2>
                            <div>
                            <form method="GET">
                                <input type="text" name="name" placeholder="Name" value="<?php echo $defval?>" required>
                            </form><br>
                        <?php
                        if (isset($_GET['name'])) {
                            $name = $_GET['name'];
                            $sql = $conn->query("SELECT * FROM users WHERE flname LIKE '%".$name."%'");
                            if ($sql !== FALSE) {
                                foreach ($sql as $ind) {
                                    $iname = $ind['flname'];
                                    $id = $ind['id'];
                                    if ($ind['stuco'] == 1) {
                                        $message = $iname . ' is not in STUCO!'
                                        ?>
                                        <form method="POST">
                                            <input type="hidden" value="<?php echo $id?>" name="stucoshift">                                        <input type="hidden" value="<?php echo $id?>" name="stucoshift">
                                            <input type="hidden" value="<?php echo $iname?>" name="stucoshifter">
                                            <input type="hidden" value="0" name="stuco">
                                            <button class="btn btn-danger float-right" type="submit" onclick="alertm('<?php echo $message?>', 'error')">Kick from Stuco</button>
                                        </form>
                                        <p><?php echo $iname?></p>
                                        <?php
                                    } else {
                                        $message = $iname . ' is now in STUCO!'
                                        ?>
                                        <form method="POST">
                                            <input type="hidden" value="<?php echo $id?>" name="stucoshift">                                        <input type="hidden" value="<?php echo $id?>" name="stucoshift">
                                            <input type="hidden" value="<?php echo $iname?>" name="stucoshifter">
                                            <input type="hidden" value="1" name="stuco">
                                            <button class="btn btn-primary float-right" type="submit" onclick="alertm('<?php echo $message?>', 'success')">Make Stuco</button>
                                        </form>
                                        <p><?php echo $iname?></p>
                                        <?php
                                    }
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
            </div>
            <div class="main">
                <h2>Profile:</h2>
            </div>
        </div>
    </body>
</html>