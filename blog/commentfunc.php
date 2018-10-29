<?php 
include 'dbconnect.php';
if (isset($_POST['comment'])) {
$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$post_id = $_POST['id'];
date_default_timezone_set('America/Chicago');
$date = date('l jS \of F Y h:i:s A');
$stmtss = "INSERT INTO comments (title,content,author,post_id) VALUES('". $title ."', '". $content ."', '". $author ."', '".$post_id."')";
$querys = $conn->query($stmtss);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesheet.php">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php include '../header.html';?>
<div class="container">
    <form method="POST" autocomplete="off"  enctype="multipart/form-data">

        <div class="col-md-12">

            <div class="form-group">
                <h2>Comment</h2>
            </div>

            <div class="form-group">
                <hr/>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="title" class="form-control" placeholder="Title" required/>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="author" class="form-control" placeholder="Authors" required/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <textarea name="content" class="form-control" placeholder="Description" required></textarea>
                </div>
            </div>

            <input type="hidden" name="id" value="17">

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="comment" id="comment" href="#">Comment</button>
            </div>

        </div>

    </form>

</div>
</body>
</html>