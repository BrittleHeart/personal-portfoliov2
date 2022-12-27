<?php

namespace App\Entity;

use App\Repository\PersonalInfoRepository;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalInfoRepository::class)]
class PersonalInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $work_as = null;

    #[ORM\Column(length: 255)]
    private ?string $university = null;

    /**
     * @var array<string|int, string> $socials
     */
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $socials = [];

    /**
     * @var array<array<string|int, string>> $skills
     */
    #[ORM\Column(type: Types::JSON)]
    private array $skills = [];

    /**
     * @var array<array<string|int, string>> $projects
     */
    #[ORM\Column(type: Types::JSON)]
    private array $projects = [];

    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(length: 255)]
    private ?string $work_for = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $work_from = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $work_to = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkAs(): ?string
    {
        return $this->work_as;
    }

    public function setWorkAs(string $work_as): self
    {
        $this->work_as = $work_as;

        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(string $university): self
    {
        $this->university = $university;

        return $this;
    }

    /**
     * @return array<string|int, string>
     */
    public function getSocials(): array
    {
        return $this->socials;
    }

    /**
     * @param array<string|int, string> $socials
     * @return self
     */
    public function setSocials(?array $socials): self
    {
        $this->socials = $socials;

        return $this;
    }

    /**
     * @return array<array<string|int, string>>
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @param array<array<string|int, string>> $skills
     * @return self
     */
    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * @return array<array<string|int, string>>
     */
    public function getProjects(): array
    {
        return $this->projects;
    }

    /**
     * @param array<array<string|int, string>> $projects
     * @return self
     */
    public function setProjects(array $projects): self
    {
        $this->projects = $projects;

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

    public function getWorkFor(): ?string
    {
        return $this->work_for;
    }

    public function setWorkFor(string $work_for): self
    {
        $this->work_for = $work_for;

        return $this;
    }

    public function getWorkFrom(): ?\DateTimeInterface
    {
        return $this->work_from;
    }

    public function setWorkFrom(\DateTimeInterface $work_from): self
    {
        $this->work_from = $work_from;

        return $this;
    }

    public function getWorkTo(): ?\DateTimeInterface
    {
        return $this->work_to;
    }

    public function setWorkTo(?\DateTimeInterface $work_to): self
    {
        $this->work_to = $work_to;

        return $this;
    }
}
