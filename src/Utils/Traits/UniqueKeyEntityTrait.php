<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 16/08/2017
 * Time: 14:55
 */

namespace Utils\Traits;


Trait UniqueKeyEntityTrait
{
    public function keyClass(){

        return get_class($this) .':'. $this->getId();
    }
}