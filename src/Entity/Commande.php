<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateC = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'Commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, QuantiteCommande>
     */
    #[ORM\OneToMany(targetEntity: QuantiteCommande::class, mappedBy: 'commande')]
    private Collection $QuantiteCommande;

    public function __construct()
    {
        $this->QuantiteCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(\DateTimeInterface $dateC): static
    {
        $this->dateC = $dateC;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, QuantiteCommande>
     */
    public function getQuantiteCommande(): Collection
    {
        return $this->QuantiteCommande;
    }

    public function addQuantiteCommande(QuantiteCommande $quantiteCommande): static
    {
        if (!$this->QuantiteCommande->contains($quantiteCommande)) {
            $this->QuantiteCommande->add($quantiteCommande);
            $quantiteCommande->setCommande($this);
        }

        return $this;
    }

    public function removeQuantiteCommande(QuantiteCommande $quantiteCommande): static
    {
        if ($this->QuantiteCommande->removeElement($quantiteCommande)) {
            // set the owning side to null (unless already changed)
            if ($quantiteCommande->getCommande() === $this) {
                $quantiteCommande->setCommande(null);
            }
        }

        return $this;
    }
}
