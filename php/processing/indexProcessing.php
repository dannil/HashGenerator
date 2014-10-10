<?php

require_once('../classes/Hash.class.php');

unset($_SESSION);
session_start();

/* Credits to elusive (http://stackoverflow.com/users/427328/elusive) */
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

$stringToHash = filter_input(INPUT_POST, 'stringToHash', FILTER_SANITIZE_STRING);
if (isset($stringToHash)) {
    $_SESSION['stringToHash'] = $stringToHash;
    $saltCheckbox = filter_input(INPUT_POST, 'saltCheckbox', FILTER_SANITIZE_STRING);
    if (isset($saltCheckbox)) {
        $_SESSION['saltCheckbox'] = $saltCheckbox;
        $salt = filter_input(INPUT_POST, 'salt', FILTER_SANITIZE_STRING);
        $_SESSION['salt'] = $salt;
        $placeSaltAt = filter_input(INPUT_POST, 'placeSaltAt', FILTER_SANITIZE_STRING);
        if (isset($placeSaltAt)) {
            $_SESSION['placeSaltAt'] = $placeSaltAt;
            if ($placeSaltAt == 'beginning') {
                $stringToHash = $salt . $stringToHash;
            }
            else if ($placeSaltAt == 'end') {
                $stringToHash .= $salt;
            }
        }
    }
    
    $algorithm = strtoupper(filter_input(INPUT_POST, 'algorithm', FILTER_SANITIZE_STRING));
    $_SESSION['algorithm'] = $algorithm;
    
    $hashObj = new Hash();
    $_SESSION['hash'] = $hashObj->getHash($stringToHash, $algorithm);
    header('Location: ' . filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING));
}
else {
    die("Unallowed access method");
}