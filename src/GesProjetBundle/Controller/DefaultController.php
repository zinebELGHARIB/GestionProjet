<?php

namespace GesProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GesProjetBundle:Default:index.html.twig');
    }
}
