<?php

namespace App\Entity;

use App\Repository\DemandeDeDevisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeDeDevisRepository::class)]
class DemandeDeDevis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreDePersonne = null;

    #[ORM\ManyToOne(inversedBy: 'demandeDeDevis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mariee $mariee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDePersonne(): ?int
    {
        return $this->nombreDePersonne;
    }

    public function setNombreDePersonne(?int $nombreDePersonne): self
    {
        $this->nombreDePersonne = $nombreDePersonne;

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
