<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\TeatcherRepository;

#[ORM\Entity(repositoryClass: TeatcherRepository::class)]
#[ApiResource]
class Teatcher extends User
{
}
