<?php
if (isset($_POST['add-page'])) {

    $newPageContent = $_POST['page-content'];
    $pageName = $_POST['page-name'];
    $pagePath = $_POST['page-path'];
    $path = explode('/',$_POST['page-path']);
    //var_dump($path);
    //echo '<br>';
    $paths = [];
    foreach ($path as $ind) {
        if ($ind !== '') {
            array_push($paths, $ind);
        }
    }
    //var_dump($paths);
            //echo '<br>';
    $sizeOfPaths = sizeof($paths);
    //echo $sizeOfPaths;
    if ($sizeOfPaths === 1) {
        $controllerName = $paths[0];
        $functionName = NULL;
    } elseif ($sizeOfPaths === 2) {
        $controllerName = $paths[0];
        $functionName = $paths[1];
        //echo 'work!';
        //echo $functionName;
    } elseif ($sizeOfPaths > 2) {
        $controllerName = $paths[0];
        $functionName = $paths[1];
        $parameters = $paths;
        unset($parameters[0]);
        unset($parameters[1]);
        $tempParams = [];
        foreach ($parameters as $ind) {
            array_push($tempParams, $ind);
        }
        $page_model = new Pages_Model;
        $parameters = $page_model->encode_array($tempParams);
    }

    $controllerName = strtolower($controllerName);
    if (isset($_POST['include-hf'])) $includeHF = TRUE;
    else $includeHF = FALSE;
    if (file_exists('./Controllers/'.$controllerName.'.php')) {
        //echo 'one step down';
        $filecreate = fopen('./Controllers/'.$controllerName.'.php', 'r+') or die('Unable to open file!');
        //fseek($filecreate, 0, SEEK_END);
        $fileContents = file_get_contents('./Controllers/'.$controllerName.'.php');
        if ($functionName !== NULL && !isset($parameters)) {
            $functionName = strtolower($functionName);
            //echo 'another step down';
            $fileContents = rtrim($fileContents, '}');
            $newFunction = file_get_contents('./Library/Templates/pageFunction.php');
            $newFunction = str_replace('$$PageFunction$$', $functionName, $newFunction);
            $viewsName = $controllerName . '-' . $functionName;
            $newFunction = str_replace('$$PageFunctionPath$$', $viewsName, $newFunction);
            if ($includeHF == TRUE) {
                $newFunction = str_replace('$$PageInclude$$', 'TRUE', $newFunction);
            } else {
                $newFunction = str_replace('$$PageInclude$$', 'FALSE', $newFunction);
            }
            $newFunction .= ' }';
            if (strpos($fileContents, $newFunction)) {
                $view = new View;
                $view->e4041('Error: Sub Page Has Already Been Created');
                die();
            } else {
                $newFunction = $fileContents . $newFunction;
            }
            fwrite($filecreate, $newFunction);
            $filecreate = fopen('./Views/'.$viewsName.'.php', 'x') or die('Unable to open file!');
            fwrite($filecreate, $newPageContent);
        } elseif ($functionName !== NULL && isset($parameters)){
            //echo 'step 1';
            $functionName = strtolower($functionName);
            //echo 'another step down';
            $fileContents = rtrim($fileContents, '}');
            $newFunction = file_get_contents('./Library/Templates/pageParams.php');
            $newFunction = str_replace('$$PageFunction$$', $functionName, $newFunction);
            $viewsName = $controllerName . '-' . $functionName;
            $newFunction = str_replace('$$PageFunctionPath$$', $viewsName, $newFunction);
            if ($includeHF == TRUE) {
                $newFunction = str_replace('$$PageInclude$$', 'TRUE', $newFunction);
            } else {
                $newFunction = str_replace('$$PageInclude$$', 'FALSE', $newFunction);
            }
            $newFunction = str_replace('$$PageParams$$', $parameters, $newFunction);
            //echo 'step 2';
            $newFunction .= ' }';
            if (strpos($fileContents, $newFunction)) {
                $view = new View;
                $view->e4041('Error: Sub Page Has Already Been Created');
                die();
            } else {
                $newFunction = $fileContents . $newFunction;
            }
            fwrite($filecreate, $newFunction);
            $filecreate = fopen('./Views/'.$viewsName.'.php', 'x') or die('Unable to open file!');
            fwrite($filecreate, $newPageContent);
        } else {
            $view = new View;
            $view->e4041('Error: Page Has Already Been Created');
            die();
        }
    } else {
        $filecreate = fopen('./Controllers/'.$controllerName.'.php', 'w+') or die('Unable to open file!');
        if ($functionName == NULL) $template = file_get_contents('./Library/Templates/pageOneController.php');
        else $template = file_get_contents('./Library/Templates/pageTwoController.php');
        $controllerCaps = substr_replace($controllerName, strtoupper(substr($controllerName, 0, 1)), 0, 1);
        $text = str_replace('$$PageName$$', $controllerCaps, $template);
        $text = str_replace('$$PagePath$$', $controllerName, $text);
        if ($includeHF) {
            $text = str_replace('$$PageInclude$$', 'TRUE', $text);
        } else {
            $text = str_replace('$$PageInclude$$', 'FALSE', $text);
        }
        if ($functionName !== NULL) {
            $viewsName = $controllerName . '-' . $functionName;
            $text = str_replace('$$PageFunction$$', strtolower($functionName), $text);
            $text = str_replace('$$PageFunctionPath$$', $viewsName, $text);
            fwrite($filecreate, $text);
            $filecreate = fopen('./Views/'.$viewsName.'.php', 'w+') or die('Unable to open file!');
            fwrite($filecreate, $newPageContent);
        } else {
            fwrite($filecreate, $text);
            $filecreate = fopen('./Views/'.$controllerName.'.php', 'w+') or die('Unable to open file!');
            fwrite($filecreate, $newPageContent);
        }
        

    }
    $date = time();
    $conn->query("INSERT INTO pages (pageName, pagePath, createdOn, updatedOn, author) VALUES ('".$pageName."','".$pagePath."','".$date."','".$date."','Admin')");
    $cid = mysqli_insert_id($conn);
    if ($functionName == NULL) {
        $parentId = $cid;
    } else {
        $parentPath = '/'.$paths[0];
        $parentId = $conn->query("SELECT id FROM pages WHERE pagePath = '".$parentPath."'");
        $parentId = mysqli_fetch_assoc($parentId);
        $parentId = $parentId['id'];
    }
    $conn->query("UPDATE pages SET parentId = '".$parentId."' WHERE id = '".$cid."'");
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
        <li class="breadcrumb-item active">Add</li>
        </ol>
        <!-- End Breadcrumbs-->

        <div class="card mr-auto mt-4">
        <div class="card-header">Add Page</div>
        <div class="card-body pt-3">
        <form method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="page-name" name="page-name" placeholder="Page Name" class="form-control" required>
                <label for="page-name">Page Name</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="page-path" name="page-path" placeholder ="Path (i.e. /example)" class="form-control" required>
                <label for="page-path">Path</label>
              </div>
            </div>
            <div class="form-group">
                <textarea class="form-control animated" name="page-content" required placeholder="Page Content (code)"></textarea>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="include-hf" value="include-hf">
                  Include Header and Footer
                </label>
              </div>
            </div>
        <button type="submit" name="add-page" class="btn btn-primary">Add Page</button>
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