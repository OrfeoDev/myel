<?php

namespace App\Entity;

use App\Repository\DemandeStatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeStatutRepository::class)]
class DemandeStatut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $valeur = null;

    #[ORM\OneToMany(mappedBy: 'demandeStatut', targetEntity: Mariee::class)]
    private Collection $mariee;

    public function __construct()
    {
        $this->mariee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @return Collection<int, Mariee>
     */
    public function getMariee(): Collection
    {
        return $this->mariee;
    }

    public function addMariee(Mariee $mariee): self
    {
        if (!$this->mariee->contains($mariee)) {
            $this->mariee[] = $mariee;
            $mariee->setDemandeStatut($this);
        }

        return $this;
    }

    public function removeMariee(Mariee $mariee): self
    {
        if ($this->mariee->removeElement($mariee)) {
            // set the owning side to null (unless already changed)
            if ($mariee->getDemandeStatut() === $this) {
                $mariee->setDemandeStatut(null);
            }
        }

        return $this;
    }
}
