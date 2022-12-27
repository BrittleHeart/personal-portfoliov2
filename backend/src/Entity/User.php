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
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var array<string> The roles of the user
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_active = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $banned_for = null;

    #[ORM\Column(options: ['default' => 0 ])]
    private ?bool $banned = null;

    /**
     * @var ArrayCollection<int, Page> $pages
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Page::class)]
    private Collection $pages;

    /**
     * @var ArrayCollection<int, UserPagesHistory> $userPagesHistories
     */
    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: UserPagesHistory::class)]
    private Collection $userPagesHistories;
    
    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    /**
     * @var ArrayCollection<int, Post> $posts
     */
    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Post::class)]
    private Collection $posts;

    /**
     * @var ArrayCollection<int, Comment> $comments
     */
    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Comment::class)]
    private Collection $comments;

    /**
     * @var ArrayCollection<int, PostUserCommentsHistory> $postUserCommentsHistories
     */
    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: PostUserCommentsHistory::class)]
    private Collection $postUserCommentsHistories;

    /**
     * @var ArrayCollection<int, UserAccountHistory> $userAccountHistories
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserAccountHistory::class)]
    private Collection $userAccountHistories;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->userPagesHistories = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->postUserCommentsHistories = new ArrayCollection();
        $this->userAccountHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @return array<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<string> $roles
     * @return self
     */
    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastActive(): ?\DateTimeInterface
    {
        return $this->last_active;
    }

    public function setLastActive(\DateTimeInterface $last_active): self
    {
        $this->last_active = $last_active;

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

    /**
     * @return \DateInterval
     */
    public function getBannedFor(): ?\DateInterval
    {
        return $this->banned_for;
    }

    /**
     * @param \DateInterval $banned_for
     * @return self
     */
    public function setBannedFor(?\DateInterval $banned_for): self
    {
        $this->banned_for = $banned_for;

        return $this;
    }

    public function isBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setUser($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getUser() === $this) {
                $page->setUser(null);
            }
        }

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
            $userPagesHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserPagesHistory(UserPagesHistory $userPagesHistory): self
    {
        if ($this->userPagesHistories->removeElement($userPagesHistory)) {
            // set the owning side to null (unless already changed)
            if ($userPagesHistory->getUser() === $this) {
                $userPagesHistory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUserId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUserId() === $this) {
                $comment->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostUserCommentsHistory>
     */
    public function getPostUserCommentsHistories(): Collection
    {
        return $this->postUserCommentsHistories;
    }

    public function addPostUserCommentsHistory(PostUserCommentsHistory $postUserCommentsHistory): self
    {
        if (!$this->postUserCommentsHistories->contains($postUserCommentsHistory)) {
            $this->postUserCommentsHistories->add($postUserCommentsHistory);
            $postUserCommentsHistory->setUserId($this);
        }

        return $this;
    }

    public function removePostUserCommentsHistory(PostUserCommentsHistory $postUserCommentsHistory): self
    {
        if ($this->postUserCommentsHistories->removeElement($postUserCommentsHistory)) {
            // set the owning side to null (unless already changed)
            if ($postUserCommentsHistory->getUserId() === $this) {
                $postUserCommentsHistory->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserAccountHistory>
     */
    public function getUserAccountHistories(): Collection
    {
        return $this->userAccountHistories;
    }

    public function addUserAccountHistory(UserAccountHistory $userAccountHistory): self
    {
        if (!$this->userAccountHistories->contains($userAccountHistory)) {
            $this->userAccountHistories->add($userAccountHistory);
            $userAccountHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserAccountHistory(UserAccountHistory $userAccountHistory): self
    {
        if ($this->userAccountHistories->removeElement($userAccountHistory)) {
            // set the owning side to null (unless already changed)
            if ($userAccountHistory->getUser() === $this) {
                $userAccountHistory->setUser(null);
            }
        }

        return $this;
    }
}
