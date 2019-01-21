<?php
class Pages_Model extends Model{

    function __construct() {
        parent::__construct();
        

    }

    public function getContentsByLine($file, $lineNumber) {
        if (!$file->eof()) {
            $file->seek($lineNumber);
            $contents = $file->current();
       }
    }

    public function encode_array($array) {
        $stringtopush = '';
        foreach ($array as $val) {
            $string = "'".$val . "',";
            $stringtopush .= $string;
        }
        $stringtopush = substr($stringtopush, 0, -1);
        return $stringtopush;
    }

}