<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Cocur\Slugify\Slugify;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Ignore;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Serializable;



/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @Vich\Uploadable
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ est vide")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ est vide")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ est vide")
     */
    private $gamePlayed;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ est vide")
     */
    private $goalScored;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ est vide")
     */
    private $keyPass;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $club;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="player_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var DateTime|null
     */
    private $updatedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @return void
     */
    public function initializeSlug() {
        if(empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGamePlayed(): ?int
    {
        return $this->gamePlayed;
    }

    public function setGamePlayed(int $gamePlayed): self
    {
        $this->gamePlayed = $gamePlayed;

        return $this;
    }

    public function getGoalScored(): ?int
    {
        return $this->goalScored;
    }

    public function setGoalScored(int $goalScored): self
    {
        $this->goalScored = $goalScored;

        return $this;
    }

    public function getKeyPass(): ?int
    {
        return $this->keyPass;
    }

    public function setKeyPass(int $keyPass): self
    {
        $this->keyPass = $keyPass;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return File|null
     * @Ignore()
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if(null !== $imageFile) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}
