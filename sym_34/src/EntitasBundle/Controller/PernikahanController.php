<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\Pernikahan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pernikahan controller.
 *
 */
class PernikahanController extends Controller
{
    /**
     * Lists all pernikahan entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pernikahans = $em->getRepository('EntitasBundle:Pernikahan')->findAll();

        return $this->render('pernikahan/index.html.twig', array(
            'pernikahans' => $pernikahans,
        ));
    }

    /**
     * Creates a new pernikahan entity.
     *
     */
    public function newAction(Request $request)
    {
        $pernikahan = new Pernikahan();
        $form = $this->createForm('EntitasBundle\Form\PernikahanType', $pernikahan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pernikahan);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('pernikahan_show', array('id' => $pernikahan->getId()));
        }

        return $this->render('pernikahan/new.html.twig', array(
            'pernikahan' => $pernikahan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pernikahan entity.
     *
     */
    public function showAction(Pernikahan $pernikahan)
    {
        $deleteForm = $this->createDeleteForm($pernikahan);

        return $this->render('pernikahan/show.html.twig', array(
            'pernikahan' => $pernikahan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pernikahan entity.
     *
     */
    public function editAction(Request $request, Pernikahan $pernikahan)
    {
        $deleteForm = $this->createDeleteForm($pernikahan);
        $editForm = $this->createForm('EntitasBundle\Form\PernikahanType', $pernikahan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('pernikahan_edit', array('id' => $pernikahan->getId()));
        }

        return $this->render('pernikahan/edit.html.twig', array(
            'pernikahan' => $pernikahan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pernikahan entity.
     *
     */
    public function deleteAction(Request $request, Pernikahan $pernikahan)
    {
        $form = $this->createDeleteForm($pernikahan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pernikahan);
            $em->flush();
        }

        return $this->redirectToRoute('pernikahan_index');
    }

    /**
     * Creates a form to delete a pernikahan entity.
     *
     * @param Pernikahan $pernikahan The pernikahan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pernikahan $pernikahan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pernikahan_delete', array('id' => $pernikahan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
