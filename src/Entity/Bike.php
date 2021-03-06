<?php

namespace App\Entity;

use App\Repository\BikeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=BikeRepository::class)
 */
class Bike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $marque;
    
    // on REDIGE LA CONTRAINTE 

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Ce champ est requis")
     * @Assert\Length(
     *  min = 2,
     *  max = 12,
     *  minMessage = "le modèle doit comporter au moins {{ limit }} charactères ",
     *  maxMessage = "le modèle doit comporter au plus {{ limit }} charactères ",
     * )
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $pays;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
