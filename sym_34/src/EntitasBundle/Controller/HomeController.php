<?php

namespace EntitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Entitas/Home/index.html.twig', array(
            // ...
        ));
    }

}
