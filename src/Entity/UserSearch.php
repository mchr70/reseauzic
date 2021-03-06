<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserSearch{

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var array
     */
    private $instruments;

    /**
     * @var array
     */
    private $genres;

    public function __construct(){
        $this->genres = [];
        $this->instruments = [];
    }

    public function getZipCode(){
        return $this->zipCode;
    }
    
    public function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }

    /**
     * Get undocumented variable
     *
     * @return  array
     */ 
    public function getInstruments()
    {
        return $this->instruments;
    }

    /**
     * Set undocumented variable
     *
     * @param  array  $instruments  Undocumented variable
     *
     * @return  self
     */ 
    public function setInstruments(array $instruments)
    {
        $this->instruments = $instruments;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  array
     */ 
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set undocumented variable
     *
     * @param  array  $genres  Undocumented variable
     *
     * @return  self
     */ 
    public function setGenres(array $genres)
    {
        $this->genres = $genres;

        return $this;
    }
}