<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PasswordUpdate
{
    /**
     * @Assert\Length(min="8", minMessage="Your password must have at least 8 characters")
     */
    private $newPassword;
    /**
     * @Assert\EqualTo(propertyPath="newPassword", message="You haven't confirmed your password")
     */
    private $confirmPassword;
 
    public function getNewPassword(): ? string
    {
        return $this->newPassword;
    }
    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;
        return $this;
    }
    public function getConfirmPassword(): ? string
    {
        return $this->confirmPassword;
    }
    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }
 
}
