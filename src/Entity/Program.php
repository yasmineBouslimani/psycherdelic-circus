<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 */
class Program
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="programs")
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="programs")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="program")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProgramPrice", mappedBy="programs")
     */
    private $programPrices;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->programPrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

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
            $comment->setProgram($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProgram() === $this) {
                $comment->setProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProgramPrice[]
     */
    public function getProgramPrices(): Collection
    {
        return $this->programPrices;
    }

    public function addProgramPrice(ProgramPrice $programPrice): self
    {
        if (!$this->programPrices->contains($programPrice)) {
            $this->programPrices[] = $programPrice;
            $programPrice->setPrograms($this);
        }

        return $this;
    }

    public function removeProgramPrice(ProgramPrice $programPrice): self
    {
        if ($this->programPrices->contains($programPrice)) {
            $this->programPrices->removeElement($programPrice);
            // set the owning side to null (unless already changed)
            if ($programPrice->getPrograms() === $this) {
                $programPrice->setPrograms(null);
            }
        }

        return $this;
    }
}
