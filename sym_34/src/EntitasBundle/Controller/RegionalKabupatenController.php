<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\RegionalKabupaten;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Regionalkabupaten controller.
 *
 */
class RegionalKabupatenController extends Controller
{
    /**
     * Lists all regionalKabupaten entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $regionalKabupatens = $em->getRepository('EntitasBundle:RegionalKabupaten')->findAll();

        return $this->render('regionalkabupaten/index.html.twig', array(
            'regionalKabupatens' => $regionalKabupatens,
        ));
    }

    /**
     * Creates a new regionalKabupaten entity.
     *
     */
    public function newAction(Request $request)
    {
        $regionalKabupaten = new Regionalkabupaten();
        $form = $this->createForm('EntitasBundle\Form\RegionalKabupatenType', $regionalKabupaten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regionalKabupaten);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalkabupaten_show', array('id' => $regionalKabupaten->getId()));
        }

        return $this->render('regionalkabupaten/new.html.twig', array(
            'regionalKabupaten' => $regionalKabupaten,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a regionalKabupaten entity.
     *
     */
    public function showAction(RegionalKabupaten $regionalKabupaten)
    {
        $id = $regionalKabupaten->getId();
        $em = $this->getDoctrine()->getManager();
        $regionalKecamatans = $em->getRepository('EntitasBundle:RegionalKabupaten')->findKecamatanByKabId($id);

        return $this->render('regionalkabupaten/show.html.twig', array(
            'regionalKecamatans' => $regionalKecamatans,
        ));
    }

    /**
     * Displays a form to edit an existing regionalKabupaten entity.
     *
     */
    public function editAction(Request $request, RegionalKabupaten $regionalKabupaten)
    {
        $deleteForm = $this->createDeleteForm($regionalKabupaten);
        $editForm = $this->createForm('EntitasBundle\Form\RegionalKabupatenType', $regionalKabupaten);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalkabupaten_edit', array('id' => $regionalKabupaten->getId()));
        }

        return $this->render('regionalkabupaten/edit.html.twig', array(
            'regionalKabupaten' => $regionalKabupaten,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a regionalKabupaten entity.
     *
     */
    public function deleteAction(Request $request, RegionalKabupaten $regionalKabupaten)
    {
        $form = $this->createDeleteForm($regionalKabupaten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($regionalKabupaten);
            $em->flush();
        }

        return $this->redirectToRoute('regionalkabupaten_index');
    }

    /**
     * Creates a form to delete a regionalKabupaten entity.
     *
     * @param RegionalKabupaten $regionalKabupaten The regionalKabupaten entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RegionalKabupaten $regionalKabupaten)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('regionalkabupaten_delete', array('id' => $regionalKabupaten->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
