<?php

namespace GesProjetBundle\Controller;

use GesProjetBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tache controller.
 *
 * @Route("tache")
 */
class TacheController extends Controller
{
    /**
     * Lists all tache entities.
     *
     * @Route("/", name="tache_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request )
    {

        return $this->newAction($request);

    }

    /**
     * Creates a new tache entity.
     *
     * @Route("/new", name="tache_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $taches = $em->getRepository('GesProjetBundle:Tache')->findAll();
       // return $this->render('tache/index.html.twig', array(
        //    'taches' => $taches,
      //  ));

        $tache = new Tache();
        $form = $this->createForm('GesProjetBundle\Form\TacheType', $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $foundref = $em->getRepository('GesProjetBundle:Tache')->findOneBy(array("refTache" => $tache->getRefTache()));
            if (!$foundref) {
            $em->persist($tache);
            $em->flush($tache);
                $msg = "Votre enrégistrement a bien été effectué.";
                $this->addFlash("success", $msg);

            return $this->redirectToRoute('tache_index', array('id' => $tache->getId()));
            } else {
                $msg = " cette référence existe déjà.";
                $this->addFlash("error", $msg);
            }
        }

        return $this->render('tache/index.html.twig', array(
            'tache' => $tache,
            'taches'=>  $taches,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tache entity.
     *
     * @Route("/{id}", name="tache_show")
     * @Method("GET")
     */
    public function showAction(Tache $tache)
    {
        $deleteForm = $this->createDeleteForm($tache);

        return $this->render('tache/show.html.twig', array(
            'tache' => $tache,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tache entity.
     *
     * @Route("/{id}/edit", name="tache_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tache $tache)
    {
        $deleteForm = $this->createDeleteForm($tache);
        $editForm = $this->createForm('GesProjetBundle\Form\TacheType', $tache);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tache_edit', array('id' => $tache->getId()));
        }

        return $this->render('tache/edit.html.twig', array(
            'tache' => $tache,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tache entity.
     *
     * @Route("/{id}", name="tache_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tache $tache)
    {
        $form = $this->createDeleteForm($tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tache);
            $em->flush($tache);
        }

        return $this->redirectToRoute('tache_index');
    }

    /**
     * Creates a form to delete a tache entity.
     *
     * @param Tache $tache The tache entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tache $tache)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tache_delete', array('id' => $tache->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
