<?php 
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
    <form method="POST" autocomplete="off"  enctype="multipart/form-data">

        <div class="col-md-12">

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