<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MuseumRepository")
 */
class Museum
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $nameMuseum;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $histoireMuseum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageMuseum;

    /**
     * @Gedmo\Slug(fields={"nameMuseum"})
     * @ORM\Column(type="string", length=32)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Oeuvre", mappedBy="museum")
     */
    private $oeuvres;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nameMuseum;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMuseum(): ?string
    {
        return $this->nameMuseum;
    }

    public function setNameMuseum(string $nameMuseum): self
    {
        $this->nameMuseum = $nameMuseum;

        return $this;
    }

    public function getHistoireMuseum(): ?string
    {
        return $this->histoireMuseum;
    }

    public function setHistoireMuseum(?string $histoireMuseum): self
    {
        $this->histoireMuseum = $histoireMuseum;

        return $this;
    }

    public function getImageMuseum(): ?string
    {
        return $this->imageMuseum;
    }

    public function setImageMuseum(?string $imageMuseum): self
    {
        $this->imageMuseum = $imageMuseum;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Oeuvre[]
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
            $oeuvre->addMuseum($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): self
    {
        if ($this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->removeElement($oeuvre);
            $oeuvre->removeMuseum($this);
        }

        return $this;
    }
}
