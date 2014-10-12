<?php

/**
 * Description of Functions
 *
 * @author Daniel
 * 
 * Class which holds user-defined functions
 */
class Functions {
    
    /* Credits to elusive (http://stackoverflow.com/users/427328/elusive) */
    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
    
    /* Credits to Tim (http://stackoverflow.com/users/698511/tim) */
    public function array_key_exists_r($key, $array) {
        if (array_key_exists($key, $array)) {
            return true;
        }
        foreach ($array as $a) {
            if (!is_array($a)) {
                continue;
            }
            if (array_key_exists($key, $a)) {
                return true;
            }
        }
        return false;
    }
    
}