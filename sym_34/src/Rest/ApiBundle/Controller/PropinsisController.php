<?php

namespace Rest\ApiBundle\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Version;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Annotation\Route;

use EntitasBundle\Entity\RegionalPropinsi;
use EntitasBundle\Form\RegionalPropinsiType;
/**
 * Class PropinsisController
 * @package RestApiBundle\Controller
 * @RouteResource("propinsi")
 */
class PropinsisController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @ApiDoc(
     *     resource="/api/propinsi",
     *     description="Get Collection Propinsi",
     *     output="EntitasBundle\Entity\RegionalPropinsi",
     *     views = { "propinsi" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction(Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $propinsis  = $em->getRepository('EntitasBundle:RegionalPropinsi')->findAll();
        
        if ($propinsis === null) 
        {
            return View::create(["error"=>"Products With ID {$id} Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create(['Propinsis'=>$propinsis], Response::HTTP_OK);
    }

    /**
     * Gets an individual Propinsi
     *
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     resource="/api/propinsi",
     *     output="EntitasBundle\Entity\RegionalPropinsi",
     *     views = { "propinsi" },
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function getAction(Request $request,$id)
    {
        $em         = $this->getDoctrine()->getManager();
        $propinsi   = $em->getRepository('EntitasBundle:RegionalPropinsi')->find($id);
        
        if ($propinsi === null) 
        {
            return View::create(["error"=>"RegionalPropinsi With ID {$id} Not Found"], Response::HTTP_NOT_FOUND);
        }
        return View::create($propinsi, Response::HTTP_OK);
    }

    

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalPropinsiType",
     *     views = { "propinsi" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {
        $propinsi = new RegionalPropinsi();
        $form   = $this->createForm(RegionalPropinsiType::class, $propinsi, ['csrf_protection' => false]);
        $form->submit($request->request->all());
        if ($form->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($propinsi);
            $em->flush();
            return View::create($propinsi,201);
        }
        return View::create($this->customvalidation($propinsi), 400);
    }

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalPropinsiType",
     *     views = { "propinsi" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function putAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $propinsi = $em->getRepository('EntitasBundle:RegionalPropinsi')->find($id);
        if ($propinsi === null) 
        {
            return View::create("Error Null", Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(RegionalPropinsiType::class, $propinsi, ['csrf_protection' => false]);
        $form->submit($request->request->all());
        if ($form->isValid()) 
        {
            $em->flush();
            return View::create($propinsi,201);
        }
        return View::create($this->customvalidation($propinsi), 400);
    }

    /**
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="EntitasBundle\Form\RegionalPropinsiType",
     *     views = { "propinsi" },
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
     *     input="EntitasBundle\Form\RegionalPropinsiType",
     *     views = { "propinsi" },
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
     *     input="EntitasBundle\Form\RegionalPropinsiType",
     *     views = { "propinsi" },
     *     statusCodes={
     *         201 = "Returned when a new Propinsi has been successful created",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function optionsAction(Request $request)
    {}

    private function customvalidation(RegionalPropinsi $propinsi)
    {
        $validator          = $this->get('validator');
        $errorsValidator    = $validator->validate($propinsi);
        $errors = [];
        foreach ($errorsValidator as $violation) 
        {
             $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return ['error'=>$errors,'code'=>400,'message'=>'Error Validation'] ;
    }  
}
