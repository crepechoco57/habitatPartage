<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'Departement', targetEntity: Ville::class)]
    private Collection $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    // #[ORM\Column(length: 255)]
    // private ?string $test = null;
    // /**
    //  * @ORM\OneToMany(targetEntity="Ville", mappedBy="departement")
    //  */
    // private Collection $villes;

    // public function __construct()
    // {
    //     $this->villes = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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

    // public function getTest(): ?string
    // {
    //     return $this->test;
    // }

    // public function setTest(string $test): static
    // {
    //     $this->test = $test;

    //     return $this;
    // }
    //  /**
    //  * @return Collection|Ville[]
    //  */
    // public function getVilles(): Collection
    // {
    //     return $this->villes;
    // }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->setDepartement($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getDepartement() === $this) {
                $ville->setDepartement(null);
            }
        }

        return $this;
    }
}
