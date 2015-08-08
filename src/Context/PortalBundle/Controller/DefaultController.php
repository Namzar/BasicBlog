<?php

namespace Context\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ContextPortalBundle:Default:index.html.twig', array('name' => $name));
    }
}
