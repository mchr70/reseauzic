<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThreadRepository")
 */
class Thread
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="thread")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="threads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCreator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="threads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userRecipient;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setThread($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getThread() === $this) {
                $message->setThread(null);
            }
        }

        return $this;
    }

    public function getUserCreator(): ?User
    {
        return $this->userCreator;
    }

    public function setUserCreator(?User $userCreator): self
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    public function getUserRecipient(): ?User
    {
        return $this->userRecipient;
    }

    public function setUserRecipient(?User $userRecipient): self
    {
        $this->userRecipient = $userRecipient;

        return $this;
    }
}
