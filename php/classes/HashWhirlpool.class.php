<?php

/**
 * Description of HashWhirlpool
 *
 * @author Daniel
 * 
 * Class which handles all operations for the 
 * Whirlpool hash
 */
class HashWhirlpool {

    public function getWhirlpoolHash($input) {
        return hash('whirlpool', $input);
    }
    
}