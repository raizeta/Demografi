<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\RegionalKecamatan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Regionalkecamatan controller.
 *
 */
class RegionalKecamatanController extends Controller
{
    /**
     * Lists all regionalKecamatan entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $regionalKecamatans = $em->getRepository('EntitasBundle:RegionalKecamatan')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($regionalKecamatans,$request->query->getInt('page', 1),10);

        return $this->render('regionalkecamatan/index.html.twig', array(
            'regionalKecamatans' => $pagination,
        ));
    }

    /**
     * Creates a new regionalKecamatan entity.
     *
     */
    public function newAction(Request $request)
    {
        $regionalKecamatan = new Regionalkecamatan();
        $form = $this->createForm('EntitasBundle\Form\RegionalKecamatanType', $regionalKecamatan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regionalKecamatan);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalkecamatan_show', array('id' => $regionalKecamatan->getId()));
        }

        return $this->render('regionalkecamatan/new.html.twig', array(
            'regionalKecamatan' => $regionalKecamatan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a regionalKecamatan entity.
     *
     */
    public function showAction(RegionalKecamatan $regionalKecamatan)
    {
        $deleteForm = $this->createDeleteForm($regionalKecamatan);

        return $this->render('regionalkecamatan/show.html.twig', array(
            'regionalKecamatan' => $regionalKecamatan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing regionalKecamatan entity.
     *
     */
    public function editAction(Request $request, RegionalKecamatan $regionalKecamatan)
    {
        $deleteForm = $this->createDeleteForm($regionalKecamatan);
        $editForm = $this->createForm('EntitasBundle\Form\RegionalKecamatanType', $regionalKecamatan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalkecamatan_edit', array('id' => $regionalKecamatan->getId()));
        }

        return $this->render('regionalkecamatan/edit.html.twig', array(
            'regionalKecamatan' => $regionalKecamatan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a regionalKecamatan entity.
     *
     */
    public function deleteAction(Request $request, RegionalKecamatan $regionalKecamatan)
    {
        $form = $this->createDeleteForm($regionalKecamatan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($regionalKecamatan);
            $em->flush();
        }

        return $this->redirectToRoute('regionalkecamatan_index');
    }

    /**
     * Creates a form to delete a regionalKecamatan entity.
     *
     * @param RegionalKecamatan $regionalKecamatan The regionalKecamatan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RegionalKecamatan $regionalKecamatan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('regionalkecamatan_delete', array('id' => $regionalKecamatan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
