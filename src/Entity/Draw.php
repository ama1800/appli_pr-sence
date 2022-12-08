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
    private ?DateTimeImmutable $toSearchAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $searchedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $stepCount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ceatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[PrePersist]
    public function PrePersist()
    {
        $this->createdAt = new DateTimeImmutable();
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
}
