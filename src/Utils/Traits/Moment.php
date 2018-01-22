<?php

namespace Utils\Traits;
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 5/7/17
 * Time: 7:14 PM
 */

use Doctrine\ORM\Mapping as ORM;


trait Moment
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     * @ORM\OrderBy({"sort_order" = "DESC"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected  $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Moment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}