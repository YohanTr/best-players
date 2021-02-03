<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
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
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $gamePlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalScored;

    /**
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

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
}
