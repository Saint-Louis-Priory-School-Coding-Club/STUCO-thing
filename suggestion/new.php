<!--The page to show when you click on a post/comments. The top of the post and the "comments" should take you to this page when clicked.-->
<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    </style>
</head>

<body>
    <?php include '../header.php'?>
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
        let title_len = 50
        let body_len = 2000;
        // max length for each
    </script>
    <div class="container-fluid">
        <!--full body page-->
        <br>
        <div class="container-box rounded">
            <h1>Create a new Suggestion</h1>
            <form action="/action_page.php" method="POST" class="">
                <div class="form-group row">
                    <label for="title">Title:</label>
                    <input required maxlength=0 type="text" class="form-control form-control-lg title-form" placeholder="Title" name="title" id="title">
                    <label for="content">Content:</label>
                    <textarea required maxlength=0 class="form-control content-form" rows="5" id="content" name="content"></textarea>
                    <label for="flair">Select flair:</label>
                    <select required class="form-control" id="flair" name="flair">
                        <option>Suggestion</option>
                        <option>Poll</option>
                        <option>Discussion</option>
                        <option>Something Else</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
