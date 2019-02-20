<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="instruments")
     */
    private $users;

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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addInstrument($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeInstrument($this);
        }

        return $this;
    }  

}
