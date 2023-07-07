<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chemin_local;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domaine_local;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_admin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $identifiant_admin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mdp_admin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nom_bdd;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $identifiant_bdd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mdp_bdd;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Domaine", mappedBy="projet", cascade={"persist", "remove"})
     */
    private $domaine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hebergement", inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hebergement;

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

    public function getCheminLocal(): ?string
    {
        return $this->chemin_local;
    }

    public function setCheminLocal(string $chemin_local): self
    {
        $this->chemin_local = $chemin_local;

        return $this;
    }

    public function getDomaineLocal(): ?string
    {
        return $this->domaine_local;
    }

    public function setDomaineLocal(string $domaine_local): self
    {
        $this->domaine_local = $domaine_local;

        return $this;
    }

    public function getUrlAdmin(): ?string
    {
        return $this->url_admin;
    }

    public function setUrlAdmin(?string $url_admin): self
    {
        $this->url_admin = $url_admin;

        return $this;
    }

    public function getIdentifiantAdmin(): ?string
    {
        return $this->identifiant_admin;
    }

    public function setIdentifiantAdmin(?string $identifiant_admin): self
    {
        $this->identifiant_admin = $identifiant_admin;

        return $this;
    }

    public function getMdpAdmin(): ?string
    {
        return $this->mdp_admin;
    }

    public function setMdpAdmin(?string $mdp_admin): self
    {
        $this->mdp_admin = $mdp_admin;

        return $this;
    }

    public function getNomBdd(): ?string
    {
        return $this->nom_bdd;
    }

    public function setNomBdd(?string $nom_bdd): self
    {
        $this->nom_bdd = $nom_bdd;

        return $this;
    }

    public function getIdentifiantBdd(): ?string
    {
        return $this->identifiant_bdd;
    }

    public function setIdentifiantBdd(?string $identifiant_bdd): self
    {
        $this->identifiant_bdd = $identifiant_bdd;

        return $this;
    }

    public function getMdpBdd(): ?string
    {
        return $this->mdp_bdd;
    }

    public function setMdpBdd(?string $mdp_bdd): self
    {
        $this->mdp_bdd = $mdp_bdd;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(Domaine $domaine): self
    {
        $this->domaine = $domaine;

        // set the owning side of the relation if necessary
        if ($this !== $domaine->getProjet()) {
            $domaine->setProjet($this);
        }

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

    public function getHebergement(): ?Hebergement
    {
        return $this->hebergement;
    }

    public function setHebergement(?Hebergement $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }
}
