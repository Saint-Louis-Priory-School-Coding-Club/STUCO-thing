<head>
  <style>
      h1 {
        color:red;
      }
      h2{
        color:red;
      }
      .stuco-member {
          margin: 15px 0;
          padding: 10px;
          background: #efefef;
          border-radius: 10px;
          text-align: center;
      }
      .name {
          font-size: 18px;
          font-weight: bold;
      }
      .form {
          font-size:12px;
      }
      .stuco-desc {
          margin: 5px 0;
      }
      @media only screen and (min-width: 640px) {
          .container-fluid {
              padding:0 100px;
          }
      }
      .abb {
          color:red;
          font-size: 14px;
      }
      .welcome{
        font-size:20px;
      }
  </style>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
</head>

<body>
<br>
  <div class="container-fluid">
    <h1>Saint Louis Priory School Student Council Website<span class="abb"> (SaLPSchoStuCoW or Salpscostucow)</span></h1>
    <hr>
    <h2>Coding Club Ramblings™</h2>
    <p><a href="/tasks">Tasks</a> and the <a href="/blog">Announcements</a> are complete.</p>
    <p>The <a href="/suggestions">Suggestions</a> page looks complete but has no working functions.</p>
    <p>Whoever originally designed this page commited a grave sin.</p>
    <h2>Priory Student Council</h2>
    <p class="welcome">Welcome to the official Priory STUCO website! As your representatives, <br />
      we always try to listen to your suggestions and come up with new ideas to make <br />
      highschool as fun as possible. To help us do this, go ahead and leave a suggestion; <br />
      or if you want you can check out the Announcements page to see what new events are coming up.</p>
    <h4>Current STUCO Representatives:</h4>
    <div class="grid">
        <div class="grid-item stuco-member">
            <img src="<?php echo __URL;?>Library/StucoMembers/Preston.png">
            <hr>
            <p class="stuco-desc"><span class="name">Preston</span> <span class="form">Form VI</span></p>
        </div>
        <div class="grid-item stuco-member">
            <img src="<?php echo __URL;?>Library/StucoMembers/Matthew.png">
            <hr>
            <p class="stuco-desc"><span class="name">Matthew</span> <span class="form">Form VI</span></p>
        </div>
        <div class="grid-item stuco-member">
            <img src="<?php echo __URL;?>Library/StucoMembers/Louis.png">
            <hr>
            <p class="stuco-desc"><span class="name">Louis</span> <span class="form">Form VI</span></p>
        </div>
        <div class="grid-item stuco-member">
            <img src="<?php echo __URL;?>Library/StucoMembers/Jack.png">
            <hr>
            <p class="stuco-desc"><span class="name">Jack</span> <span class="form">Form VI</span></p>
        </div>
        <div class="grid-item stuco-member">
            <img src="<?php echo __URL;?>Library/StucoMembers/Anthony.png">
            <hr>
            <p class="stuco-desc"><span class="name">Anthony</span> <span class="form">Form VI</span></p>
        </div>
    </div>
</div>
<script>
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 250
    });
</script>
</body>
