<?php
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 10/28/17
 * Time: 12:47 PM
 */

namespace UserBundle\Entity;


use CarteBundle\Entity\DossierEtape;
use CarteBundle\Entity\Site;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Utils\Traits\DefaultProperty;
use Utils\Traits\Moment;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



//    /**
//     * One User has One Agent.
//     * @ORM\OneToOne(targetEntity="PersonneBundle\Entity\Personne", inversedBy="user")
//     * @ORM\JoinColumn(name="agent_id", referencedColumnName="id")
//     */
//    private $agent;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set agent
     *
     * @param \PersonneBundle\Entity\Personne $agent
     *
     * @return User
     */
    public function setAgent(\PersonneBundle\Entity\Personne $agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \PersonneBundle\Entity\Personne
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }



}
