<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 28/12/16
 * Time: 13:46
 */

namespace Utils\Interfaces;



use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadFileInterface extends UploadFileSimple
{
    public function setName($name);
}
