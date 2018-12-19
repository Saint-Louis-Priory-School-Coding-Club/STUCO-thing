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
function encrypt($string, $key, $method = 'AES-128-CTR') {
    $foo = md5(rand(1, 1000));
    $enc_iv = bin2hex(openssl_random_pseudo_bytes(8));
    $iv = $enc_iv;
    return openssl_encrypt($string, $method, $key, 0, $enc_iv) . ':::' . $enc_iv;
}
function decrypt($crypt, $key, $method = 'AES-128-CTR') {
    $rawdata = explode(':::', $crypt);
    $rawiv = explode('***', $rawdata[1]);
    $iv = $rawiv[0];
    return openssl_decrypt($rawdata[0], $method, $key, 0, $iv);
}
function store_userdata($array) {
    if (isset($array['key'])) $key = $array['key'];
    else {
        $key = md5(rand(1, 1000));
        $returnkey = true;
    }
    $array = encode_assoc($array);
    $array = encrypt($array, $key);
    if (isset($returnkey)) {
        return $array . '***' . $key;
    } else {
        return $array;
    }
}
function use_userdata($crypt, $key = NULL) {
    if ($key == NULL) {
        $crypt = explode('***', $crypt);
        $crypt = decrypt($crypt[0], $crypt[1]);
        $array = decode_assoc($crypt);
        return $array;
    } else {
        $crypt = decrypt($crypt, $key);
        //var_dump($crypt);
        $array = decode_assoc($crypt);
        return $array;
    }
}