<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HebergementRepository")
 */
class Hebergement
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_admin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_admin_pwd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_tech;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_tech_pwd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_prop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nic_prop_pwd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ftp_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ftp_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ftp_pass;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mysql_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mysql_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mysql_pass;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mysql_serveur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="hebergement", orphanRemoval=true)
     */
    private $projets;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $propriete_client;
    
    public function __toString()
    {
        return $this->titre;
    }

    public function __construct()
    {
        $this->projets = new ArrayCollection();
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

    public function getNicAdmin(): ?string
    {
        return $this->nic_admin;
    }

    public function setNicAdmin(string $nic_admin): self
    {
        $this->nic_admin = $nic_admin;

        return $this;
    }

    public function getNicAdminPwd(): ?string
    {
        return $this->nic_admin_pwd;
    }

    public function setNicAdminPwd(string $nic_admin_pwd): self
    {
        $this->nic_admin_pwd = $nic_admin_pwd;

        return $this;
    }

    public function getNicTech(): ?string
    {
        return $this->nic_tech;
    }

    public function setNicTech(string $nic_tech): self
    {
        $this->nic_tech = $nic_tech;

        return $this;
    }

    public function getNicTechPwd(): ?string
    {
        return $this->nic_tech_pwd;
    }

    public function setNicTechPwd(string $nic_tech_pwd): self
    {
        $this->nic_tech_pwd = $nic_tech_pwd;

        return $this;
    }

    public function getNicProp(): ?string
    {
        return $this->nic_prop;
    }

    public function setNicProp(string $nic_prop): self
    {
        $this->nic_prop = $nic_prop;

        return $this;
    }

    public function getNicPropPwd(): ?string
    {
        return $this->nic_prop_pwd;
    }

    public function setNicPropPwd(string $nic_prop_pwd): self
    {
        $this->nic_prop_pwd = $nic_prop_pwd;

        return $this;
    }

    public function getFtpAdresse(): ?string
    {
        return $this->ftp_adresse;
    }

    public function setFtpAdresse(string $ftp_adresse): self
    {
        $this->ftp_adresse = $ftp_adresse;

        return $this;
    }

    public function getFtpId(): ?string
    {
        return $this->ftp_id;
    }

    public function setFtpId(string $ftp_id): self
    {
        $this->ftp_id = $ftp_id;

        return $this;
    }

    public function getFtpPass(): ?string
    {
        return $this->ftp_pass;
    }

    public function setFtpPass(string $ftp_pass): self
    {
        $this->ftp_pass = $ftp_pass;

        return $this;
    }

    public function getMysqlAdresse(): ?string
    {
        return $this->mysql_adresse;
    }

    public function setMysqlAdresse(?string $mysql_adresse): self
    {
        $this->mysql_adresse = $mysql_adresse;

        return $this;
    }

    public function getMysqlId(): ?string
    {
        return $this->mysql_id;
    }

    public function setMysqlId(string $mysql_id): self
    {
        $this->mysql_id = $mysql_id;

        return $this;
    }

    public function getMysqlPass(): ?string
    {
        return $this->mysql_pass;
    }

    public function setMysqlPass(string $mysql_pass): self
    {
        $this->mysql_pass = $mysql_pass;

        return $this;
    }

    public function getMysqlServeur(): ?string
    {
        return $this->mysql_serveur;
    }

    public function setMysqlServeur(?string $mysql_serveur): self
    {
        $this->mysql_serveur = $mysql_serveur;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setHebergement($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getHebergement() === $this) {
                $projet->setHebergement(null);
            }
        }

        return $this;
    }

    public function getProprieteClient(): ?bool
    {
        return $this->propriete_client;
    }

    public function setProprieteClient(?bool $propriete_client): self
    {
        $this->propriete_client = $propriete_client;

        return $this;
    }
}
