<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DrawRepository;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ApiResource]
#[ORM\Entity(repositoryClass: DrawRepository::class)]
class Draw
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $toSearchAt = null;

    #[ORM\Column]
    private ?\DateTime $searchedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $stepCount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ceatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'draw')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    #[ORM\OneToOne(inversedBy: 'draw', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sheet $sheet = null;

    #[PrePersist]
    public function PrePersist()
    {
        $this->ceatedAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    #[PreUpdate]
    public function PreUpdate()
    {
        $this->updatedAt = new DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToSearchAt(): ?\DateTime
    {
        return $this->toSearchAt;
    }

    public function setToSearchAt(\DateTime $toSearchAt): self
    {
        $this->toSearchAt = $toSearchAt;

        return $this;
    }

    public function getSearchedAt(): ?\DateTime
    {
        return $this->searchedAt;
    }

    public function setSearchedAt(\DateTime $searchedAt): self
    {
        $this->searchedAt = $searchedAt;

        return $this;
    }

    public function getStepCount(): ?int
    {
        return $this->stepCount;
    }

    public function setStepCount(?int $stepCount): self
    {
        $this->stepCount = $stepCount;

        return $this;
    }

    public function getCeatedAt(): ?\DateTimeImmutable
    {
        return $this->ceatedAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getSheet(): ?Sheet
    {
        return $this->sheet;
    }

    public function setSheet(Sheet $sheet): self
    {
        $this->sheet = $sheet;

        return $this;
    }
}
