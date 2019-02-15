<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email")
 * @ORM\Entity()
 */
class User implements UserInterface, \Serializable {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     */
    private $plainPassword;
    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;
    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $registrationDate;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gender;
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $zipCode;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $influences;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $material;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="users")
     */
    private $genres;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="user")
     */
    private $photos;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $sentMessages;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="userRecipient")
     */
    private $receivedMessages;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="userSender")
     */
    private $givenRatings;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="userRecipient")
     */
    private $receivedRatings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserInstrument", mappedBy="user")
     */
    private $userInstruments;
    
    public function __construct() {
        $this->isActive = true;
        $this->genres = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->sentMessages = new ArrayCollection();
        $this->receivedMessages = new ArrayCollection();
        $this->givenRatings = new ArrayCollection();
        $this->receivedRatings = new ArrayCollection();
        $this->userInstruments = new ArrayCollection();
        
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    public function getUsername() {
        return $this->email;
    }
    public function getSalt() {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    public function getPassword() {
        return $this->password;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    public function getRoles() {
        if (empty($this->roles)) {
            return ['ROLE_USER'];
        }
        return $this->roles;
    }
    function addRole($role) {
        $this->roles[] = $role;
    }
    public function eraseCredentials() {
        
    }
    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
                // see section on salt below
                // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->email,
                $this->password,
                $this->isActive,
                // see section on salt below
                // $this->salt
                ) = unserialize($serialized);
    }
    function getId() {
        return $this->id;
    }
    function getEmail() {
        return $this->email;
    }
    function getPlainPassword() {
        return $this->plainPassword;
    }
    function getIsActive() {
        return $this->isActive;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }
    function setIsActive($isActive) {
        $this->isActive = $isActive;
    }
    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }
    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }
    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }
    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }
    public function getGender(): ?bool
    {
        return $this->gender;
    }
    public function setGender(bool $gender): self
    {
        $this->gender = $gender;
        return $this;
    }
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }
    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getAddress(): ?string
    {
        return $this->address;
    }
    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
    public function getAbout(): ?string
    {
        return $this->about;
    }
    public function setAbout(?string $about): self
    {
        $this->about = $about;
        return $this;
    }
    public function getInfluences(): ?string
    {
        return $this->influences;
    }
    public function setInfluences(?string $influences): self
    {
        $this->influences = $influences;
        return $this;
    }
    public function getMaterial(): ?string
    {
        return $this->material;
    }
    public function setMaterial(?string $material): self
    {
        $this->material = $material;
        return $this;
    }
    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }
    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }
        return $this;
    }
    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }
        return $this;
    }
    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }
    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setUser($this);
        }
        return $this;
    }
    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getUser() === $this) {
                $photo->setUser(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Message[]
     */
    public function getSentMessages(): Collection
    {
        return $this->sentMessages;
    }
    public function addSentMessage(Message $sentMessage): self
    {
        if (!$this->sentMessages->contains($sentMessage)) {
            $this->sentMessages[] = $sentMessage;
            $sentMessage->setUser($this);
        }
        return $this;
    }
    public function removeSentMessage(Message $sentMessage): self
    {
        if ($this->sentMessages->contains($sentMessage)) {
            $this->sentMessages->removeElement($sentMessage);
            // set the owning side to null (unless already changed)
            if ($sentMessage->getUser() === $this) {
                $sentMessage->setUser(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Message[]
     */
    public function getReceivedMessages(): Collection
    {
        return $this->receivedMessages;
    }
    public function addReceivedMessage(Message $receivedMessage): self
    {
        if (!$this->receivedMessages->contains($receivedMessage)) {
            $this->receivedMessages[] = $receivedMessage;
            $receivedMessage->setUserRecipient($this);
        }
        return $this;
    }
    public function removeReceivedMessage(Message $receivedMessage): self
    {
        if ($this->receivedMessages->contains($receivedMessage)) {
            $this->receivedMessages->removeElement($receivedMessage);
            // set the owning side to null (unless already changed)
            if ($receivedMessage->getUserRecipient() === $this) {
                $receivedMessage->setUserRecipient(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Rating[]
     */
    public function getGivenRatings(): Collection
    {
        return $this->givenRatings;
    }
    public function addGivenRating(Rating $givenRating): self
    {
        if (!$this->givenRatings->contains($givenRating)) {
            $this->givenRatings[] = $givenRating;
            $givenRating->setUserSender($this);
        }
        return $this;
    }
    public function removeGivenRating(Rating $givenRating): self
    {
        if ($this->givenRatings->contains($givenRating)) {
            $this->givenRatings->removeElement($givenRating);
            // set the owning side to null (unless already changed)
            if ($givenRating->getUserSender() === $this) {
                $givenRating->setUserSender(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Rating[]
     */
    public function getReceivedRatings(): Collection
    {
        return $this->receivedRatings;
    }
    public function addReceivedRating(Rating $receivedRating): self
    {
        if (!$this->receivedRatings->contains($receivedRating)) {
            $this->receivedRatings[] = $receivedRating;
            $receivedRating->setUserRecipient($this);
        }
        return $this;
    }
    public function removeReceivedRating(Rating $receivedRating): self
    {
        if ($this->receivedRatings->contains($receivedRating)) {
            $this->receivedRatings->removeElement($receivedRating);
            // set the owning side to null (unless already changed)
            if ($receivedRating->getUserRecipient() === $this) {
                $receivedRating->setUserRecipient(null);
            }
        }
        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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
            $userInstrument->setUser($this);
        }

        return $this;
    }

    public function removeUserInstrument(UserInstrument $userInstrument): self
    {
        if ($this->userInstruments->contains($userInstrument)) {
            $this->userInstruments->removeElement($userInstrument);
            // set the owning side to null (unless already changed)
            if ($userInstrument->getUser() === $this) {
                $userInstrument->setUser(null);
            }
        }

        return $this;
    }
   
}