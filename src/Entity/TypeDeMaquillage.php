<?php

namespace App\Entity;

use App\Repository\TypeDeMaquillageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeDeMaquillageRepository::class)]
class TypeDeMaquillage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isSoiree = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isMariage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isOccasion = null;

    #[ORM\ManyToOne(inversedBy: 'typeDeMaquillage')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mariee $mariee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsSoiree(): ?bool
    {
        return $this->isSoiree;
    }

    public function setIsSoiree(?bool $isSoiree): self
    {
        $this->isSoiree = $isSoiree;

        return $this;
    }

    public function isIsMariage(): ?bool
    {
        return $this->isMariage;
    }

    public function setIsMariage(?bool $isMariage): self
    {
        $this->isMariage = $isMariage;

        return $this;
    }

    public function isIsOccasion(): ?bool
    {
        return $this->isOccasion;
    }

    public function setIsOccasion(?bool $isOccasion): self
    {
        $this->isOccasion = $isOccasion;

        return $this;
    }

    public function getMariee(): ?Mariee
    {
        return $this->mariee;
    }

    public function setMariee(?Mariee $mariee): self
    {
        $this->mariee = $mariee;

        return $this;
    }
}
