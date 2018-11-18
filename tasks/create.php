<?php 
    include '../blog/dbconnect.php';
    $sugtxt = "Select a suggestion to view preview";
    if (isset($_POST['add'])) {
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $author = mysqli_real_escape_string($conn,$_POST['author']);
        $content = mysqli_real_escape_string($conn,$_POST['content']);
        $date = time();
        $sugid = mysqli_real_escape_string($conn,$_POST['sugid']);
        $stmts = "INSERT INTO ctask (title,solution,author,date,suggestion_id) VALUES('". $title ."', '". $content ."', '". $author ."', '". $date ."','".$sugid."')";
        $query = $conn->query($stmts);
    }
?>
<script>
    function change(id) {
        var text;
        switch (id) {
        <?php 
        $sql = $conn->query("SELECT id,content FROM suggestion");
        foreach ($sql as $ind) {
            $id = $ind['id'];
            $content = $ind['content'];
            echo '
            case "'.$id.'":
            text = "'.$content.'";
            break;

            ';
        }
        ?>
        default:
        text = "<?php echo $sugtxt?>";
        break;
        }
        document.getElementById("sugprev").innerHTML = text;
    }
</script>
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
                        <select class="custom-select form-control" id="sugid" name="sugid" required onchange="return change(this.value)">
                            <option selected>Select Suggestion...</option>
                            <?php
                                $sql = $conn->query("SELECT id,title FROM suggestion");
                                foreach ($sql as $ind) {
                                    $id = $ind['id'];
                                    $title = $ind['title'];
                                    echo '<option value="'.$id.'">'.$title.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

            <div class="form-group">
                <div class="input-group">
                    <textarea id="sugprev" class="form-control" placeholder="<?php echo $sugtxt;?>" readonly></textarea>
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