<?php

namespace App\Entity;

use App\Repository\VilleRepository;
// use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $ville_id = null;

    #[ORM\Column(length: 255)]
    private ?string $code_departement = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 250)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $test = null;

    // public function __construct()
    // {
    //     $this->ads = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->ville_id;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->code_departement;
    }

    public function setCodeDepartement(string $code_departement): static
    {
        $this->code_departement = $code_departement;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }


    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(string $test): static
    {
        $this->test = $test;

        return $this;
    }

}
