<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\StatusTypeEnum;
use App\Repository\EncounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncounterRepository::class)]
#[ApiResource]
class Encounter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, enumType: StatusTypeEnum::class, options: ['default' => StatusTypeEnum::WAITING])]
    private ?StatusTypeEnum $status = StatusTypeEnum::WAITING;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'encounters')]
    private Collection $matches;


    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?StatusTypeEnum
    {
        return $this->status;
    }

    public function setStatus(StatusTypeEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(User $matches): static
    {
        if (!$this->matches->contains($matches)) {
            $this->matches->add($matches);
        }

        return $this;
    }

    public function removeMatch(User $matches): static
    {
        $this->matches->removeElement($matches);

        return $this;
    }
}
