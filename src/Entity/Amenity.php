<?php

namespace App\Entity;

use App\Repository\AmenityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmenityRepository::class)
 */
class Amenity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\ManyToMany(targetEntity=Accomodation::class, mappedBy="amenity")
     */
    private $accomodations;

    public function __construct()
    {
        $this->accomodations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection|Accomodation[]
     */
    public function getAccomodations(): Collection
    {
        return $this->accomodations;
    }

    public function addAccomodation(Accomodation $accomodation): self
    {
        if (!$this->accomodations->contains($accomodation)) {
            $this->accomodations[] = $accomodation;
            $accomodation->addAmenity($this);
        }

        return $this;
    }

    public function removeAccomodation(Accomodation $accomodation): self
    {
        if ($this->accomodations->removeElement($accomodation)) {
            $accomodation->removeAmenity($this);
        }

        return $this;
    }
}
