<?php

/**
 * Description of HashSnefru
 *
 * @author Daniel
 * 
 * Class which handles all operations for the 
 * Snefru hash
 */
class HashSnefru {
    
    public function getSnefruHash($input) {
        return hash('snefru', $input);
    }
    
}
