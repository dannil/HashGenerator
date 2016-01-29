<?php

$stringToHash = filter_input(INPUT_POST, 'stringToHash', FILTER_SANITIZE_STRING);
if (isset($stringToHash)) {
    require_once('Hash.php');
    unset($_SESSION);
    session_start();
    
    $_SESSION['stringToHash'] = $stringToHash;
    
    $algorithm = filter_input(INPUT_POST, 'algorithm', FILTER_SANITIZE_STRING);
    $_SESSION['algorithm'] = $algorithm;
    
    $hashObj = new Hash();
    $_SESSION['hash'] = $hashObj->getHash($stringToHash, $algorithm);
}
return header('Location: ' . filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING));