<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\Kelamin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Kelamin controller.
 *
 */
class KelaminController extends Controller
{
    /**
     * Lists all kelamin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kelamins = $em->getRepository('EntitasBundle:Kelamin')->findAll();

        return $this->render('kelamin/index.html.twig', array(
            'kelamins' => $kelamins,
        ));
    }

    /**
     * Creates a new kelamin entity.
     *
     */
    public function newAction(Request $request)
    {
        $kelamin = new Kelamin();
        $form = $this->createForm('EntitasBundle\Form\KelaminType', $kelamin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kelamin);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('kelamin_show', array('id' => $kelamin->getId()));
        }

        return $this->render('kelamin/new.html.twig', array(
            'kelamin' => $kelamin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kelamin entity.
     *
     */
    public function showAction(Kelamin $kelamin)
    {
        $deleteForm = $this->createDeleteForm($kelamin);

        return $this->render('kelamin/show.html.twig', array(
            'kelamin' => $kelamin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kelamin entity.
     *
     */
    public function editAction(Request $request, Kelamin $kelamin)
    {
        $deleteForm = $this->createDeleteForm($kelamin);
        $editForm = $this->createForm('EntitasBundle\Form\KelaminType', $kelamin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('kelamin_edit', array('id' => $kelamin->getId()));
        }

        return $this->render('kelamin/edit.html.twig', array(
            'kelamin' => $kelamin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kelamin entity.
     *
     */
    public function deleteAction(Request $request, Kelamin $kelamin)
    {
        $form = $this->createDeleteForm($kelamin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kelamin);
            $em->flush();
        }

        return $this->redirectToRoute('kelamin_index');
    }

    /**
     * Creates a form to delete a kelamin entity.
     *
     * @param Kelamin $kelamin The kelamin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kelamin $kelamin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kelamin_delete', array('id' => $kelamin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
