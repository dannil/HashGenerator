<?php

/**
 * Description of Functions
 *
 * @author Daniel
 * 
 * Class which holds user-defined functions
 */
class Functions {
    
    /* Credits to Tim (http://stackoverflow.com/users/698511/tim) */
    public function array_key_exists_r($needle, $haystack) {
        if (array_key_exists($needle, $haystack)) {
            return true;
        }
        foreach ($haystack as $item) {
            if (array_key_exists($needle, $item)) {
                return true;
            }
        }
        return false;
    }
    
}