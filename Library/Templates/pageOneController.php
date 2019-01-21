<?php

class $$PageName$$ extends Controller {

    function __construct() {
        parent::__construct();

    }

    public function build() {
        $this->view->render('./Views/$$PagePath$$', $$PageInclude$$);

    }

    public function e404() {

        $this->view->e404();

    }

}