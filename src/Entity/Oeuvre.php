<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OeuvreRepository")
 */
class Oeuvre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $nameArt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateArt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionArt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $informationArt;

    /**
     * @Gedmo\Slug(fields={"nameArt"})
     * @ORM\Column(type="string", length=32)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageArt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", inversedBy="oeuvres")
     */
    private $artiste;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Museum", inversedBy="oeuvres")
     */
    private $museum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="oeuvre")
     */
    private $comments;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
        $this->museum = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nameArt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameArt(): ?string
    {
        return $this->nameArt;
    }

    public function setNameArt(string $nameArt): self
    {
        $this->nameArt = $nameArt;

        return $this;
    }

    public function getDateArt(): ?\DateTimeInterface
    {
        return $this->dateArt;
    }

    public function setDateArt(?\DateTimeInterface $dateArt): self
    {
        $this->dateArt = $dateArt;

        return $this;
    }

    public function getDescriptionArt(): ?string
    {
        return $this->descriptionArt;
    }

    public function setDescriptionArt(?string $descriptionArt): self
    {
        $this->descriptionArt = $descriptionArt;

        return $this;
    }

    public function getInformationArt(): ?string
    {
        return $this->informationArt;
    }

    public function setInformationArt(?string $informationArt): self
    {
        $this->informationArt = $informationArt;

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

    public function getImageArt(): ?string
    {
        return $this->imageArt;
    }

    public function setImageArt(?string $imageArt): self
    {
        $this->imageArt = $imageArt;

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste[] = $artiste;
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artiste->contains($artiste)) {
            $this->artiste->removeElement($artiste);
        }

        return $this;
    }

    /**
     * @return Collection|Museum[]
     */
    public function getMuseum(): Collection
    {
        return $this->museum;
    }

    public function addMuseum(Museum $museum): self
    {
        if (!$this->museum->contains($museum)) {
            $this->museum[] = $museum;
        }

        return $this;
    }

    public function removeMuseum(Museum $museum): self
    {
        if ($this->museum->contains($museum)) {
            $this->museum->removeElement($museum);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setOeuvre($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getOeuvre() === $this) {
                $comment->setOeuvre(null);
            }
        }

        return $this;
    }
}
