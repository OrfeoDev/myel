<?php

namespace App\Entity;

use App\Repository\MarieeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MarieeRepository::class)]
class Mariee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;
/**
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre Nom ne doit pas contenir de chiffre"
     * )
     */
    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    /**
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prenom ne doit pas contenir de chiffre"
     * )
     */

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(length: 14)]
    private ?string $telephone = null;
    
    /** 
     *  @Assert\GreaterThan("+10 days",
     * message="La date du mariage doit etre superieure a 10 jours ")
     * 
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateMariage = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptif = null;

    #[ORM\OneToMany(mappedBy: 'mariee', targetEntity: Commentaires::class, orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\OneToMany(mappedBy: 'mariee', targetEntity: TypeDeMaquillage::class)]
    private Collection $typeDeMaquillage;

    #[ORM\OneToMany(mappedBy: 'mariee', targetEntity: DemandeDeDevis::class)]
    private Collection $demandeDeDevis;

    #[ORM\OneToMany(mappedBy: 'mariee', targetEntity: Images::class)]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'mariee')]
    private ?DemandeStatut $demandeStatut = null;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->typeDeMaquillage = new ArrayCollection();
        $this->demandeDeDevis = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateMariage(): ?\DateTimeInterface
    {
        return $this->dateMariage;
    }

    public function setDateMariage(\DateTimeInterface $dateMariage): self
    {
        $this->dateMariage = $dateMariage;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setMariee($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getMariee() === $this) {
                $commentaire->setMariee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeDeMaquillage>
     */
    public function getTypeDeMaquillage(): Collection
    {
        return $this->typeDeMaquillage;
    }

    public function addTypeDeMaquillage(TypeDeMaquillage $typeDeMaquillage): self
    {
        if (!$this->typeDeMaquillage->contains($typeDeMaquillage)) {
            $this->typeDeMaquillage[] = $typeDeMaquillage;
            $typeDeMaquillage->setMariee($this);
        }

        return $this;
    }

    public function removeTypeDeMaquillage(TypeDeMaquillage $typeDeMaquillage): self
    {
        if ($this->typeDeMaquillage->removeElement($typeDeMaquillage)) {
            // set the owning side to null (unless already changed)
            if ($typeDeMaquillage->getMariee() === $this) {
                $typeDeMaquillage->setMariee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandeDeDevis>
     */
    public function getDemandeDeDevis(): Collection
    {
        return $this->demandeDeDevis;
    }

    public function addDemandeDeDevi(DemandeDeDevis $demandeDeDevi): self
    {
        if (!$this->demandeDeDevis->contains($demandeDeDevi)) {
            $this->demandeDeDevis[] = $demandeDeDevi;
            $demandeDeDevi->setMariee($this);
        }

        return $this;
    }

    public function removeDemandeDeDevi(DemandeDeDevis $demandeDeDevi): self
    {
        if ($this->demandeDeDevis->removeElement($demandeDeDevi)) {
            // set the owning side to null (unless already changed)
            if ($demandeDeDevi->getMariee() === $this) {
                $demandeDeDevi->setMariee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setMariee($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getMariee() === $this) {
                $image->setMariee(null);
            }
        }

        return $this;
    }

    public function getDemandeStatut(): ?DemandeStatut
    {
        return $this->demandeStatut;
    }

    public function setDemandeStatut(?DemandeStatut $demandeStatut): self
    {
        $this->demandeStatut = $demandeStatut;

        return $this;
    }
}
