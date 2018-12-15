<!--The page to show when you click on a post/comments. The top of the post and the "comments" should take you to this page when clicked.-->
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
            padding: 5px;
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

        .adminicon {
            background-color: #F01111;
            display: inline-block;
            text-align: center;
            color: white;
            font-size: 15px;
            padding: 3px;
        }

        h1 .verifycheck, h1 .adminicon {
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
        .icon {
            width:250px;
        }
        .fixed-col {
            -ms-flex: 0 0 250px;
            flex: 0 0 250px;
        }
        @media screen and (max-width: 767px) {
            .pfp {
                width: 100px;
                height: 100px;
            }
        }
        .user-info h2 {
            color: #555555;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <!--full body page-->
    <h1>stucospacito but user profile</h1>
    <br>
    <div class="container-box rounded break-all">
        <div class="container-box">
            <div class="row">
                <div class="col-md fixed-col pfp-row">
                    <img class="pfp" src="https://is1-ssl.mzstatic.com/image/thumb/Purple71/v4/47/cf/cf/47cfcf79-9e1d-b21f-8e10-2658b7650c15/mzl.oiljceng.png/246x0w.jpg" height="200px" width="200px">
                </div>
                <div class="col-md user-info">
                    <h1>xXuser42069Xx <div class="adminicon square circle" style="width: 24px;"><i class="far fa-check-circle"></i></div></h1>
                    <h2>SLPSSCW Admin</h2>
                </div>
            </div>
            <div></div>
        </div>
    </div>
    <div class="alerts">
        <div class="alert alert-clone" role="alert">
            This is a danger alert—check it out!
        </div>
    </div>

    <script>
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
    </script>
</div>
</body>

</html>
