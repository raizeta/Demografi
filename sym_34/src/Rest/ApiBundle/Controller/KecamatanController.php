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

use EntitasBundle\Entity\RegionalKecamatan;
use EntitasBundle\Form\RegionalKecamatanType;

/**
 * Class KecamatanController
 * @package RestApiBundle\Controller
 * @RouteResource("kecamatan")
 */
class KecamatanController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *     resource="/api/kecamatan",
     *     description="Get Collection Kecamatan",
     *     output="EntitasBundle\Entity\RegionalKecamatan",
     *     views = { "kecamatan" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $kecamatans = $em->getRepository('EntitasBundle:RegionalKecamatan')->findAll();
        
        if ($kecamatans === null) 
        {
            return View::create(["error"=>"Kecamatans Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create(['Kecamatans'=>$kecamatans], Response::HTTP_OK);
    }

    /**
     * Gets an individual Kecamatan
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     resource="/api/propinsi",
     *     output="EntitasBundle\Entity\RegionalKecamatan",
     *     views = { "kecamatan" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function getAction(Request $request,$id)
    {
        $em         = $this->getDoctrine()->getManager();
        $kecamatan  = $em->getRepository('EntitasBundle:RegionalKecamatan')->find($id);
        
        if ($kecamatan === null) 
        {
            return View::create(["error"=>"RegionalKecamatan With ID {$id} Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create($kecamatan, Response::HTTP_OK);
    }

    

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKecamatanType",
     *     views = { "kecamatan" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {
        
    }

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalKecamatanType",
     *     views = { "kecamatan" },
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
     *     input="EntitasBundle\Form\RegionalKecamatanType",
     *     views = { "kecamatan" },
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
     *     input="EntitasBundle\Form\RegionalKecamatanType",
     *     views = { "kecamatan" },
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
    public function optionsAction(Request $request)
    {}  
}
