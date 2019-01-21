<?php
if (!isset($_SESSION['page_id'])) {
    //header('Location:' . '/user/dashboard/pages');

}
$cid = $_SESSION['page_id'];
$sql = $conn->query("SELECT * FROM pages WHERE id= '".$cid."'") or die($conn->error);
$sql = mysqli_fetch_assoc($sql);
$pageName = $sql['pageName'];
$pagePath = $sql['pagePath'];
$paths = explode('/',$pagePath);
$sizeOfPaths = sizeof($paths);
    //echo $sizeOfPaths;
    if ($sizeOfPaths === 2) {
        $pagePath = $pagePath;
    } elseif ($sizeOfPaths === 3) {
        $pagePath = '/'.$paths[1].'-'.$paths[2];
    } elseif ($sizeOfPaths > 3) {
        $pagePath = '/'.$paths[1].'-'.$paths[2];
    }
$pageContent = file_get_contents('./Views'.$pagePath.'.php');

if (isset($_POST['edit-page'])) {
if ($pageName !== $_POST['page-name']) $nameChanged = TRUE;
else $nameChanged = FALSE;
if ($pagePath !== $_POST['page-path']) $pathChanged = TRUE;
else $pathChanged = FALSE;
if ($pageContent !== $_POST['page-content']) $contentChanged = TRUE;
else $contentChanged = FALSE;
$pagePath = $sql['pagePath'];
$pagePath = strtolower($pagePath);
$paths = explode('/', $pagePath);
$path = [];
foreach ($paths as $ind) {
    if ($ind !== '') {
        array_push($path, $ind);
    }
}
$controllerContents = file_get_contents('./Controllers/'.$path[0].'.php');

if ($pathChanged) {
    $pathCaps = substr_replace($path[0], strtoupper(substr($path[0], 0, 1)), 0, 1);
    $changedPath = explode('/', strtolower($_POST['page-path']));
    $cpaths = [];
    foreach ($changedPath as $ind) {
        if ($ind !== '') {
            array_push($cpaths, $ind);
        }
    }
    $changedPath = $cpaths;
    $changedCapsPath = substr_replace($changedPath[0], strtoupper(substr($changedPath[0], 0, 1)), 0, 1);
    $controllerContents = str_replace($path[0], $changedPath[0], $controllerContents);
    $controllerContents = str_replace($pathCaps, $changedCapsPath, $controllerContents);
    $fileRef = fopen('./Controllers/'.$changedPath[0].'.php', 'x');
    fwrite($fileRef, $controllerContents);
    unlink('./Controllers/'.$path[0].'.php');
} else {
    $changedPath = $path;
}
if ($contentChanged) {
        $changedContents = $_POST['page-content'];
        unlink('./Views/'.$path[0].'.php');
        $fileRef = fopen('./Views/'.$changedPath[0].'.php', 'x');
        fwrite($fileRef, $changedContents);
    } elseif ($changedPath !== $path) {
        unlink('./Views/'.$path[0].'.php');
        $fileRef = fopen('./Views/'.$changedPath[0].'.php', 'x');
        fwrite($fileRef, $pageContent);
    }

if ($nameChanged) {
    $changedName = $_POST['page-name'];
    $date = time();
    if ($pathChanged) {
        $changedPath = $_POST['page-path'];
        $conn->query("UPDATE pages SET pagePath = '".$changedPath."', pageName = '".$changedName."', updatedOn = '".$date."' WHERE id = '".$cid."' ");
    } else {
        $conn->query("UPDATE pages SET pageName = '".$changedName."', updatedOn = '".$date."' WHERE id = '".$cid."'") or die($conn->error);
    }
} elseif ($pathChanged) {
    $date = time();
    $changedPath = $_POST['page-path'];
    $conn->query("UPDATE pages SET pagePath = '".$changedPath."', updatedOn = '".$date."' WHERE id = '".$cid."'");
}

}


require_once 'dashboard-header.php';
?>
    <script src="<?php echo __URL?>/Library/JavaScript/auto-resize.js"></script>
<style>
.animated {
            -webkit-transition: height 0.2s;
            -moz-transition: height 0.2s;
            transition: height 0.2s;
        }
</style>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/user/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item"><a href="/user/dashboard/pages">Pages</a></li>
        <li class="breadcrumb-item active">Edit</li>
        </ol>
        <!-- End Breadcrumbs-->

        <div class="card mr-auto mt-4">
        <div class="card-header">Edit Page</div>
        <div class="card-body pt-3">
            <p style="color:red"><strong>WARNING: IF YOU CHANGE THE PATH OF A PAGE WITH SUBDIRECTORIES, THEY WILL BE DELETED. THAT FUNCTION IS MEANT FOR SINGLE LAYERED DIRECTORIES, IF IT IS A MULTI LEVELED DIRECTORY, CREATE NEW ONES WITH THE NEW PATH INSTEAD</strong></p>
        <form method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="page-name" name="page-name" value="<?php echo $pageName?>" placeholder="Page Name" class="form-control" required>
                <label for="page-name">Page Name</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="page-path" name="page-path" value="<?php echo $pagePath?>" placeholder ="Path (i.e. /example)" class="form-control" required>
                <label for="page-path">Path</label>
              </div>
            </div>
            <div class="form-group">
                <textarea class="form-control animated" name="page-content" required placeholder="Page Content (code)"><?php echo $pageContent?></textarea>
            </div>
        <button type="submit" name="edit-page" class="btn btn-primary">Update Page</button>
          </form>

      </div>
    </div>

    </div>
</div>
<script>
    $(function(){
        $('.normal').autosize();
        $('.animated').autosize({append: "\n"});
    });
</script>
<?php
require_once 'dashboard-footer.php';
?>