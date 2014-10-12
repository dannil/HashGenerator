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
    public function array_key_exists_r($needle, $haystack) {
        if (array_key_exists($needle, $haystack)) {
            return true;
        }
        foreach ($haystack as $hay) {
            if (!is_array($hay)) {
                continue;
            }
            if (array_key_exists($needle, $hay)) {
                return true;
            }
        }
        return false;
    }
    
}