<?php
if (!isset($_SESSION['postId'])) {
    header('Location: ' . '/blog');
}
$id = $_SESSION['postId'];
$posts = $conn->query("SELECT * FROM blog WHERE id =$id");
$numrows = $posts->num_rows;
if ($numrows < 1) {
    $viewer = new View;
    $viewer->e4041('Post Not Found');
    die();
}
$post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
$isdate = time() - $post['date'];
$paginate = new Tasks_Model;
$date = $paginate->uniToTime($isdate);
if (isset($_POST["delete"])) {
    $sql = $conn->query("DELETE FROM blog WHERE id =$id");
    echo '<meta http-equiv="Refresh" content="0; url=/blog">';
}
require_once 'header.php';
?>
    <title><?php echo $post['title']; ?></title>
        <form method="POST" id="deleteform"></form>
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
                $paginate->paginate($conn, 'bcomments', 5, $id);
                ?>
                </div>
                <h2>Add Comment:</h2>
                <?php 
if (isset($_POST['comment'])) {
$title = mysqli_real_escape_string($conn,$_POST['title']);
$author = mysqli_real_escape_string($conn,$_POST['author']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$post_id = $_POST['id'];
$date = time();
$stmtss = "INSERT INTO bcomments (title,content,author,post_id,date) VALUES('". $title ."', '". $content ."', '". $author ."', '".$post_id."','".$date."')";
$querys = $conn->query($stmtss);
$refreshsql = $conn->query("SELECT * FROM bcomments WHERE post_id = $post_id AND date=$date") or die();
if (!$refreshsql) {
    echo 'ERROR';
}
$refreshsqls = mysqli_fetch_array($refreshsql, MYSQLI_ASSOC);
$cid = $refreshsqls['id'];
echo '<meta http-equiv="Refresh" content="0; url=#'.$cid.'">';
}
?>
    <form method="POST" autocomplete="off"  enctype="multipart/form-data">

        <div class="col-sm-12">

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

            <input type="hidden" name="id" value="<?php echo $id?>">

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="comment" id="comment" href="#">Comment</button>
            </div>

        </div>

    </form>

            </div>
<?php require_once 'footer.php';?>