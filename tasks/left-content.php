<?php
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $sql = $conn->query("SELECT stuco,name FROM users WHERE id=$id");
    $res = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $name = $res['name'];
    if ($res['stuco'] == 1) {
        ?>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#announcmentm">Add</button>
<div class="modal fade" id="announcmentm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php include 'create.php' ?>
        </div>
        </div>
    </div>
</div>
<h1>Hello <?php echo $name?></h1>
<?php
    } else {
        ?>
        <h3>You are a student.</h3>
        <?php
    }
} else {
    ?>
    <h1>Login to view side controls</h1>
    <?php
}
?>
