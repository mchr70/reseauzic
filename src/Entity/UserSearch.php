<?php

namespace App\Entity;

class UserSearch{

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $city;

    function getZipCode(){
        return $this->zipCode;
    }

    function getCity(){
        return $this->city;
    }

    function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }

    function setCity($city){
        $this->city = $city;
    }
}