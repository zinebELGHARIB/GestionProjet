<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 28/12/16
 * Time: 14:08
 */

namespace Utils\Handlers;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreRemove;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\MonologBundle\DependencyInjection\MonologExtension;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RequestContext;
use Utils\Interfaces\UploadFileInterface;
use Utils\Interfaces\UploadFileSimple;

class UploadFileListenner
{
    private $webRoot;
    private $temp;
    private $secret;
    private $serializer;

    public function __construct($webRoot,$secret,Serializer $serializer)

    {
        $lastRoot = substr($webRoot,-1);
        // enleve le '/' ou '\' a la fin de webRoot
        $this->webRoot = '/'==$lastRoot  || '\\'== $lastRoot? substr($webRoot,0,strlen($webRoot)-1) : $webRoot ;
        if(is_dir($this->webRoot)){
            @mkdir($this->webRoot,0777,true);
        }

        $this->secret = $secret;
        $this->temp = null;
        $this->serializer = $serializer;

    }


    public function prePersist(LifecycleEventArgs $args)
    {
            $entity = $args->getEntity();
            if($entity instanceof UploadFileSimple)
                $this->createResource($entity);


    }


    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof UploadFileSimple)
            $this->createResource($entity);
    }


    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if($entity && $entity instanceof UploadFileSimple)
           $this->temp = $entity->getLink();
    }


    public function postRemove(LifecycleEventArgs $args){
            $this->removeFile();
    }


    /**
     * Elle permet de supprimer trous les fichiers se trouvant dans le répertoire
     * de l'entité et de la supprimer cet dernier.
     */
    public function removeFile(){
        if(null != $this->temp && file_exists($this->decryptLink($this->temp))){
            @unlink($this->decryptLink($this->temp));
            $this->temp = null;
        }
    }

    /**
     * @param $entity
     * @return boolean
     * verifier si l'entité implement la l'interface UploadFileSimple.
     * Dans ce cas ,il verifier si l'entité charge un fichier
     * si oui ,enclanche l'enregistrement du fichier et passe son lien a l'objet
     */
    private function createResource(UploadFileSimple $entity)
    {
        // upload only works for Product entitie
        $file = $entity->getFile();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return false;
        }

        // delete old link
        if($entity->getLink()){
            $this->temp = $entity->getLink();
            $this->removeFile();
        }

        // set file name if interface is UploadFileInterface
        if($entity instanceof UploadFileInterface){
            $entity->setName($file->getClientOriginalName());
        }

        $extension = explode('.',$file->getClientOriginalName());
        // create generique name to file in the systeme
        $filename = md5(uniqid()) . '.' . $extension[count($extension) - 1];
        $baseLink = $this->webRoot . DIRECTORY_SEPARATOR . $entity->getPath();
       if($file->move($baseLink,$filename))
       {
           $fullFilename = $baseLink.DIRECTORY_SEPARATOR.$filename;
           $encryptLink = $this->encryptLink($fullFilename);
           $entity->setLink($encryptLink);
           return true;
       }
       return false;
    }




    public function entityToFile(UploadFileSimple $entity){
        try{
        return new File($this->decryptLink($entity->getLink()),true);
        }catch (\Exception $e){
            return false;
        }
    }

    public function encryptLink($data){
        return urlencode(hash ('SHA256' , $this->secret).base64_encode($data));
    }
    public function decryptLink($encryptLink){
        return base64_decode(str_replace(hash ('SHA256' , $this->secret),'',urldecode($encryptLink)));
    }

    static function decryptLinkWithSecret($encryptLink,$secret){
        return base64_decode(str_replace(hash ('SHA256' , $secret),'',urldecode($encryptLink)));
    }

    static  function makeRecursiveDir($dir){
        $arrayDire = explode('/',$dir);
        $link='';
        $out = true;
        if(count($arrayDire)){
            foreach($arrayDire as $item){
                $link += '/' . $item;
                if(!is_dir($link)){
                   $out = $out && @mkdir($link);
                }
            }
            return $out;
        }else{
            return false;
        }

    }


}