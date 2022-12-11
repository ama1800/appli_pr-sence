<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\TeatcherRepository;

#[ORM\Entity(repositoryClass: TeatcherRepository::class)]
#[ApiResource]
class Teacher extends User
{
    #[ORM\OneToMany(mappedBy: 'teacher', targetEntity: Animation::class)]
    private Collection $animations;

    public function __construct()
    {
        parent::__construct();
        $this->animations = new ArrayCollection();
    }

    /**
     * @return Collection<int, Animation>
     */
    public function getAnimations(): Collection
    {
        return $this->animations;
    }

    public function addAnimation(Animation $animation): self
    {
        if (!$this->animations->contains($animation)) {
            $this->animations->add($animation);
            $animation->setTeacher($this);
        }

        return $this;
    }

    public function removeAnimation(Animation $animation): self
    {
        if ($this->animations->removeElement($animation)) {
            // set the owning side to null (unless already changed)
            if ($animation->getTeacher() === $this) {
                $animation->setTeacher(null);
            }
        }

        return $this;
    }
}
