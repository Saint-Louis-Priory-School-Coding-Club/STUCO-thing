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
        .post .post-options *, .comment-options * {
            display:inline-block;
        }
        .post .post-options {
            font-size:20px;
            width:100%;
            margin-bottom:5px;
        }
        .upvote {
            background: #eee;
            color:#ef9632;
            text-align:center;
        }
        .upvote:hover, .post .downvote:hover {
            background: #ddd;
        }
        .downvote {
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
        .votecheck {
            background: #eee;
            color:#41e03e;
            text-align:center;
        }
        .votecheck:hover, .post .votex:hover {
            background: #ddd;
        }
        .votex {
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
        .vote {
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
            margin-top:-20px;
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
            margin-bottom:10px;
        }
        h4 {
        	font-size:15px;
            color:grey;
        }
        .margin {
        	margin-top:10px;
        }
        .comment-body-container {
        	word-break: break-all;
        }
        .btn-xs {
        	font-size:12px;
        }
        .post-body {
        	word-break: break-all; /* If this isn't here text can overflow  I'd need to make an annoying script to cut off large words. Don't want to do that.*/
        }
        .noastyle, .noastyle:hover {
            color: black;
        }
        .nobstyle {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
        .report-submit {
            text-align:left;
        }
        .report-close {
            text-align:right;
        }
        .author, .comment-author {
            cursor: pointer;
        }
        .author:hover, .comment-author:hover {
            color: #666;
        }
        .read-more {
        	font-size:14px;
        	color: #888;
        }
        .read-more:hover {
        	font-size:14px;
        	color: #666;
        	text-decoration:underline;
        }
                .alert {
        	position:fixed;
            bottom:-60px;
            width:95%;
            margin: 10px auto;
            left: 0;
            right: 0;
            -webkit-transition: bottom 0.5s; /* Safari */
    		transition: bottom 0.5s;
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
comment-id= server id of comment
post-id server id of post
same upvote/downvote mechanics as a regular post
---add a comment if you need age/date made in a div.---
--structure of a comment (since w3 tryit doesn't make for neat looking code)
<div class="comment">  # comment
	--comment contents--
    
    <div class="comment replies">  # replies (if any) to the comment
      <div class="comment">  # comment
        --comment contents--
        
        <div class="comment replies">  # replies (if any) to the comment
			# this comment has no replies
        </div>
	  </div>
    </div>
</div>
idea for how to store in database:
store post and comment replying to. If the comment is replying to the post directly, have it store "0"
list out each comment matching the post-id and comment-reply of 0. Then for each list out each comment replying to that... bla bla bla have some recursive loop thing until all comments have no replies or replies listed. idk i'm not an expert with back end
-->
<script>
    let user_format = "website.com/user/@" // redirect format, replace @ with user
</script>
<div class="container-fluid"> <!--full body page-->
    <h1>stucospacito but with the post</h1>
    <br>
    <div class="post rounded" post-id=65>
        <div class="row">
            <div class="col-8"><h1>test <span class="badge badge-secondary">Test</span></h1></div><div class="col-4 date"><h5>2m ago</h5></div></div>

        <h2>by <span class="author noselect" author-id="12421">someone cool</span></h2>

        <div class="post-body-container"><p class="post-body">hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user hello i am a user</p></div>
        <div class="post-options row noselect">
            <div class="vote col-4"><div class="uv-button upvoted square rounded" style="width: 30px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">2</span> <div class="dv-button downvote square rounded" style="width: 30px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comments col-4"><a href="#comments" class="noastyle"><div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">6</span> <span class="c-name">comments</span></div></a></div>
            <div class="report col-4"><div class="report-c"><button type="button" class="nobstyle" onclick="this.blur();report(this);" data-toggle="modal" data-target="#myModal"><i class="far fa-flag"></i> Report</button></div></div>
        </div>
        <div class="line" id="comments"></div>
        <div class="full-comments"></div>
        <h3>Comments</h3>
        <div class="comment" comment-id=27172>
        	<h4>By <span class="comment-author noselect" author-id="12345">yeet</span> | 2m ago | <span class="comment-reply-count">4</span> <i class="far fa-comments"></i></h4>
            <div class="comment-body-container"><p class="comment-body">lol</p></div>
            <div class="comment-options"><div class="uv-button upvote square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">-7.9k</span> <div class="dv-button downvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comment-replies">
                  <div class="comment" comment-id=1234>
              <h4>By <span class="comment-author noselect" author-id="12345">Stuco Guy <div class="verifycheck square circle"><i class="fas fa-check"></i></div></span> | now | <span class="comment-reply-count">1</span> <i class="far fa-comments"></i></h4>
              <div class="comment-body-container"><p class="comment-body">lol</p></div>
              <div class="comment-options"><div class="uv-button upvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">1.2k</span> <div class="dv-button downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
              <div class="comment-replies">
				<div class="comment" comment-id=12213>
                <h4>By <span class="comment-author noselect" author-id="12345">an_dude4</span> | 1m ago | <span class="comment-reply-count">0</span> <i class="far fa-comments"></i></h4>
                <div class="comment-body-container"><p class="comment-body">lol</p></div>
                <div class="comment-options"><div class="uv-button upvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">174k</span> <div class="dv-button downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
                <div class="comment-replies">

              </div>
              </div>
              </div>
              </div>
              <div class="comment" comment-id=4321>
              <h4>By <span class="comment-author noselect" author-id="12345">who</span> | 11/26/2018 | <span class="comment-reply-count">1</span> <i class="far fa-comments"></i></h4>
              <div class="comment-body-container"><p class="comment-body">lol</p></div>
              <div class="comment-options"><div class="uv-button upvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">5</span> <div class="dv-button downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
              <div class="comment-replies">
                                <div class="comment" comment-id=12213>
                <h4>By <span class="comment-author noselect" author-id="12345">fortnite_Gamer69</span> | 13h ago | <span class="comment-reply-count">0</span> <i class="far fa-comments"></i></h4>
                <div class="comment-body-container"><p class="comment-body">lol</p></div>
                <div class="comment-options"><div class="uv-button upvoted square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">3</span> <div class="dv-button downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
                <div class="comment-replies">

              </div>
              </div>
              </div>
            </div>
        </div>
        </div>
        <div class="comment" comment-id=27172>
        	<h4>By <span class="comment-author noselect" author-id="12345">someone445</span> | 2m ago | <span class="comment-reply-count">0</span> <i class="far fa-comments"></i></h4>
            <div class="comment-body-container"><p class="comment-body">lollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollolloollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollolloollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollolloollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollolloollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollollol</p></div>
            <div class="comment-options"><div class="uv-button upvote square rounded" style="width: 20px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">34</span> <div class="dv-button downvote square rounded" style="width: 20px;"><i class="fas fa-arrow-down"></i></div></div>
            <div class="comment-replies">
            	
            </div>
            </div>
</div>
    <div class="alerts">
    	<div class="alert alert-clone" role="alert">
  			This is a danger alert—check it out!
		</div>
	</div>
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

    <script>
        let reported_post = 0;
        function report(button) {
            button = $(button);
            reported_post = $(button.parent().parent().parent().parent()).attr("post-id");
            $("#report-id").attr("value", reported_post);
        }
        function htmlalert(type, text) { //custom HTML alert
        	let alert = $(".alert-clone").clone(true).appendTo(".alerts");  //clone alert template
        	setTimeout(function() {
    			alert.addClass(type); // add class "type", bootstrap alert type
				alert.html(text);  // change text to "text"
            	alert.css("bottom","0");  //move up
            	setTimeout(function() {
				    alert.css("bottom","-60px");  // move down
				    setTimeout(function() {
				    	alert.remove(); // delete alert
					}, 2000)
				}, 3000)
			}, 100)	
        }
        function togglemore(button) {
            button = $(button);
            button.parent().children(".dotdotdot").toggleClass("gone");
            button.parent().children(".show-more-txt").toggleClass("gone");
            if (button.html() == "Show More") {
            	button.html("Show Less");
            } else {
            	button.html("Show More");
            }
        }
        $('.comment-number').each(function() {  // for each .comment number
        	if ($(this).html() === "1") {  // if there is exactly 1 comment
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
        $('.comment-replies').each(function() {  // for each .comment reply container
            if ($(this).html().trim() !== "") {  // if there are replies
            	$(this).addClass("margin"); // add a margin below updoot button
            }
        });
        $('.comment-body-container').each(function() {  // for each .post-body
            let inner = $(this).children(".comment-body")[0];
            let leng = inner.innerHTML.length;
            if (leng > 200) { // if more than 400 characters
                let html1 = inner.innerHTML.slice(0, 200);  // slice off the first 400
                let html2 = inner.innerHTML.slice(200, leng);
                let newhtml = "<p class=\"comment-body\">" + html1 + "<b class=\"dotdotdot\">...</b><span class=\"show-more-txt gone\">" + html2 + "</span> <button type=\"button\" class=\"nobstyle read-more\" onclick=\"togglemore(this)\">Show More</button></p>\n";
                $(this).html(newhtml);  // insert them with a show more button
            }
        });
        $('.author').click(function() { //redirect for clicking comments
            redirect = $(this).attr("author-id");
            let link = user_format.replace("@", redirect);
            window.location.href = link;
        });
        $('.comment-author').click(function() { //redirect for clicking comments
            redirect = $(this).attr("author-id");
            let link = user_format.replace("@", redirect);
            window.location.href = link;
        });
        $('.uv-button').click(function() { //if upvote button clicked
        	let originally_voted = false;
            $(this).toggleClass("upvote").toggleClass("upvoted");
            let post_clicked = "none";
            if ($(this).parent().hasClass("comment-options")) {
                post_clicked = $(this).parent().parent().attr("comment-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            } else {
                post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            }
            let dv = $(this).parent().children(".dv-button")[0];
            dv = $(dv);
            if (dv.hasClass("downvoted")) {
                dv.removeClass("downvoted");
                dv.addClass("downvote");
                originally_voted = true;
            }
            let ajax_response = false;
            let ajax_vote = "12";
            if (ajax_response === false) {
            	htmlalert("alert-danger", "Failed to upvote.");
            	$(this).toggleClass("upvote").toggleClass("upvoted");
            	if (originally_voted) {
            		dv.toggleClass("downvoted").toggleClass("downvote");
            	}

            } else {
            	$(this).parent().children(".vote-number")[0].innerHTML = ajax_vote;
            }
        });
        $('.dv-button').click(function() { //if downvote button clicked
        	let originally_voted = false;
            $(this).toggleClass("downvote").toggleClass("downvoted");
            let post_clicked = "none";
            if ($(this).parent().hasClass("comment-options")) {
                post_clicked = $(this).parent().parent().attr("comment-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            } else {
                post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            }
            let uv = $(this).parent().children(".uv-button")[0];
            uv = $(uv);
            if (uv.hasClass("upvoted")) {
                uv.removeClass("upvoted");
                uv.addClass("upvote");
                originally_voted = true;
            }
            let ajax_response = true; // True if succesful, false if failed. set with ajax response
            let ajax_vote = "420";
            if (ajax_response === false) {
            	htmlalert("alert-danger", "Failed to downvote.");
            	$(this).toggleClass("downvote").toggleClass("downvoted");
            	if (originally_voted) {
            		uv.toggleClass("upvoted").toggleClass("upvote");
            	}

            } else {
            	$(this).parent().children(".vote-number")[0].innerHTML = ajax_vote;
            }
        });
        $('.ux-button').click(function() { //if upvote button clicked (ux is for up x, a check)
        	let originally_voted = false;
            $(this).toggleClass("votecheck").toggleClass("votechecked");
            let post_clicked = "none";
            if ($(this).parent().hasClass("comment-options")) {
                post_clicked = $(this).parent().parent().attr("comment-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            } else {
                post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            }
            let dv = $(this).parent().children(".dv-button")[0];
            dv = $(dv);
            if (dv.hasClass("votexed")) {
                dv.removeClass("votexed");
                dv.addClass("votex");
                originally_voted = true;
            }
            let ajax_response = true;
            let ajax_vote = "420";
            if (ajax_response === false) {
            	htmlalert("alert-danger", "Failed to check.");
            	$(this).toggleClass("votecheck").toggleClass("votechecked");
            	if (originally_voted) {
            		dv.toggleClass("votex").toggleClass("votexed");
            	}

            } else {
            	$(this).parent().children(".vote-number")[0].innerHTML = ajax_vote;
            }
        });
        $('.dx-button').click(function() { //if upvote button clicked (dx is for down x, an X)
        	let originally_voted = false;
            $(this).toggleClass("votex").toggleClass("votexed");
            let post_clicked = "none";
            if ($(this).parent().hasClass("comment-options")) {
                post_clicked = $(this).parent().parent().attr("comment-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            } else {
                post_clicked = $(this).parent().parent().parent().attr("post-id"); // ID of post unupdooted. Not used for this function but needed for AJAX folks
            }
            let dv = $(this).parent().children(".dv-button")[0];
            dv = $(dv);
            if (dv.hasClass("votechecked")) {
                dv.removeClass("votechecked");
                dv.addClass("votecheck");
                originally_voted = true;
            }
            let ajax_response = true;
            let ajax_vote = "420";
            if (ajax_response === false) {
            	htmlalert("alert-danger", "Failed to X.");
            	$(this).toggleClass("votex").toggleClass("votexed");
            	if (originally_voted) {
            		dv.toggleClass("votecheck").toggleClass("votechecked");
            	}

            } else {
            	$(this).parent().children(".vote-number")[0].innerHTML = ajax_vote;
            }
        });
    </script>
</div>
</body>
</html>
