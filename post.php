<!--The page to show when you click on a post/comments. The top of the post and the "comments" should take you to this page when clicked.-->
<!DOCTYPE html>
<html lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
        body {
            background-color:#eee;
        }
        html {
            min-width:620px;
        }
        .post {
            display:block;
            margin: 20px 40px;
            padding: 10px 20px;
            background: #fff;
            max-width:1000px;
        }
        .post h1 {
            font-size:40px;
            margin-bottom: 5px;
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
            margin-bottom:5px;
        }
        .post .upvote {
            background: #eee;
            color:#ef9632;
            text-align:center;
        }
        .post .upvote:hover, .post .downvote:hover {
            background: #ddd;
        }
        .post .downvote {
            background: #eee;
            color:#7171ed;
            text-align:center;
        }
        .upvoted { /* already upvoted posts. replaces the .upvote class. */
            color: #eee;
            background:#ef9632;
            text-align:center;
        }
        .upvoted:hover {
            color: #eee;
            background:#ed8712;
            text-align:center;
        }
        .post .downvoted {
            color: #eee;
            background:#7171ed;
            text-align:center;
        }
        .post .downvoted:hover {
            color: #eee;
            background:#5959e5;
            text-align:center;
        }
        .post .votecheck {
            background: #eee;
            color:#41e03e;
            text-align:center;
        }
        .post .votecheck:hover, .post .votex:hover {
            background: #ddd;
        }
        .post .votex {
            background: #eee;
            color:#e03c2a;
            text-align:center;
        }
        .votechecked {
            color: #eee;
            background:#41e03e;
            text-align:center;
        }
        .votechecked:hover {
            background:#1fc91c;
        }
        .post .votexed {
            color: #eee;
            background:#e03c2a;
            text-align:center;
        }
        .post .votexed:hover {
            background:#cc2c1a;
        }
        .date {
            text-align: right;
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
        .noselect {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .verifycheck {
            background-color:#2fc5fc;
            display:inline-block;
            text-align:center;
            color:white;
            font-size:15px;
            padding:3px;
        }
        h1 .verifycheck {
            font-size:20px;
            transform:translate(0px,-5px);
        }
        .circle {
            border-radius:50%;
        }
        .read-more {
            margin-top:-10px;
            margin-bottom:10px;
        }
        .gone {
            display:none;
        }
        .show-more-txt {
            margin-top:-15px;
        }
        .comment-c, .report-c {
            border-radius:50px;
            padding: 0 10px;
        }
        .report-c:hover, .comment-c:hover {
            background-color: #ccc;
        }
        .line {
        	width:100%;
            height:3px;
            background-color:#ccc;
            margin: 15px 0;
        }
        .comment {
        	border-left: 3px solid #ccc;
            margin:5px;
            padding:5px;
        }
        h4 {
        	font-size:15px;
            color:grey;
        }
    </style>
</head>
<body>
<!-- first post will have full comments so you can see the inner workings -->
<!-- text classes:
< title tag broken for some reason >
.author : author of post
.post-body : content
.vote-number : upvote count
.comment-number : comment count
.comment-author : author of comment
.comment-reply-count : amount of replies
-->
<div class="container-fluid"> <!--full body page-->
    <h1>stucospacito but with the post</h1>
    <br>
    <div class="post rounded" id="post-0" post-id="213534">
        <div class="row">
            <div class="col-8"><h1>test <span class="badge badge-secondary">Test</span></h1></div><div class="col-4 date"><h5>2m ago</h5></div></div>

        <h2>by <span class="author">Anonymous</span></h2>

        <div class="post-body-container"><p class="post-body">hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="upvoted square rounded" style="width: 30px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">2</span> <div class="downvote square rounded" style="width: 30px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comments col-4"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">0</span> <span class="c-name">comments</span></div></div>
            <div class="report col-4"><div class="report-c"><i class="far fa-flag"></i> Report</div></div>
        </div>
        <div class="line"></div>
        <div class="full-comments"></div>
        <h3>Comments</h3>
        <div class="comment">
        	<h4>By <span class="comment-author">yeet</span> | 2m ago | <span class="comment-reply-count">3</span> <i class="far fa-comments"></i></h4>
            <p class="comment-body">oof</p>
            <div class="upvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">2</span> <div class="downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div>
        </div>
    </div>
</div>

    <script>
        function togglemore(button) {
            button = $(button);
            button.parent().children(".post-body").children(".dotdotdot").toggleClass("gone");
            button.parent().children(".post-body").children(".show-more-txt").toggleClass("gone");
            if (button.html() == "Show More") {
            	button.html("Show Less");
            } else {
            	button.html("Show More");
            }
        }
        $('.comment-number').each(function() {  // for each .comment number
        	if ($(this).html() == "1") {  // if there is exactly 1 comment
            	$(this).parent().children(".c-name").html("comment");
            }
        });
        $('.square').each(function() {  // for each .square
            $(this).width($(this).height());  // set the width to the height
        });
        // FUNCTION MIGHT NOT BE NEEDED:
        $('.post-body').each(function() { // last resort XSS preventer
            var orig = $(this).html();  // original text
            var newtxt = "";  // fixed text
            var char = "";
            for (var i = 0; i < orig.length; i++) {
                char = orig.charAt(i);  // character
                if (char == "<") {
                    char = "&lt;";
                }
                newtxt += char;
            }
            $(this).html(newtxt);
        });
        
    </script>
</div>
</body>
</html>

