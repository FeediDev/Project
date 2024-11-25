<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $ISBN = null;

    #[ORM\Column]
    private ?float $Prix = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'Livre')]
    private Collection $reservations;

    /**
     * @var Collection<int, QuantiteCommande>
     */
    #[ORM\OneToMany(targetEntity: QuantiteCommande::class, mappedBy: 'Livre')]
    private Collection $quantiteCommandes;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->quantiteCommandes = new ArrayCollection();
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setLivre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getLivre() === $this) {
                $reservation->setLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QuantiteCommande>
     */
    public function getQuantiteCommandes(): Collection
    {
        return $this->quantiteCommandes;
    }

    public function addQuantiteCommande(QuantiteCommande $quantiteCommande): static
    {
        if (!$this->quantiteCommandes->contains($quantiteCommande)) {
            $this->quantiteCommandes->add($quantiteCommande);
            $quantiteCommande->setLivre($this);
        }

        return $this;
    }

    public function removeQuantiteCommande(QuantiteCommande $quantiteCommande): static
    {
        if ($this->quantiteCommandes->removeElement($quantiteCommande)) {
            // set the owning side to null (unless already changed)
            if ($quantiteCommande->getLivre() === $this) {
                $quantiteCommande->setLivre(null);
            }
        }

        return $this;
    }
}
