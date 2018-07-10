<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\RegionalPropinsi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Regionalpropinsi controller.
 *
 */
class RegionalPropinsiController extends Controller
{
    /**
     * Lists all regionalPropinsi entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $regionalPropinsis = $em->getRepository('EntitasBundle:RegionalPropinsi')->findAll();

        $propinsiform = new Regionalpropinsi();
        $form = $this->createForm('EntitasBundle\Form\RegionalPropinsiType', $propinsiform);

        return $this->render
        (   'regionalpropinsi/index.html.twig',
            [
                'regionalPropinsis' => $regionalPropinsis,
                'form' => $form->createView(),
            ]
        );
    }

    /**
    *@Template("regionalpropinsi/new.html.twig")
    */
    public function newAction(Request $request)
    {
        $regionalPropinsi = new Regionalpropinsi();
        if ($request->isXmlHttpRequest())
        {
            $regionalPropinsi->setNamapropinsi($request->get('namapropinsi'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($regionalPropinsi);
            $em->flush();

            $template= $this->renderView('regionalpropinsi/listajax.html.twig',['regionalPropinsi' => $regionalPropinsi]);
            return new JsonResponse(array('data' => $template), 200);
        }

        $form = $this->createForm('EntitasBundle\Form\RegionalPropinsiType', $regionalPropinsi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regionalPropinsi);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalpropinsi_show', array('id' => $regionalPropinsi->getId()));
        }

        return ['regionalPropinsi' => $regionalPropinsi,'form' => $form->createView()];
    }

    /**
     * Finds and displays a regionalPropinsi entity.
     *
     */
    public function showAction(RegionalPropinsi $regionalPropinsi)
    {
        $id = $regionalPropinsi->getId();
        $em = $this->getDoctrine()->getManager();
        $regionalKabupatens = $em->getRepository('EntitasBundle:RegionalPropinsi')->findKabubaptenByPropId($id);
        // return new JsonResponse($regionalKabupatens);
        // die;
        return $this->render('regionalpropinsi/show.html.twig', array(
            'regionalKabupatens' => $regionalKabupatens,
        ));
    }

    /**
     * Displays a form to edit an existing regionalPropinsi entity.
     *
     */
    public function editAction(Request $request, RegionalPropinsi $regionalPropinsi)
    {
        $deleteForm = $this->createDeleteForm($regionalPropinsi);
        $editForm = $this->createForm('EntitasBundle\Form\RegionalPropinsiType', $regionalPropinsi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalpropinsi_edit', array('id' => $regionalPropinsi->getId()));
        }

        return $this->render('regionalpropinsi/edit.html.twig', array(
            'regionalPropinsi' => $regionalPropinsi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a regionalPropinsi entity.
     *
     */
    public function deleteAction(Request $request, RegionalPropinsi $regionalPropinsi)
    {
        $form = $this->createDeleteForm($regionalPropinsi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($regionalPropinsi);
            $em->flush();
        }

        return $this->redirectToRoute('regionalpropinsi_index');
    }

    /**
     * Creates a form to delete a regionalPropinsi entity.
     *
     * @param RegionalPropinsi $regionalPropinsi The regionalPropinsi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RegionalPropinsi $regionalPropinsi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('regionalpropinsi_delete', array('id' => $regionalPropinsi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
