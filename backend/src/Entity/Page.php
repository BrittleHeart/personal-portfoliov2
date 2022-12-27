<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var ArrayCollection<int, Theme> $theme
     */
    #[ORM\OneToMany(mappedBy: 'page', targetEntity: Theme::class)]
    private Collection $theme;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'pages')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $editable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 30)]
    private ?string $url = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $published = null;

    /**
     * @var ArrayCollection<int, UserPagesHistory> $userPagesHistories
     */
    #[ORM\OneToMany(mappedBy: 'page', targetEntity: UserPagesHistory::class)]
    private Collection $userPagesHistories;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->theme = new ArrayCollection();
        $this->userPagesHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getTheme(): Collection
    {
        return $this->theme;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->theme->contains($theme)) {
            $this->theme->add($theme);
            $theme->setPage($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->theme->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getPage() === $this) {
                $theme->setPage(null);
            }
        }

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isEditable(): ?bool
    {
        return $this->editable;
    }

    public function setEditable(bool $editable): self
    {
        $this->editable = $editable;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return Collection<int, UserPagesHistory>
     */
    public function getUserPagesHistories(): Collection
    {
        return $this->userPagesHistories;
    }

    public function addUserPagesHistory(UserPagesHistory $userPagesHistory): self
    {
        if (!$this->userPagesHistories->contains($userPagesHistory)) {
            $this->userPagesHistories->add($userPagesHistory);
            $userPagesHistory->setPage($this);
        }

        return $this;
    }

    public function removeUserPagesHistory(UserPagesHistory $userPagesHistory): self
    {
        if ($this->userPagesHistories->removeElement($userPagesHistory)) {
            // set the owning side to null (unless already changed)
            if ($userPagesHistory->getPage() === $this) {
                $userPagesHistory->setPage(null);
            }
        }

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
