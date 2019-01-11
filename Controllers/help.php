<?php

class Help extends Controller {

    function __construct() {
        parent::__construct();

    }

    public function build() {
        require_once './Models/index_model.php';
        $model = new Index_Model;
        $this->view->render('./Views/help');

    }

    public function e404() {

        $this->view->e404();

    }

    public function user($parameters = NULL) {
        //put in parameters here
        $accepted_params = [];
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
        require_once './Models/index_model.php';
        $model = new Index_Model;
        //loads the page with the header and footer already included, set to FALSE to control the full page
        $this->view->render('./Views/help',TRUE,$params);
    }

}