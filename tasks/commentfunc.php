<?php 
if (isset($_POST['comment'])) {
$title = mysqli_real_escape_string($conn,$_POST['title']);
$author = mysqli_real_escape_string($conn,$_POST['author']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$post_id = $_POST['id'];
$date = time();
$stmtss = "INSERT INTO tcomments (title,content,author,post_id,date) VALUES('". $title ."', '". $content ."', '". $author ."', '".$post_id."','".$date."')";
$querys = $conn->query($stmtss);
$refreshsql = $conn->query("SELECT * FROM tcomments WHERE post_id = $post_id AND date=$date") or die("Error, line 10 commentfunc");
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