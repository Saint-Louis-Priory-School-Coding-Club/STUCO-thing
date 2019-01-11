<?php
class View {

    function __construct() {



    }

    public function render($path, $includeHeader = TRUE, $vartopass = NULL) {
        if ($vartopass !== NULL) {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (is_array($vartopass)) {
                foreach ($vartopass as $key => $ind) {
                    $_SESSION[$key] = $ind;
                }
            } else {
                die('passed variable is not an array');
            }
        }
        if ($includeHeader == TRUE) {

            require_once './Library/dbconnect.php';
            require_once './Views/header.php';
            require_once $path.'.php';
            require_once './Views/footer.php';

        } else {
            require_once './Library/dbconnect.php';
            require_once $path.'.php';

        }
        if ($vartopass !== NULL) {
            if (is_array($vartopass)) {
                foreach ($vartopass as $key => $ind) {
                    unset($_SESSION[$key]);
                }
            } else {
                die('passed variable is not an array');
            }
        }

    }

    public function e404() {

        require_once './Library/dbconnect.php';
        require_once './Views/header.php';
        require_once './Views/404.php';
        require_once './Views/footer.php';

    }

    public function e4041($message) {

        require_once './Library/dbconnect.php';
        require_once './Views/header.php';
        ?>
            <div class="container container-fluid text-center">
                <br><br><br><br>
                <h1 style="color:red"><strong><?php echo $message?></strong></h1>
            </div>
        <?php
        require_once './Views/footer.php';

    }

}