<?php 
if (isset($_POST['add'])) {
    include 'dbconnect.php';
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $date = time();
    $stmts = "INSERT INTO blog (title,content,author,date) VALUES('". $title ."', '". $content ."', '". $author ."', '". $date ."')";
    $query = $conn->query($stmts);
    $check = $conn->query("SELECT id FROM blog WHERE date=$date");
    $checks = mysqli_fetch_array($check, MYSQLI_ASSOC);
    $id = $checks['id'];
    mkdir('posts/'.$id);
    $filecreate = fopen('posts/'.$id.'/index.php', 'x') or die('Unable to open file!');
    $template = file_get_contents('template.php');
    $text = str_replace('$id', $id, $template);
    fwrite($filecreate, $text);
    echo '<meta http-equiv="Refresh" content="0; url=posts/'.$id.'">';
}
?>
<div class="container">
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

            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="add" id="add">Publish</button>
            </div>

        </div>

    </form>

</div>