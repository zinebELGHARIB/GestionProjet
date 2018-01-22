<?php

namespace GesProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="GesProjetBundle\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="RefProjet", type="string", length=50)
     */
    private $refProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="DesignProjet", type="string", length=50)
     */
    private $designProjet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DebutProjet", type="date")
     */
    private $debutProjet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FinProjet", type="date")
     */
    private $finProjet;



    /**
     * @var Personne $personne
     * @ORM\ManyToOne(targetEntity= "\GesProjetBundle\Entity\Personne", inversedBy= "projets")
     *
     */
    protected $personne;



    /**
     * @var Tache[]
     * @ORM\OneToMany(targetEntity= "\GesProjetBundle\Entity\Tache", mappedBy="projet")
     *
     */
    protected $taches;

    /**
     * @return Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param Personne $personne
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set refProjet
     *
     * @param string $refProjet
     *
     * @return Projet
     */
    public function setRefProjet($refProjet)
    {
        $this->refProjet = $refProjet;

        return $this;
    }

    /**
     * Get refProjet
     *
     * @return string
     */
    public function getRefProjet()
    {
        return $this->refProjet;
    }

    /**
     * Set designProjet
     *
     * @param string $designProjet
     *
     * @return Projet
     */
    public function setDesignProjet($designProjet)
    {
        $this->designProjet = $designProjet;

        return $this;
    }

    /**
     * Get designProjet
     *
     * @return string
     */
    public function getDesignProjet()
    {
        return $this->designProjet;
    }

    /**
     * Set debutProjet
     *
     * @param \DateTime $debutProjet
     *
     * @return Projet
     */
    public function setDebutProjet($debutProjet)
    {
        $this->debutProjet = $debutProjet;

        return $this;
    }

    /**
     * Get debutProjet
     *
     * @return \DateTime
     */
    public function getDebutProjet()
    {
        return $this->debutProjet;
    }

    /**
     * Set finProjet
     *
     * @param \DateTime $finProjet
     *
     * @return Projet
     */
    public function setFinProjet($finProjet)
    {
        $this->finProjet = $finProjet;

        return $this;
    }

    /**
     * Get finProjet
     *
     * @return \DateTime
     */
    public function getFinProjet()
    {
        return $this->finProjet;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getRefProjet();
    }


}

