<?php

namespace GesProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends Controller
{
    public function loadCalendarAction(Request $request) {
        /**
         *
         * @param Request $request
         * @return Response
         */
        $em = $this->getDoctrine()->getManager();
        $events  = $em->getRepository('GesProjetBundle:Tache')->findAll();


        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $return_events = array();

        foreach ($events as $event) {
            $return_events[] = $event->toArray();
        }


        $response->setContent(json_encode($return_events));

        return $response;
    }

}
