
<?php
$sql = $conn->query("SELECT * FROM ctask");
foreach ($sql as $ind) {
    $id = $ind['id'];
    $title = $ind['title'];
    $author = $ind['author'];
    $content = $ind['solution'];
    $sugid = $ind['suggestion_id'];
    $date = date("M d Y", $ind['date']);
    $smtp = $conn->query("SELECT * FROM suggestion WHERE id=$sugid");
    $res = mysqli_fetch_array($smtp, MYSQLI_ASSOC);
    $sugtitle = $res['title'];
    $sugauthor = $res['author'];
    $sugcontent = $res['content'];
    $sugdate = date("M d Y", $res['date']);
    echo '
    <div class="post rounded" id="'.$id.'">
    <div class="row">
    <div class="col-sm-8"><h1>'.$title.'&nbsp;</h1></div><div class="col-sm-4 date"><h5>'.$date.'</h5></div></div>
    <h2>by&nbsp;<span class="author">'.$author.'</span></h2>

        <div class="inpost rounded">
        	<div class="row">
            <div class="col-sm-8"><h2>'.$sugtitle.'&nbsp;</h2></div><div class="col-sm-4 date"><h6>'.$sugdate.'</h6></div></div>

            <h3>by&nbsp;<span class="author">'.$sugauthor.'</span></h3>

            <div class="inpost-body-container"><p class="inpost-body">'.$sugcontent.'<p></div>
        </div>

    <div class="post-body-container"><p class="post-body">'.$content.'<p>
    <!--<button type="button" class="btn btn-dark read-more">Show More</button>-->
    <p class="show-more-txt"></p>
    </div>
    <div class="post-options row noselect">
        <div class="comments col-sm-4"><i class="far fa-comments"></i><span class="comment-number">43</span>&nbsp;comments</div>
    </div>
</div>
<br>
    ';
}
?>