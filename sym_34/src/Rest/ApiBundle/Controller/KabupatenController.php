<?php

namespace Rest\ApiBundle\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Version;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Annotation\Route;

use EntitasBundle\Entity\RegionalKabupaten;
use EntitasBundle\Form\RegionalKabupatenType;

/**
 * Class KabupatenController
 * @package RestApiBundle\Controller
 * @RouteResource("kabupaten")
 */
class KabupatenController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *     resource="/api/kabupaten",
     *     description="Get Collection Kabupaten",
     *     output="EntitasBundle\Entity\RegionalKabupaten",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $kabupatens  = $em->getRepository('EntitasBundle:RegionalKabupaten')->findAll();
        
        if ($kabupatens === null) 
        {
            return View::create(["error"=>"RegionalKabupaten Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create(['Kabupatens'=>$kabupatens], Response::HTTP_OK);
    }

    /**
     * Gets an individual Kabupaten
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     resource="/api/propinsi",
     *     output="EntitasBundle\Entity\RegionalKabupaten",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function getAction(Request $request,$id)
    {
        $em         = $this->getDoctrine()->getManager();
        $kabupaten  = $em->getRepository('EntitasBundle:RegionalKabupaten')->find($id);
        
        if ($kabupaten === null) 
        {
            return View::create(["error"=>"RegionalKabupaten With ID {$id} Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create($kabupaten, Response::HTTP_OK);
    }

    

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKabupatenType",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         201 = "Returned when a new Kabupaten has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {
        $kabupaten  = new RegionalKabupaten();
        $form       = $this->createForm(RegionalKabupatenType::class, $kabupaten, ['csrf_protection' => false]);
        $form->submit($request->request->all());
        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kabupaten);
            $em->flush();
            return View::create($kabupaten,201);
        }
        return View::create($this->customvalidation($kabupaten), 400);
    }

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKabupatenType",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function putAction(Request $request,$id)
    {}

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKabupatenType",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function patchAction(Request $request)
    {}

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKabupatenType",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function deleteAction(Request $request,$id)
    {}

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKabupatenType",
     *     views = { "kabupaten" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function optionsAction(Request $request)
    {}

    private function customvalidation(RegionalKabupaten $kabupaten)
    {
        $validator          = $this->get('validator');
        $errorsValidator    = $validator->validate($kabupaten);
        $errors = [];
        foreach ($errorsValidator as $violation) 
        {
             $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return ['error'=>$errors,'code'=>400,'message'=>'Error Validation'] ;
    } 
}
