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

interface UploadFileSimple
{
    public function getLink();
    public function setLink($link);
    public function getPath();
    public function getFile();
    public function getId();
}
