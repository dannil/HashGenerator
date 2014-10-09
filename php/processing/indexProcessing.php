<?php

unset($_SESSION);
session_start();

function __autoload($classname) {
    require_once('../classes/' . $classname . '.class.php');
}

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
    $mdArray = $hashObj->getMDArray();
    $ripemdArray = $hashObj->getRIPEMDArray();
    $shaArray = $hashObj->getSHAArray();
    
    $allArrays = $hashObj->getAllArrays();
    
    if (in_array_r($algorithm, $allArrays)) {
        if (in_array($algorithm, $mdArray)) {
            $hashFamily = new HashMD();
            switch ($algorithm) {
                case "MD5":
                    $hash = $hashFamily->getMD5Hash($stringToHash);
                    break;
            }
        }

        if (in_array($algorithm, $ripemdArray)) {
            $hashFamily = new HashRIPEMD();
            switch ($algorithm) {
                case "RIPEMD128":
                    $hash = $hashFamily->getRIPEMD128Hash($stringToHash);
                    break;
                case "RIPEMD160":
                    $hash = $hashFamily->getRIPEMD160Hash($stringToHash);
                    break;
                case "RIPEMD256":
                    $hash = $hashFamily->getRIPEMD256Hash($stringToHash);
                    break;
                case "RIPEMD320":
                    $hash = $hashFamily->getRIPEMD320Hash($stringToHash);
                    break;
            }
        }

        if (in_array($algorithm, $shaArray)) {
            $hashFamily = new HashSHA();
            switch ($algorithm) {
                case "SHA1":
                    $hash = $hashFamily->getSHA1Hash($stringToHash);
                    break;
                case "SHA256":
                    $hash = $hashFamily->getSHA256Hash($stringToHash);
                    break;
                case "SHA384":
                    $hash = $hashFamily->getSHA384Hash($stringToHash);
                    break;
                case "SHA512":
                    $hash = $hashFamily->getSHA512Hash($stringToHash);
                    break;
            }
        }
        
        $_SESSION['hash'] = $hash;
        
        header('Location: ' . filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING));
    } else {
        die("Algorithm doesn't exist");
    }
}
else {
    die("Unallowed access method");
}