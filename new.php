<!--The page to show when you click on a post/comments. The top of the post and the "comments" should take you to this page when clicked.-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>home - an website 6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <style>
        body {
            background-color: #eee;
        }

        html {
            min-width: 620px;
        }

        .container-box {
            display: block;
            margin: 20px 40px;
            padding: 10px 20px;
            background: #fff;
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
            background-color: #2fc5fc;
            display: inline-block;
            text-align: center;
            color: white;
            font-size: 15px;
            padding: 3px;
        }

        h1 .verifycheck {
            font-size: 20px;
            transform: translate(0px, -5px);
        }

        .circle {
            border-radius: 50%;
        }

        .break-all {
            word-break: break-all;
            /* If this isn't here text can overflow  I'd need to make an annoying script to cut off large words. Don't want to do that.*/
        }

        .noastyle,
        .noastyle:hover {
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

        .alert {
            position: fixed;
            bottom: -60px;
            width: 95%;
            margin: 10px auto;
            left: 0;
            right: 0;
            -webkit-transition: bottom 0.5s;
            /* Safari */
            transition: bottom 0.5s;
        }

        form {
            padding: 10px 20px 0 10px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        body {
            background-color: #eee;
        }

        body {
            background-color: #eee;
        }

        html {
            min-width: 620px;
        }

        .post {
            display: block;
            margin: 20px 40px;
            padding: 10px 20px;
            background: #fff;
            max-width: 1000px;
        }

        .post h1 {
            font-size: 40px;
            margin-bottom: 5px;
        }

        .post h2 {
            font-size: 20px;
            color: #888;
        }

        .post h1 span {
            font-size: 20px;
        }

        .post .post-options * {
            display: inline-block;
        }

        .post .post-options {
            font-size: 20px;
            width: 100%;
            margin-bottom: 5px;
        }

        .post .upvote {
            background: #eee;
            color: #ef9632;
            text-align: center;
        }

        .post .upvote:hover,
        .post .downvote:hover {
            background: #ddd;
        }

        .post .downvote {
            background: #eee;
            color: #7171ed;
            text-align: center;
        }

        .upvoted {
            /* already upvoted posts. replaces the .upvote class. */
            color: #eee;
            background: #ef9632;
            text-align: center;
        }

        .upvoted:hover {
            color: #eee;
            background: #ed8712;
            text-align: center;
        }

        .post .downvoted {
            color: #eee;
            background: #7171ed;
            text-align: center;
        }

        .post .downvoted:hover {
            color: #eee;
            background: #5959e5;
            text-align: center;
        }

        .post .votecheck {
            background: #eee;
            color: #41e03e;
            text-align: center;
        }

        .post .votecheck:hover,
        .post .votex:hover {
            background: #ddd;
        }

        .post .votex {
            background: #eee;
            color: #e03c2a;
            text-align: center;
        }

        .votechecked {
            color: #eee;
            background: #41e03e;
            text-align: center;
        }

        .votechecked:hover {
            background: #1fc91c;
        }

        .post .votexed {
            color: #eee;
            background: #e03c2a;
            text-align: center;
        }

        .post .votexed:hover {
            background: #cc2c1a;
        }

        .date {
            text-align: right;
            color: #666;
        }

        .post .vote {
            text-align: left;
        }

        .post .comments {
            text-align: center;
        }

        .post .report {
            text-align: right;
        }

        .noselect {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .verifycheck {
            background-color: #2fc5fc;
            display: inline-block;
            text-align: center;
            color: white;
            font-size: 15px;
            padding: 3px;
        }

        h1 .verifycheck {
            font-size: 20px;
            transform: translate(0px, -5px);
        }

        .circle {
            border-radius: 50%;
        }

        .read-more {
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .gone {
            display: none;
        }

        .show-more-txt {
            margin-top: -15px;
            margin-bottom: 10px;
        }

        .comment-c,
        .report-c {
            border-radius: 50px;
            padding: 0 10px;
        }

        .report-c:hover,
        .comment-c:hover {
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
            word-wrap: break-word;
            overflow: hidden;
        }

        .report-submit {
            text-align: left;
        }

        .report-close {
            text-align: right;
        }

        .post-top,
        .comment-c {
            cursor: pointer;
        }

        .author {
            cursor: pointer;
        }

        .author:hover {
            color: #666;
        }

        .alert {
            position: fixed;
            bottom: -60px;
            width: 95%;
            margin: 10px auto;
            left: 0;
            right: 0;
            -webkit-transition: bottom 0.5s;
            /* Safari */
            transition: bottom 0.5s;
        }

        .attachment {
            margin-bottom: 10px;
        }

        .attachment i {
            font-size: 30px;
        }

        .attachment-link {
            color: black;
        }

        .attachment-link:hover {
            color: #888;
            text-decoration: none;
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
--structure of a comment (since w3 tryit doesn't make for neat looking code)--
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
        let title_len = 40;
        let body_len = 2000;
        // max length for each
    </script>
    <div class="container-fluid" ng-app="">
        <!--full body page-->
        <h1>stucospacito but new post owo</h1>
        <br>
        <div class="container-box rounded">
            <h1>Create a new Post</h1>
            <form action="/action_page.php" method="POST" class="">
                <div class="form-group row">
                    <label for="title">Title:</label>
                    <input ng-model="title" required maxlength=0 type="text" class="form-control form-control-lg title-form" placeholder="Title" name="title" id="title">
                    <small class="form-text text-muted">Keep the title short, sweet, and right to the point.</small>
                </div>
                <div class="form-group row">
                    <label for="content">Content:</label>
                    <textarea ng-model="content" required maxlength=0 class="form-control content-form" rows="5" id="content" name="content"></textarea>
                    <small class="form-text text-muted">Everything else goes in this box.</small>
                </div>
                <div class="form-group row">
                    <label for="flair">Select flair:</label>
                    <select ng-required="true" ng-model="flair" required class="form-control" id="flair" name="flair">
                        <option selected="selected">Suggestion</option>
                        <option>Poll</option>
                        <option>Discussion</option>
                        <option>Meme</option>
                    </select>
                    <small class="form-text text-muted">What type of post is this?</small>
                </div>
                <div class="form-group row">
                    <label for="exampleInputFile">File input</label>
                    <input autocomplete="off" ng-model="attachment" maxlength=100 type="text" class="form-control file-form" placeholder="File URL" name="file" id="file">
                    <small id="fileHelp" class="form-text text-muted">An optional attachment to be shown below your post. Upload file to dropbox or imgur and paste the DIRECT link here.</small>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

        </div>
        <div class="post container-box rounded" post-id="213534">
            <div class="row post-top">
                <div class="col-8">
                    <h1>{{title}} <span class="badge badge-secondary">{{flair}}</span></h1></div>
                <div class="col-4 date">
                    <h5>now</h5></div>
            </div>

            <h2>by <span class="author noselect">You</span></h2>

            <div class="post-body-container">
                <p class="post-body">{{content}}</p>
            </div>
            <div class="attachment" id="attachment"></div>
            <!--attachment for post. Simply insert link and it checks if it exists and auto makes link and such-->
            <div class="post-options row noselect">
                <div class="vote col-4">
                    <div class="uv-button upvote square rounded" style="width: 30px;"><i class="fas fa-arrow-up"></i></div> <span class="vote-number">0</span>
                    <div class="dv-button downvote square rounded" style="width: 30px;"><i class="fas fa-arrow-down"></i></div>
                </div>
                <div class="comments col-4">
                    <div class="comment-c"><i class="far fa-comments"></i> <span class="comment-number">0</span> <span class="c-name">comments</span></div>
                </div>
                <div class="report col-4">
                    <div class="report-c">
                        <i class="far fa-flag"></i> Report
                    </div>
                </div>
            </div>
        </div>
        <div class="alerts">
            <div class="alert alert-clone" role="alert">
                This is a danger alert—check it out!
            </div>
        </div>

        <script>
            $(".content-form").attr("maxlength", body_len);
            $(".title-form").attr("maxlength", title_len);

            function htmlalert(type, text) { //custom HTML alert
                let alert = $(".alert-clone").clone(true).appendTo(".alerts"); //clone alert template
                setTimeout(function() {
                    alert.addClass(type); // add class "type", bootstrap alert type
                    alert.html(text); // change text to "text"
                    alert.css("bottom", "0"); //move up
                    setTimeout(function() {
                        alert.css("bottom", "-60px"); // move down
                        setTimeout(function() {
                            alert.remove(); // delete alert
                        }, 2000)
                    }, 3000)
                }, 100)
            }
            $('.square').each(function() { // for each .square
                $(this).width($(this).height()); // set the width to the height
            });
            $('.post-body-container').each(function() { // for each .post-body
                let postbody = $(this).children(".post-body")[0];
                let leng = postbody.innerHTML.length;
                if (leng > 400) { // if more than 400 characters
                    let html1 = postbody.innerHTML.slice(0, 400); // slice off the first 400
                    let html2 = postbody.innerHTML.slice(400, leng);
                    let newhtml = "<p class=\"post-body\">" + html1 + "<b class=\"dotdotdot\">...</b><span class=\"show-more-txt gone\">" + html2 + "</span></p>" +
                        "<button type=\"button\" class=\"btn btn-sm btn-dark read-more\" onclick=\"togglemore(this)\">Show More</button>\n";
                    $(this).html(newhtml); // insert them with a show more button
                }
            });

            function executeOnChange() {
                if ($(this).val() == "Poll") {
                    $(".vote").html("<div class=\"ux-button votecheck square rounded\" style=\"width: 30px;\"><i class=\"fas fa-check\"></i></div> <span class=\"vote-number\">0</span> <div class=\"dx-button votexed square rounded\" style=\"width: 30px;\"><i class=\"fas fa-times\"></i></div> <span class=\"x-number\">0</span></div>");
                } else {
                    $(".vote").html("<div class=\"uv-button upvote square rounded\" style=\"width: 30px;\"><i class=\"fas fa-arrow-up\"></i></div> <span class=\"vote-number\">0</span> <div class=\"dv-button downvote square rounded\" style=\"width: 30px;\"><i class=\"fas fa-arrow-down\"></i></div>");

                }
            }
            if (!Array.prototype.last) {
                Array.prototype.last = function() {
                    return this[this.length - 1];
                };
            };

            function isFile(pathname) {
                return pathname.split('/').pop().indexOf('.') > -1;
            }

            function executeOnChange2() { // for each .attachment
                let link = $("#file").val();
                let new_content = "";
                if (link != "") {
                    if (isFile(link)) { // if file exists (checks for 404) prefix is for CORS proxy
                        let file_name = link.split("/").last().replace("%20", " ");
                        if (file_name.match(/\.(jpeg|jpg|gif|png)$/) != null) {
                            new_content = "far fa-file-image";
                        } else if (file_name.match(/\.(flv|avi|mov|mp4|mpg|mwv|3gp|asf|rm|swf)$/) != null) {
                            new_content = "far fa-file-video";
                        } else if (file_name.match(/\.(mp3|wav|pcm|aiff|aac|ogg|wma|flac|alac|wma)$/) != null) {
                            new_content = "far fa-file-audio";
                        } else if (file_name.match(/\.(doc|dot|wbk|docx|dotx|dotm|docb)$/) != null) {
                            new_content = "far fa-file-word";
                        } else if (file_name.match(/\.(pdf)$/) != null) {
                            new_content = "far fa-file-pdf";
                        } else if (file_name.match(/\.(asp|aspx|axd|asx|asmx|ashx|css|cfm|yaws|swf|html|htm|xhtml|jhtml|jsp|jspx|wss|do|action|java|js|pl|php|py|rb|xml|c|cpp|cs|exe)$/) != null) {
                            new_content = "far fa-file-code";
                        } else if (file_name.match(/\.(zip|rar|7z|tar)$/) != null) {
                            new_content = "far fa-file-archive";
                        } else if (file_name.match(/\.(pptx|pptm|ppt|potx|potm|pot|ppsx)$/) != null) {
                            new_content = "far fa-file-powerpoint";
                        } else if (file_name.match(/\.(csv)$/) != null) {
                            new_content = "far fa-file-csv";
                        } else if (file_name.match(/\.(xls|xlsm|xlsx|xltx|xlw)$/) != null) {
                            new_content = "far fa-file-excel";
                        } else if (file_name.match(/\.(txt|rtf|log|readme|md)$/) != null) {
                            new_content = "far fa-file-alt";
                        } else {
                            new_content = "far fa-file";
                        }
                        new_content = "<a href=" + link + " class=\"attachment-link\" target=\"_blank\"><i class=\"" + new_content + "\"></i> " + file_name + "</a>";
                    } else {
                        new_content = "<a href=" + link + " class=\"attachment-link no-exist\" target=\"_blank\"><i class=\"fas fa-exclamation-circle\"></i> File does not exist!</a>";
                    }

                    $("#attachment").html(new_content);
                }

                //doesFileExist("https://cors-proxy.htmldriven.com/?url=" + link)
            }
            $(function() { // wait for DOM to be ready before trying to bind...
                $('#flair').change(executeOnChange);
                $('#file').change(executeOnChange2);
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
        </script>
    </div>
</body>

</html>
