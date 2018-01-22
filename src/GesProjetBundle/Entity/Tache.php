<?php

namespace GesProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass="GesProjetBundle\Repository\TacheRepository")
 */
class Tache
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
     * @ORM\Column(name="refTache", type="string", length=50)
     */
    private $refTache;

    /**
     * @var string
     *
     * @ORM\Column(name="DesignTache", type="string", length=50)
     */
    private $designTache;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DebutTache", type="date")
     */
    private $debutTache;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FinTache", type="date")
     */
    private $finTache;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=50)
     */
    private $etat;
    /**
     * @var Projet[]
     * @ORM\OneToMany(targetEntity= "\GesProjetBundle\Entity\Projet", mappedBy="personne")
     *
     */
    protected $projets;

    /**
     * @var Projet $projet
     * @ORM\ManyToOne(targetEntity= "\GesProjetBundle\Entity\Projet", inversedBy= "taches")
     *
     */
    protected $projet;

    /**
     * @return Projet[]
     */
    public function getProjets()
    {
        return $this->projets;
    }

    /**
     * @param Projet[] $projets
     */
    public function setProjets($projets)
    {
        $this->projets = $projets;
    }

    /**
     * @return Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * @param Projet $projet
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;
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
     * Set refTache
     *
     * @param string $refTache
     *
     * @return Tache
     */
    public function setRefTache($refTache)
    {
        $this->refTache = $refTache;

        return $this;
    }

    /**
     * Get refTache
     *
     * @return string
     */
    public function getRefTache()
    {
        return $this->refTache;
    }

    /**
     * Set designTache
     *
     * @param string $designTache
     *
     * @return Tache
     */
    public function setDesignTache($designTache)
    {
        $this->designTache = $designTache;

        return $this;
    }

    /**
     * Get designTache
     *
     * @return string
     */
    public function getDesignTache()
    {
        return $this->designTache;
    }

    /**
     * Set debutTache
     *
     * @param \DateTime $debutTache
     *
     * @return Tache
     */
    public function setDebutTache($debutTache)
    {
        $this->debutTache = $debutTache;

        return $this;
    }

    /**
     * Get debutTache
     *
     * @return \DateTime
     */
    public function getDebutTache()
    {
        return $this->debutTache;
    }

    /**
     * Set finTache
     *
     * @param \DateTime $finTache
     *
     * @return Tache
     */
    public function setFinTache($finTache)
    {
        $this->finTache = $finTache;

        return $this;
    }

    /**
     * Get finTache
     *
     * @return \DateTime
     */
    public function getFinTache()
    {
        return $this->finTache;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Tache
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
    public function toArray() {
        $event = array();

        if ($this->id !== null) {
            $event['id'] = $this->id;
        }

        $event['title'] = $this->designTache;
        $event['start'] = $this->debutTache->format("Y-m-d H:i:s");
        $event['end'] = $this->finTache->format("Y-m-d H:i:s");
        $event['className'] = 'label';
        $event['allDay'] = false;


        return $event;
    }
}

