<?php
class Download extends Controller {

    function __construct() {
        parent::__construct();

    }

    public function file($parameters = NULL) {
        //put in parameters here
        $accepted_params = ['fileName'];
        $params = array();
        for ($i = 0; $i < sizeof($accepted_params); $i++) {
            if (!isset($parameters[$i])) {
                break;
            }
            $arraytopush = array(
                $accepted_params[$i]    => $parameters[$i]
            );
            $params = array_merge($params, $arraytopush);
        }
        unset($params['']);
        require_once './Models/tasks_model.php';
        $model = new Tasks_Model;
        //loads the page with the header and footer already included, set to FALSE to control the full page
        $this->view->render('./Views/downloader',FALSE,$params);
    }

}