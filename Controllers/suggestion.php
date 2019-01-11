<?php

class Suggestion extends Controller {

    function __construct() {
        parent::__construct();

    }

    public function build() {
        require_once './Models/index_model.php';
        $model = new Index_Model;
        $this->view->render('./Views/suggestion');

    }

    public function e404() {

        $this->view->e404();

    }

}