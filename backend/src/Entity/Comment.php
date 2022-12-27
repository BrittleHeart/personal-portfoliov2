<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Post $post = null;

    #[ORM\Column(length: 45)]
    private ?string $caption = null;

    #[ORM\Column(options: ['default' => 1])]
    private ?int $status = null;

    #[ORM\Column]
    private ?\DateInterval $added_ago = null;

    #[ORM\Column(length: 250)]
    private ?string $content = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $likes = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $shared = null;

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    /**
     * @var ArrayCollection<int, PostUserCommentsHistory> $postUserCommentsHistories
     */
    #[ORM\OneToMany(mappedBy: 'comment', targetEntity: PostUserCommentsHistory::class)]
    private Collection $postUserCommentsHistories;

    public function __construct()
    {
        $this->postUserCommentsHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAddedAgo(): ?\DateInterval
    {
        return $this->added_ago;
    }

    public function setAddedAgo(\DateInterval $added_ago): self
    {
        $this->added_ago = $added_ago;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getShared(): ?int
    {
        return $this->shared;
    }

    public function setShared(int $shared): self
    {
        $this->shared = $shared;

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
            $postUserCommentsHistory->setComment($this);
        }

        return $this;
    }

    public function removePostUserCommentsHistory(PostUserCommentsHistory $postUserCommentsHistory): self
    {
        if ($this->postUserCommentsHistories->removeElement($postUserCommentsHistory)) {
            // set the owning side to null (unless already changed)
            if ($postUserCommentsHistory->getComment() === $this) {
                $postUserCommentsHistory->setComment(null);
            }
        }

        return $this;
    }
}
