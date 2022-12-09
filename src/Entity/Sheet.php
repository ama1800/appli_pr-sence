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

    #[ORM\OneToMany(mappedBy: 'sheet', targetEntity: Signature::class, orphanRemoval: true)]
    private Collection $signatures;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Draw $draw_sheet = null;

    public function __construct()
    {
        $this->signatures = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Signature>
     */
    public function getSignatures(): Collection
    {
        return $this->signatures;
    }

    public function addSignature(Signature $signature): self
    {
        if (!$this->signatures->contains($signature)) {
            $this->signatures->add($signature);
            $signature->setSheet($this);
        }

        return $this;
    }

    public function removeSignature(Signature $signature): self
    {
        if ($this->signatures->removeElement($signature)) {
            // set the owning side to null (unless already changed)
            if ($signature->getSheet() === $this) {
                $signature->setSheet(null);
            }
        }

        return $this;
    }

    public function getDrawSheet(): ?Draw
    {
        return $this->draw_sheet;
    }

    public function setDrawSheet(Draw $draw_sheet): self
    {
        $this->draw_sheet = $draw_sheet;

        return $this;
    }
}
