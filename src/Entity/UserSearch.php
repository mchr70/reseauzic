<?php

namespace App\Entity;

class UserSearch{

    /**
     * @var string
     */
    private $zipCode;

    function getZipCode(){
        return $this->zipCode;
    }

    function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }
}