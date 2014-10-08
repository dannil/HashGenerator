<?php

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

if (isset($_POST)) {
    $stringToHash = $_POST['stringToHash'];
    $SESSION['stringToHash'] = $stringToHash;
    if (isset($_POST['saltCheckbox'])) {
        $salt = $_POST['salt'];
        $_SESSION['salt'] = $salt;
        if (isset($_POST['placeSaltAt'])) {
            if ($_POST['placeSaltAt'] == 'beginning') {
                echo $stringToHash = $salt . $stringToHash;
            }
            else if ($_POST['placeSaltAt'] == 'end') {
                $stringToHash .= $salt;
            }
        }
    }
    
    $algorithm = "RIPEMD256";
    
    $mdArray = array("MD5");
    $ripemdArray = array("RIPEMD128", "RIPEMD160", "RIPEMD256", "RIPEMD320");
    $shaArray = array("SHA1", "SHA256", "SHA384", "SHA512");
    $allArrays = array($mdArray, $ripemdArray, $shaArray);
    
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
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        die("Algorithm doesn't exist");
    }
}
else {
    die("Unallowed access method");
}