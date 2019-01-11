<?php

class Blog extends Controller {

    function __construct() {
        parent::__construct();

    }

    public function build() {
        require_once './Models/tasks_model.php';
        //$model = new Tasks_Model;
        $this->view->render('./Views/blog', FALSE);

    }

    public function e404() {

        $this->view->e404();

    }

    public function user($parameters = NULL) {
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
        $this->view->render('./Views/help',TRUE,$params);
    }

    public function posts($parameters = NULL) {
        $accepted_params = ['postId'];
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
        //$model = new Index_Model;
        $this->view->render('./Views/blog-post',FALSE,$params);
    }

}