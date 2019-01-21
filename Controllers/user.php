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
    function dashboard($pages = NULL) {
        $f1_pages = ['pages','stuco'];
        $f2_pages = array(
            'pages0'     => 'add',
            'pages1'     => 'edit'
        );
        $f3_params = array(
            'pages::edit'    => 'page_id'
        );
        $pagetoload = '';
        $pass_params = [];
        $f3 = FALSE;
        $f2 = FALSE;
        $f1 = FALSE;
        $perror = FALSE;
        if ($pages !== NULL) {
            for ($i = 0; $i < sizeof($pages); $i++) {
                //var_dump($pages[$i]);
                if (!isset($pages[$i])) break;
                if (in_array($pages[$i],$f1_pages) && $f1 === FALSE) {
                    $pagetoload = $pages[$i];
                    $f1 = TRUE;
                } elseif (in_array($pages[$i],$f2_pages) && $f2 === FALSE && $f1 === TRUE) {
                    $pagetoload .= '/' . $pages[$i];
                    $f2 = TRUE;
                } elseif ($pagetoload !== NULL && sizeof($pages) > 2 && $f2 === TRUE && $f1 === TRUE) {
                    $f3 = TRUE;
                    $param_key = explode('/', $pagetoload);
                    $param_key = $param_key[0] . '::' . $param_key[1];
                    if (!isset($f3_params[$param_key])) break;
                    $arraytopush = array(
                        $f3_params[$param_key]        => $pages[$i]
                    );
                    $pass_params = array_merge($pass_params, $arraytopush);
                } else {
                    $perror = TRUE;
                }
            }
            //var_dump($f2);
            require_once './Models/pages_model.php';
            if ($perror) $this->view->e404();
            if ($f3) {
                $loadpage = explode('/',$pagetoload);
                $loadpage = 'dashboard-'.$loadpage[0].'-'.$loadpage[1];
                $this->view->render('./Views/'.$loadpage,FALSE,$pass_params);
            } elseif ($f2) {
                $loadpage = explode('/',$pagetoload);
                $loadpage = 'dashboard-'.$loadpage[0].'-'.$loadpage[1];
                $this->view->render('./Views/'.$loadpage,FALSE);
            } elseif ($f1) {
                $this->view->render('./Views/dashboard-'.$pagetoload,FALSE);
            }


        } else {
            require_once './Models/tasks_model.php';
            //$model = new Index_Model;
            $this->view->render('./Views/user-dashboard', FALSE);
        }
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