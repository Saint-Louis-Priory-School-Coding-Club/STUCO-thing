<?php
session_start();
include '../../../dbconnect.php';
$id = $inputid;
$posts = $conn->query("SELECT * FROM blog WHERE id =$id");
$post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
$isdate = time() - $post['date'];
include '../../timefunc.php';
if (isset($_POST["delete"])) {
    $sql = $conn->query("DELETE FROM blog WHERE id =$id");
    unlink("index.php");
    rmdir("../".$id);
    echo '<meta http-equiv="Refresh" content="0; url=/blog">';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $post['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="stylesheet.php">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <form method="POST" id="deleteform"></form>
        <?php include '../../../header.php'?>
        <br>
        <div class="container-fluid">
          <div class="container">

          <h4 class="float-right"><?php echo $date; ?></h4>
          <h1><?php echo $post['title']; ?></h1>
              <p>By <?php echo $post['author']; ?></p>
          </div>
            <div class="container">
                <p><?php echo $post['content']; ?></p>
          
                <button type="submit" form="deleteform" name="delete" class="btn btn-danger">Delete</button>
            </div>
            <div class="panel panel-default container">
                <div class="panel-heading">
                <h1 style="color:grey"><br>Comments:</h1>
                </div>
                <div class="container">
                <?php
                include '../../../pagination.php';
                $paginate = new Paginater();
                $paginate->paginate('bcomments', 5, $id);
                ?>
                </div>
                <h2>Add Comment:</h2>
                <?php include '../../commentfunc.php'?>

            </div>
    </body>
</html>
