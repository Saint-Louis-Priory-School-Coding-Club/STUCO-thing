<?php
require_once 'dashboard-header.php';
?>

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/user/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Pages</li>
        </ol>
        <!-- End Breadcrumbs-->

      <div class="card mr-auto mt-4">
        <div class="card-header">All Pages</div>
        <div class="card-body pt-3">
        <div class="ml-auto"><a href="/user/dashboard/pages/add" class="btn btn-primary ml-auto">Add Page</a></div>
        <br>
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Page</th>
                        <th>Author</th>
                        <th>Path</th>
                        <th>Created On</th>
                        <th>Last Updated On</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php 

                        $sql = $conn->query("SELECT * FROM pages");
                        foreach ($sql as $ind) {
                          $pageName = $ind['pageName'];
                          $pageAuthor = $ind['author'];
                          $pagePath = $ind['pagePath'];
                          $createdOn =date("m\/d\/y", $ind['createdOn']);
                          $updatedOn = date("m\/d\/y",$ind['updatedOn']);
                          $id = $ind['id'];
                          echo '
                          <tr>
                            <td>'.$pageName.'</td>
                            <td>'.$pageAuthor.'</td>
                            <td><a href="'.$pagePath.'">'.$pagePath.'</a></td>
                            <td>'.$createdOn.'</td>
                            <td>'.$updatedOn.'</td>
                            <td><a href="/user/dashboard/pages/edit/'.$id.'">Edit</a></td>
                          </tr>
                          ';
                        }


                    ?>
                    
                  </tbody>
                </table>
        </div>
      </div>
    </div>

    </div>
</div>

<?php
require_once 'dashboard-footer.php';
?>