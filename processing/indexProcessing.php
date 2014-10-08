<?php

function __autoload($classname) {
    require_once('../classes/' . $classname . '.class.php');
}

if (!isset($_POST)) {
    die();
}
else {
    $stringToHash = $_POST['stringToHash'];
    if (isset($_POST['saltCheckbox'])) {
        $salt = $_POST['salt'];
        if (isset($_POST['placeSaltAt'])) {
            if ($_POST['placeSaltAt'] == 'beginning') {
                $stringToHash = $salt + $stringToHash;
            }
            else if ($_POST['placeSaltAt'] == 'end') {
                $stringToHash += $salt;
            }
        }
    }
}