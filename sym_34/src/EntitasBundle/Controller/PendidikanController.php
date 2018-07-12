<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\Pendidikan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pendidikan controller.
 *
 */
class PendidikanController extends Controller
{
    /**
     * Lists all pendidikan entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pendidikans = $em->getRepository('EntitasBundle:Pendidikan')->findAll();

        return $this->render('pendidikan/index.html.twig', array(
            'pendidikans' => $pendidikans,
        ));
    }

    /**
     * Creates a new pendidikan entity.
     *
     */
    public function newAction(Request $request)
    {
        $pendidikan = new Pendidikan();
        $form = $this->createForm('EntitasBundle\Form\PendidikanType', $pendidikan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pendidikan);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('pendidikan_show', array('id' => $pendidikan->getId()));
        }

        return $this->render('pendidikan/new.html.twig', array(
            'pendidikan' => $pendidikan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pendidikan entity.
     *
     */
    public function showAction(Pendidikan $pendidikan)
    {
        $deleteForm = $this->createDeleteForm($pendidikan);

        return $this->render('pendidikan/show.html.twig', array(
            'pendidikan' => $pendidikan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pendidikan entity.
     *
     */
    public function editAction(Request $request, Pendidikan $pendidikan)
    {
        $deleteForm = $this->createDeleteForm($pendidikan);
        $editForm = $this->createForm('EntitasBundle\Form\PendidikanType', $pendidikan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('pendidikan_edit', array('id' => $pendidikan->getId()));
        }

        return $this->render('pendidikan/edit.html.twig', array(
            'pendidikan' => $pendidikan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pendidikan entity.
     *
     */
    public function deleteAction(Request $request, Pendidikan $pendidikan)
    {
        $form = $this->createDeleteForm($pendidikan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pendidikan);
            $em->flush();
        }

        return $this->redirectToRoute('pendidikan_index');
    }

    /**
     * Creates a form to delete a pendidikan entity.
     *
     * @param Pendidikan $pendidikan The pendidikan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pendidikan $pendidikan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pendidikan_delete', array('id' => $pendidikan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
