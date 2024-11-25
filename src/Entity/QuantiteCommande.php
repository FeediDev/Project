<?php

namespace App\Entity;

use App\Repository\QuantiteCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuantiteCommandeRepository::class)]
class QuantiteCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Quantitee = null;

    #[ORM\ManyToOne(inversedBy: 'QuantiteCommande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'quantiteCommandes')]
    #[ORM\JoinColumn(nullable: false)]
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

    public function getQuantitee(): ?int
    {
        return $this->Quantitee;
    }

    public function setQuantitee(int $Quantitee): static
    {
        $this->Quantitee = $Quantitee;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

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
