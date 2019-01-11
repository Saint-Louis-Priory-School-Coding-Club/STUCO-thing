<?php

class User extends Controller {

    function __construct() {
        parent::__construct();

    }

    function build() {
        $this->view->render('./Views/user');
        require_once './Models/index_model.php';
        $model = new Index_Model;

    }

    function dashboard() {
        require_once './Models/tasks_model.php';
        //$model = new Index_Model;
        $this->view->render('./Views/user-dashboard', FALSE);
    }

    function login() {
        $this->view->render('./Views/user-login', FALSE);
        require_once './Models/index_model.php';
        $model = new Index_Model;
    }

    function logout() {
        $this->view->render('./Views/user-logout', FALSE);
        require_once './Models/index_model.php';
        $model = new Index_Model;
    }

    function register() {
        $this->view->render('./Views/user-register', FALSE);
        require_once './Models/index_model.php';
        $model = new Index_Model;
    }

    function settings() {
        $this->view->render('./Views/user-settings');
        require_once './Models/index_model.php';
        $model = new Index_Model;
    }

    public function e404() {

        $this->view->e404();

    }

}