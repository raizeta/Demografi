<?php

namespace EntitasBundle\Controller;

use EntitasBundle\Entity\RegionalPropinsi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

use EntitasBundle\Form\RegionalPropinsiType;
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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $regionalPropinsis = $em->getRepository('EntitasBundle:RegionalPropinsi')->findAll();
        $page       = $request->query->getInt('page', 1);
        $limit      = $request->query->getInt('limit', 10);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($regionalPropinsis,$page,$limit);

        $propinsiform   = new Regionalpropinsi();
        $actionurl      = $this->generateUrl('regionalpropinsi_new');
        $form           = $this->createForm(RegionalPropinsiType::class,$propinsiform,['action' => $actionurl,'method' => 'POST']);

        return $this->render
        (   'regionalpropinsi/index.html.twig',
            [
                'regionalPropinsis' => $pagination,
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
        $form = $this->createForm('EntitasBundle\Form\RegionalPropinsiType', $regionalPropinsi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($regionalPropinsi);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Simpan');
            return $this->redirectToRoute('regionalpropinsi_index');
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
    public function editAction(Session $session,Request $request, RegionalPropinsi $regionalPropinsi,$id)
    {
        if ($request->isXmlHttpRequest())
        {
            $actionurl  = $this->generateUrl('regionalpropinsi_edit',['id'=>$id]);
            $editForm   = $this->createForm(RegionalPropinsiType::class,$regionalPropinsi,
                ['action' => $actionurl,'method' => 'POST']);
            $editForm->handleRequest($request);
            return $this->render('regionalpropinsi/modaledit.html.twig', array(
                'regionalPropinsi' => $regionalPropinsi,
                'edit_form' => $editForm->createView(),
            ));
        }

        $pathInfo   = $request->headers->get('referer');
        $data       = parse_url($pathInfo);
        $paramurl   = [];
        if(array_key_exists("query",$data))
        {
            parse_str($data['query'],$paramurl);
            $session->set('parameterurl',$paramurl);
        }
        if($session->get('parameterurl'))
        {
            $paramurl = $session->get('parameterurl');
        }
        $deleteForm = $this->createDeleteForm($regionalPropinsi);
        $editForm   = $this->createForm('EntitasBundle\Form\RegionalPropinsiType', $regionalPropinsi);
        $editForm->handleRequest($request);

        
        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('notice','Data Telah Berhasil di Update');
            return $this->redirectToRoute('regionalpropinsi_index',$paramurl);
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


    public function deleteAllAction(Request $request)
    {
        $product = $request->request->get('checkboxescheck');
        return new JsonResponse(explode(',',$product));
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

    protected function getErrorMessages(\Symfony\Component\Form\Form $form) 
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) 
        {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) 
        {
            if (!$child->isValid()) 
            {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}
