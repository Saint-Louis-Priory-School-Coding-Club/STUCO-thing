<?php
function encode_assoc($array) {
    $stringtopush = '';
    foreach ($array as $key => $val) {
        $string = $key . '=' . $val . ',';
        $stringtopush .= $string;
    }
    $stringtopush = substr($stringtopush, 0, -1);
    return $stringtopush;
}
function decode_assoc($array) {
    $array = explode(',', $array);
    $arraytopush = array();
    foreach ($array as $ind) {
        $vals = explode('=', $ind);
        $key = $vals[0];
        $val = $vals[1];
        $array = array(
            $key    =>  $val
        );
        $arraytopush = array_merge($arraytopush, $array);
    }
    unset($arraytopush['']);
    return $arraytopush;
}