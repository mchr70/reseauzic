<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 */
class Level
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
     * @ORM\OneToMany(targetEntity="App\Entity\UserInstrumentLevel", mappedBy="level")
     */
    private $userInstrumentLevel;

    public function __construct()
    {
        $this->levelByUsers = new ArrayCollection();
        $this->userInstrumentLevel = new ArrayCollection();
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
     * @return Collection|UserInstrumentLevel[]
     */
    public function getUserInstrumentLevel(): Collection
    {
        return $this->userInstrumentLevel;
    }

    public function addUserInstrumentLevel(UserInstrumentLevel $userInstrumentLevel): self
    {
        if (!$this->userInstrumentLevel->contains($userInstrumentLevel)) {
            $this->userInstrumentLevel[] = $userInstrumentLevel;
            $userInstrumentLevel->setLevel($this);
        }

        return $this;
    }

    public function removeUserInstrumentLevel(UserInstrumentLevel $userInstrumentLevel): self
    {
        if ($this->userInstrumentLevel->contains($userInstrumentLevel)) {
            $this->userInstrumentLevel->removeElement($userInstrumentLevel);
            // set the owning side to null (unless already changed)
            if ($userInstrumentLevel->getLevel() === $this) {
                $userInstrumentLevel->setLevel(null);
            }
        }

        return $this;
    }

}
