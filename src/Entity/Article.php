<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $nameArticle;

    /**
     * @ORM\Column(type="text")
     */
    private $textArticle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressImgArticle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameArticle(): ?string
    {
        return $this->nameArticle;
    }

    public function setNameArticle(string $nameArticle): self
    {
        $this->nameArticle = $nameArticle;

        return $this;
    }

    public function getTextArticle(): ?string
    {
        return $this->textArticle;
    }

    public function setTextArticle(string $textArticle): self
    {
        $this->textArticle = $textArticle;

        return $this;
    }

    public function getAdressImgArticle(): ?string
    {
        return $this->adressImgArticle;
    }

    public function setAdressImgArticle(?string $adressImgArticle): self
    {
        $this->adressImgArticle = $adressImgArticle;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
