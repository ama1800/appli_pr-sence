<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SheetRepository;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ApiResource]
#[ORM\Entity(repositoryClass: SheetRepository::class)]
class Sheet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endAt = null;

    #[ORM\Column]
    private ?int $week = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ceatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'sheet', cascade: ['persist', 'remove'])]
    private ?Draw $draw = null;

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

    public function getStartAt(): ?DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function setWeek(int $week): self
    {
        $this->week = $week;

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

    public function getDraw(): ?Draw
    {
        return $this->draw;
    }

    public function setDraw(Draw $draw): self
    {
        // set the owning side of the relation if necessary
        if ($draw->getSheet() !== $this) {
            $draw->setSheet($this);
        }

        $this->draw = $draw;

        return $this;
    }
}
