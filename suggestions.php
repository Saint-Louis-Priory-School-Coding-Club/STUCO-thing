<!--INFO:
I think you can also have custom html tags so there would be a post-id tag with the server's id for that post.
THIS IS REQUIRED! I USE "post-id" FOR THE REPORTING SCRIPT!
post should be expandable by clicking anywhere on it except report/upvote buttons.
all the upvote/downvote/comment numbers will be loaded into vars ONCE via php
javascript will modify the vars and tell the server via ajax. they won't update until next reload.
vote count is in a span with class .vote-number
comment count is in class .comment-number
x / check count is in class .check-number and .x-number
u/d vote have class .upvote, .upvoted, .downvote, or .downvoted depending on what type and class it is.
i set the min page width to around 640px (iphone 5 width) and max POST width (Not page) to 1000px
--When a post is reported, a submission to a php page (change in form near bottom) will be submitted with "reason" as the reason for reporting and "post-id" as the post id.
-->
<!--
Using Font Awesome instead of unicode, some icons look off since only some are avaliable without a pro liscence.
-->
<!--
Overflow (more than 400 char) is handled automatically by JS.
-->
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
        button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
        .post-body {
        	word-break: break-all; /* If this isn't here text can overflow  I'd need to make an annoying script to cut off large words. Don't want to do that.*/
        }
        .report-submit {
        	text-align:left;
        }
        .report-close {
        	text-align:right;
        }
        .post-top, .comment-c {
        	cursor: pointer;
        }
        .author {
            cursor: pointer;
        }
        .author:hover {
            color: #666;
        }
    </style>
</head>
<script>
    let link_format = "website.com/@"; // redirect format, replace @ with post id
    let user_format = "website.com/user/@" // redirect format, replace @ with user
</script>
<body>
<!-- first post will have full comments so you can see the inner workings -->
<!-- text classes:
< title tag broken for some reason >
.author : author of post
.post-body : content
.vote-number : upvote count
.comment-number : comment count
post body overflow is auto-handled, add code to prevent XSS attacks
on a div there is an attribute called "post-id". THIS IS REQUIRED. I use this id to make the submission for reporting. kbye
-->
<div class="container-fluid"> <!--full body page-->
    <h1>stucospacito<span class="glyphicon glyphicon-print"></span></h1>
    <br>
    <div class="post rounded" post-id="213534">
        <div class="row post-top">
            <div class="col-8"><h1>Attention All Gamers <span class="badge badge-secondary">Announcement</span></h1></div><div class="col-4 date"><h5>now</h5></div>
        </div>

        <h2>by <span class="author noselect" author-id="213213">Robert</span></h2>

        <div class="post-body-container"><p class="post-body">Attention all gamers, this website... is in grave danger and needs your help! Thanos is infecting the website with dead memes! All you need to do is remove Cedric from the GitHub repository so he can't add crap. But hurry! We haven't got much time!</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="uv-button upvote square rounded" style="width: 30px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">2</span> <div class="dv-button downvote square rounded" style="width: 30px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comments col-4"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">0</span> <span class="c-name">comments</span></div></div>
            <div class="report col-4"><div class="report-c"><button type="button" class="nobstyle" onclick="this.blur();report(this);" data-toggle="modal" data-target="#myModal"><i class="far fa-flag"></i> Report</button></div></div>
        </div>
    </div>

    <div class="post rounded" post-id="61346">
        <div class="row post-top">
            <div class="col-8"><h1>test <span class="badge badge-secondary">Test</span></h1></div><div class="col-4 date"><h5>2m ago</h5></div>
        </div>
        <h2>by <span class="author noselect" author-id="6969">memelord</span></h2>
        <div class="post-body-container"><p class="post-body">hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="uv-button upvote square rounded" style="width: 30px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">-2</span> <div class="dv-button downvoted square rounded" style="width: 30px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comments col-4"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">0</span> <span class="c-name">comments</span></div></div>
            <div class="report col-4"><div class="report-c"><button type="button" class="nobstyle" onclick="this.blur();report(this);" data-toggle="modal" data-target="#myModal"><i class="far fa-flag"></i> Report</button></div></div>
        </div>
    </div>

    <div class="post rounded" post-id="01240">
        <div class="row post-top ">
            <div class="col-8"><h1><div class="verifycheck square circle" style="width: 30px;"><i class="fas fa-check"></i></div> tespacito <span class="badge badge-secondary">Poll</span></h1></div><div class="col-4 date"><h5>2m ago</h5></div></div>
        <h2>by <span class="author noselect" author-id="12473">Stuco guy <div class="verifycheck square circle" style="width: 24px;"><i class="fas fa-check"></i></div></span></h2>
        <div class="post-body-container"><p class="post-body">hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="ux-button votechecked square rounded" style="width: 30px;"><i class="fas fa-check"></i></div> <span class="vote-number">432</span> <div class="dx-button votex square rounded" style="width: 30px;"><i class="fas fa-times"></i></div> <span class="x-number">1</span></div>
            <div class="comments col-4"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">0</span> <span class="c-name">comments</span></div></div>
            <div class="report col-4"><div class="report-c"><button type="button" class="nobstyle" onclick="this.blur();report(this);" data-toggle="modal" data-target="#myModal"><i class="far fa-flag"></i> Report</button></div></div>
        </div>
    </div>

    <div class="post rounded" post-id="12344">
        <div class="row post-top">
            <div class="col-8"><h1>fraf <span class="badge badge-secondary">Poll</span></h1></div><div class="col-4 date"><h5>2m ago</h5></div></div>
        <h2>by <span class="author noselect" author-id="124373">guy</span></h2>
        <div class="post-body-container"><p class="post-body">hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="ux-button votecheck square rounded" style="width: 30px;"><i class="fas fa-check"></i></div> <span class="vote-number">12</span> <div class="dx-button votexed square rounded" style="width: 30px;"><i class="fas fa-times"></i></div> <span class="x-number">2</span></div>
            <div class="comments col-4"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">1</span> <span class="c-name">comments</span></div></div>
            <div class="report col-4"><div class="report-c"><button type="button" class="nobstyle" onclick="this.blur();report(this);" data-toggle="modal" data-target="#myModal"><i class="far fa-flag"></i> Report</button></div></div>
        </div>
    </div>
	<!-- ONLY ALLOW REPORTING FOR LOGGIN USERS -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title">Report Post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="/action_page.php" id="report">
              <div class="form-group">
                <label for="email">Reason for Reporting:</label>
                <textarea name="reason" form="report" rows="4" cols="55">Enter reason here...</textarea>
                <input type="hidden" name="post-id" id="report-id" value="" />
              </div>
              
            </form>
          </div>
          <div class="modal-footer">
          <div class="container">
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-primary report-submit" form="report">Submit</button>
              </div>
              <div class="col report-close">
                <button type="button" class="btn btn-light" data-dismiss="modal" >Close</button>
              </div>
            </div>
          </div>
            
          </div>
        </div>

      </div>
    </div>
    <script>
    let reported_post = 0;
    let redirect = "";
        function togglemore(button) {
            button = $(button);
            button.parent().children(".post-body").children(".dotdotdot").toggleClass("gone");
            button.parent().children(".post-body").children(".show-more-txt").toggleClass("gone");
            if (button.html() === "Show More") {
            	button.html("Show Less");
            } else {
            	button.html("Show More");
            }
        }
        function report(button) {
        	button = $(button);
        	reported_post = $(button.parent().parent().parent().parent()).attr("post-id");
            $("#report-id").attr("value", reported_post);
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
    /*
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
        */
        $('.post-body-container').each(function() {  // for each .post-body
            let postbody = $(this).children(".post-body")[0];
            let leng = postbody.innerHTML.length;
            if (leng > 400) { // if more than 400 characters
                let html1 = postbody.innerHTML.slice(0, 400);  // slice off the first 400
                let html2 = postbody.innerHTML.slice(400, leng);
                let newhtml = "<p class=\"post-body\">" + html1 + "<b class=\"dotdotdot\">...</b><span class=\"show-more-txt gone\">" + html2 + "</span></p>" +
                    "<button type=\"button\" class=\"btn btn-sm btn-dark read-more\" onclick=\"togglemore(this)\">Show More</button>\n";
                $(this).html(newhtml);  // insert them with a show more button
            }
        });
        $('.author').click(function() { //redirect for clicking comments
            redirect = $(this).attr("author-id");
            let link = user_format.replace("@", redirect);
            window.location.href = link;
        });
          $('div.post-top').click(function() { //redirect for clicking top of post
            redirect = $($(this).parent()).attr("post-id");
            let link = link_format.replace("@", redirect);
            window.location.href = link;
          });
        $('div.comment-c').click(function() { //redirect for clicking comments
            redirect = $($(this).parent().parent().parent()).attr("post-id");
            let link = link_format.replace("@", redirect);
            window.location.href = link;
        });
        $('.uv-button').click(function() { //if upvote button clicked
            $(this).toggleClass("upvote").toggleClass("upvoted");
            let post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post updooted. Not used for this function but needed for AJAX folks
            let dv = $(this).parent().children(".dv-button")[0];
            dv = $(dv);
            if (dv.hasClass("downvoted")) {
                dv.removeClass("downvoted");
                dv.addClass("downvote");
            }
        });
        $('.dv-button').click(function() { //if downvote button clicked
            $(this).toggleClass("downvote").toggleClass("downvoted");
            let post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            let uv = $(this).parent().children(".uv-button")[0];
            uv = $(uv);
            if (uv.hasClass("upvoted")) {
                uv.removeClass("upvoted");
                uv.addClass("upvote");
            }
        });
        $('.ux-button').click(function() { //if upvote button clicked (ux is for up x, a check)
            $(this).toggleClass("votecheck").toggleClass("votechecked");
            let post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post updooted. Not used for this function but needed for AJAX folks
            let dv = $(this).parent().children(".dx-button")[0];
            dv = $(dv);
            if (dv.hasClass("votexed")) {
                dv.removeClass("votexed");
                dv.addClass("votex");
            }
        });
        $('.dx-button').click(function() { //if upvote button clicked (dx is for down x, an X)
            $(this).toggleClass("votex").toggleClass("votexed");
            let post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            let uv = $(this).parent().children(".ux-button")[0];
            uv = $(uv);
            if (uv.hasClass("votechecked")) {
                uv.removeClass("votechecked");
                uv.addClass("votecheck");
            }
        });

    </script>
</div>
</body>
</html>
