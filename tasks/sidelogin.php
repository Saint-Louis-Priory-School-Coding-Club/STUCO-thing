<?php

?>
<form method="post" autocomplete="off">

<div class="col-md-12">

    
    <div class="form-group">
    <h2 class="">Login:</h2>
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
            <input type="email" name="email" class="form-control" placeholder="Email" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required/>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="login">Login</button>
    </div>

    <div class="form-group">
        <a class="btn btn-success" href="?signup">Sign Up</a>
    </div>

</div>
</form>