<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\StudentRepository;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
#[ApiResource]
class Student extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'students')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?Classroom $classroom = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Draw::class)]
    private Collection $draw;

    public function __construct()
    {
        $this->draw = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Collection<int, Draw>
     */
    public function getDraw(): Collection
    {
        return $this->draw;
    }

    public function addDraw(Draw $draw): self
    {
        if (!$this->draw->contains($draw)) {
            $this->draw->add($draw);
            $draw->setStudent($this);
        }

        return $this;
    }

    public function removeDraw(Draw $draw): self
    {
        if ($this->draw->removeElement($draw)) {
            // set the owning side to null (unless already changed)
            if ($draw->getStudent() === $this) {
                $draw->setStudent(null);
            }
        }

        return $this;
    }

}
