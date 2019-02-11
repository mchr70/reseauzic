<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $note;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="givenRatings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userSender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="receivedRatings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userRecipient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUserSender(): ?User
    {
        return $this->userSender;
    }

    public function setUserSender(?User $userSender): self
    {
        $this->userSender = $userSender;

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
