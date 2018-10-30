<?php 
include '../../dbconnect.php';
$posts = $conn->query('SELECT * FROM blog WHERE id =17');
$post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
$idate = time() - $post['date'];
include '../../timefunc.php';
if (isset($_POST["delete"])) {
    $sql = $conn->query("DELETE * FROM blog WHERE id =17");
    unlink("index.php");
    rmdir("../17");
    $var1 = <<<str
<meta http-equiv="Refresh" content="0; url=/">
str;
    echo $var1;
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
        <?php include '../../../header.html'?>
        <br>
        <div class="container-fluid">
            <div class="container">
            <h4 class="float-right"><?php echo $date; ?></h4><h1><?php echo $post['title']; ?></h1>
                <p>By <?php echo $post['author']; ?></p>
            </div>
            <div class="container">
                <p><?php echo $post['content']; ?></p>
            </div>
            <div class="panel panel-default container">
                <div class="panel-heading">
                <h1 style="color:grey"><br>Comments:</h1>
                </div>
                <div class="container">
                <!--@if(count($comments) > 0)
                @foreach($comments as $comment)-->
                <?php 
                $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id=17");
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $commentc = $result->num_rows;
                $comments = $conn->query("SELECT * FROM comments WHERE post_id=17");
                if ($commentc > 0) {
                    foreach ($comments as $comment) {
                        echo '
                        <h3>'.$comment['title'].'</h3>
                        <p>'.$comment['content'].'</p>
                        <small>Written by '.$comment['author'].'</small>
                        <hr>
                        ';
                    }
                } else {
                    echo $string = <<<STRINGS
                    <h3 style="color:red">No Comments</h3>
STRINGS;
                }
                ?>
                </div>
                <h2>Add Comment:</h2>
            </div>
    </body>
</html>