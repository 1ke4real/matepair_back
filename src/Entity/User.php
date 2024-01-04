<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $favoriteGames = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $playSchedule = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Notification::class)]
    private Collection $notifications;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Message::class)]
    private Collection $send;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: Message::class)]
    private Collection $receive;

    #[ORM\OneToMany(mappedBy: 'first_user', targetEntity: Matches::class)]
    private Collection $first_user;

    #[ORM\OneToMany(mappedBy: 'second_user', targetEntity: Matches::class)]
    private Collection $second_match;

    public function __toString(): string
    {
        return $this->username;
    }
    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->send = new ArrayCollection();
        $this->receive = new ArrayCollection();
        $this->first_user = new ArrayCollection();
        $this->second_match = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getFavoriteGames(): ?string
    {
        return $this->favoriteGames;
    }

    public function setFavoriteGames(?string $favoriteGames): static
    {
        $this->favoriteGames = $favoriteGames;

        return $this;
    }

    public function getPlaySchedule(): ?string
    {
        return $this->playSchedule;
    }

    public function setPlaySchedule(?string $playSchedule): static
    {
        $this->playSchedule = $playSchedule;

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setUserId($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getUserId() === $this) {
                $notification->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getSend(): Collection
    {
        return $this->send;
    }

    public function addSend(Message $send): static
    {
        if (!$this->send->contains($send)) {
            $this->send->add($send);
            $send->setSender($this);
        }

        return $this;
    }

    public function removeSend(Message $send): static
    {
        if ($this->send->removeElement($send)) {
            // set the owning side to null (unless already changed)
            if ($send->getSender() === $this) {
                $send->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getReceive(): Collection
    {
        return $this->receive;
    }

    public function addReceive(Message $receive): static
    {
        if (!$this->receive->contains($receive)) {
            $this->receive->add($receive);
            $receive->setReceiver($this);
        }

        return $this;
    }

    public function removeReceive(Message $receive): static
    {
        if ($this->receive->removeElement($receive)) {
            // set the owning side to null (unless already changed)
            if ($receive->getReceiver() === $this) {
                $receive->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matches>
     */
    public function getFirstUser(): Collection
    {
        return $this->first_user;
    }

    public function addFirstUser(Matches $firstUser): static
    {
        if (!$this->first_user->contains($firstUser)) {
            $this->first_user->add($firstUser);
            $firstUser->setFirstUser($this);
        }

        return $this;
    }

    public function removeFirstUser(Matches $firstUser): static
    {
        if ($this->first_user->removeElement($firstUser)) {
            // set the owning side to null (unless already changed)
            if ($firstUser->getFirstUser() === $this) {
                $firstUser->setFirstUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matches>
     */
    public function getSecondMatch(): Collection
    {
        return $this->second_match;
    }

    public function addSecondMatch(Matches $secondMatch): static
    {
        if (!$this->second_match->contains($secondMatch)) {
            $this->second_match->add($secondMatch);
            $secondMatch->setSecondUser($this);
        }

        return $this;
    }

    public function removeSecondMatch(Matches $secondMatch): static
    {
        if ($this->second_match->removeElement($secondMatch)) {
            // set the owning side to null (unless already changed)
            if ($secondMatch->getSecondUser() === $this) {
                $secondMatch->setSecondUser(null);
            }
        }

        return $this;
    }
}
