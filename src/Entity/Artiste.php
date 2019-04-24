<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
 */
class Artiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nameArtist;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioArtiste;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $century;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageArtiste;

    /**
     * @Gedmo\Slug(fields={"nameArtist"})
     * @ORM\Column(type="string", length=32)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Oeuvre", mappedBy="artiste")
     */
    private $oeuvres;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->nameArtist;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameArtist(): ?string
    {
        return $this->nameArtist;
    }

    public function setNameArtist(string $nameArtist): self
    {
        $this->nameArtist = $nameArtist;

        return $this;
    }

    public function getBioArtiste(): ?string
    {
        return $this->bioArtiste;
    }

    public function setBioArtiste(?string $bioArtiste): self
    {
        $this->bioArtiste = $bioArtiste;

        return $this;
    }

    public function getCentury(): ?int
    {
        return $this->century;
    }

    public function setCentury(?int $century): self
    {
        $this->century = $century;

        return $this;
    }

    public function getImageArtiste(): ?string
    {
        return $this->imageArtiste;
    }

    public function setImageArtiste(?string $imageArtiste): self
    {
        $this->imageArtiste = $imageArtiste;

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
            $oeuvre->addArtiste($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): self
    {
        if ($this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->removeElement($oeuvre);
            $oeuvre->removeArtiste($this);
        }

        return $this;
    }
}
