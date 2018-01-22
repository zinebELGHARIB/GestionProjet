<?php

namespace Utils\Traits;
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 5/7/17
 * Time: 7:14 PM
 */

use Doctrine\ORM\Mapping as ORM;

trait Referer {
    private function getRefererParams() {
        $request = $this->getRequest();
        $referer = $request->headers->get('referer');
        //$baseUrl = $request->getBaseUrl();
        $baseUrl = $request->getSchemeAndHttpHost();


        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));
        //dump($lastPath, $referer, $baseUrl); die();
        return $this->get('router')->getMatcher()->match($lastPath);
    }

    private function getRequest(){
        return $this->get('request_stack')->getCurrentRequest();
    }
}
