<?php function url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
} ?>
<head>
  <style>
  h1 {
    color:red;
  }
  h2{
    color:red;
  }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="container">
        <br><br>
    <h1>Saint Louis Priory School Student Council Website</h1>
        <hr>
        <p><a href="/tasks">Tasks</a> and the <a href="/blog">Announcements</a> are complete.</p>
        <p>The <a href="/suggestions">Suggestions</a> page looks complete but has no working functions.</p>
        <p>Whoever originally designed this page commited a grave sin.</p>
        <h2>Priory Student Council</h2>
        <p id="welcome">Welcome to the official Priory STUCO website! As your representatives, we always try to listen to your suggestions and come up with new ideas to make highschool as fun as possible. To help us do this, go ahead and leave a suggestion; or if you want you can check out the Announcements page to see what new events are coming up.</p>
        <h4>Current STUCO Representatives:</h4>
        <ul>
        <li>
            <h6>Form VI</h6>
            <div class="table">
                <ul id="horizontal-list">
                <li><img src="<?php echo url();?>Library/StucoMembers/Preston.png"></li>
                <li><img src="<?php echo url();?>Library/StucoMembers/Matthew.png"></li>
                <li><img src="<?php echo url();?>Library/StucoMembers/Louis.png"></li>
                <li><img src="<?php echo url();?>Library/StucoMembers/Jack.png"></li>
                <li><img src="<?php echo url();?>Library/StucoMembers/Anthony.png"></li>
                </ul>
            </div>
        </li>
        <li>Form V</li>
        <li>Form IV</li>
        <li>Form III</li>
        </ul>
    </div>
</div>
</body>
