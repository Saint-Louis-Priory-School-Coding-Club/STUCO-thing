<?php 
header("Content-type: text/css");
if (!isset($upvotecolor)) {
    $upvotecolor = '#aaa';
}
if (!isset($downvotecolor)) {
    $downvotecolor = '#aaa';
}
?>
.post {
    display:block;
    margin: 20px 90px 20px 40px;
    padding: 10px 20px;
    background: #f8f8f8;
}
.post h1 {
    font-size:40px;
    margin-bottom: 0;
}
.post h2 {
    font-size:20px;
    color:#888;
}
.post h1 span {
    font-size:20px;
}
.post .post-options * {
    display:inline-block;
}
.post .post-options {
    font-size:20px;
    width:100%;
}
<?php echo'
.post .upvote {
    background: '.$upvotecolor.';
    color:white;
    text-align:center;
}
';?>

.voteup {
    background: #aaa;
    color:white;
    text-align:center;
    border: none;
    background-color: transparent;
}

.votedown {
    background: #aaa;
    color:white;
    text-align:center;
    border: none;
    background-color: transparent;
}

<?php echo'
.post .downvote {
    background: '.$downvotecolor.';
    color:white;
    text-align:center;
}
';?>
.date {
    float: right;
    color:#666;
}
.post .vote {
    text-align:left;
}
.post .comments {
    text-align: center;
}
.post .report {
    text-align:right;
}