public function $$PageFunction$$($parameters = NULL) {
        $accepted_params = [$$PageParams$$];
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
        if (isset($params[''])) unset($params['']);
        $this->view->render('./Views/$$PageFunctionPath$$',$$PageInclude$$,$params);
    }