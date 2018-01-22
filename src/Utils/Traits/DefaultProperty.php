<?php

namespace Utils\Traits;
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 5/7/17
 * Time: 7:14 PM
 */

use Doctrine\ORM\Mapping as ORM;

trait DefaultProperty
{
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean",nullable=true,options={"default"=false})
     *
     */
    protected $deleted = false;

    /**
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param boolean $deleted
     * @return DefaultProperty
     */
    public function setDeleted($deleted = false)
    {
        $this->deleted = $deleted;
        return $this;
    }
}