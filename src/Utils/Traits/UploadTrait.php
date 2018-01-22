<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 15/05/2017
 * Time: 10:56
 */

namespace Utils\Traits;


use Symfony\Component\HttpFoundation\File\File;
use Utils\Interfaces\UploadFileInterface;

trait UploadTrait
{
    private $baseDir;
    private $file;
    public function getBaseDir(){
        return $this->baseDir;
    }

    public function setBaseDir( $baseDir){
        $this->baseDir = $baseDir;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return UploadTrait
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

}