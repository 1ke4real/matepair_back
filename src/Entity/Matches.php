<?php

namespace App\Entity;

use App\Repository\MatchesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchesRepository::class)]
class Matches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'first_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $first_user = null;

    #[ORM\ManyToOne(inversedBy: 'second_match')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $second_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getFirstUser(): ?User
    {
        return $this->first_user;
    }

    public function setFirstUser(?User $first_user): static
    {
        $this->first_user = $first_user;

        return $this;
    }

    public function getSecondUser(): ?User
    {
        return $this->second_user;
    }

    public function setSecondUser(?User $second_user): static
    {
        $this->second_user = $second_user;

        return $this;
    }
}
