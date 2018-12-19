<div class="container-fluid text-center">
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#announcmentm">
Add
</button><h1>STUCO Announcements</h1>
</div>
<div class="modal fade" id="announcmentm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Announcement</h5>
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
<?php
paginate('blog', 5);
?>