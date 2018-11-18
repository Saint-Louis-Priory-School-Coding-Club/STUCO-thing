<?php

?>
<form method="post" autocomplete="off">

<div class="col-md-12">

    
    <div class="form-group">
    <h2 class="">Sign Up:</h2>
    </div>
     
    <?php
    if (isset($errMSG)) {

        ?>
        <div class="form-group">
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" name="uname" class="form-control" placeholder="Username" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required/>
        </div>
    </div>

    <div class="checkbox">
        <label><input type="checkbox" required><a href="#">I agree with the terms of service</a></label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" name="signup">Sign Up</button>
    </div>

    <div class="form-group">
        <a class="btn btn-primary" href="?login">Login</a>
    </div>

</div>
</form>