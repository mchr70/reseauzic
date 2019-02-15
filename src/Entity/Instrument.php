<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstrumentRepository")
 */
class Instrument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserInstrument", mappedBy="instrument")
     */
    private $userInstruments;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->levelByUsers = new ArrayCollection();
        $this->userInstruments = new ArrayCollection();
        
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|UserInstrument[]
     */
    public function getUserInstruments(): Collection
    {
        return $this->userInstruments;
    }

    public function addUserInstrument(UserInstrument $userInstrument): self
    {
        if (!$this->userInstruments->contains($userInstrument)) {
            $this->userInstruments[] = $userInstrument;
            $userInstrument->setInstrument($this);
        }

        return $this;
    }

    public function removeUserInstrument(UserInstrument $userInstrument): self
    {
        if ($this->userInstruments->contains($userInstrument)) {
            $this->userInstruments->removeElement($userInstrument);
            // set the owning side to null (unless already changed)
            if ($userInstrument->getInstrument() === $this) {
                $userInstrument->setInstrument(null);
            }
        }

        return $this;
    }  

}
