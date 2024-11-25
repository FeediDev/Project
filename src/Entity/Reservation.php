<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateRes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\ManyToOne(inversedBy: 'Reservation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livraison $Livraison = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Livre $Livre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDateRes(): ?\DateTimeInterface
    {
        return $this->dateRes;
    }

    public function setDateRes(\DateTimeInterface $dateRes): static
    {
        $this->dateRes = $dateRes;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

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

    public function getLivraison(): ?Livraison
    {
        return $this->Livraison;
    }

    public function setLivraison(Livraison $Livraison): static
    {
        $this->Livraison = $Livraison;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->Livre;
    }

    public function setLivre(?Livre $Livre): static
    {
        $this->Livre = $Livre;

        return $this;
    }
}
