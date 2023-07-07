<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DomaineRepository")
 */
class Domaine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $titre;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Projet", inversedBy="domaine", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $projet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="domaines")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $php;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domaineLocale;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vhost;

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPhp(): ?float
    {
        return $this->php;
    }

    public function setPhp(float $php): self
    {
        $this->php = $php;

        return $this;
    }

    public function getDomaineLocale(): ?string
    {
        return $this->domaineLocale;
    }

    public function setDomaineLocale(?string $domaineLocale): self
    {
        $this->domaineLocale = $domaineLocale;

        return $this;
    }

    public function getVhost(): ?bool
    {
        return $this->vhost;
    }

    public function setVhost(bool $vhost): self
    {
        $this->vhost = $vhost;

        return $this;
    }
}
