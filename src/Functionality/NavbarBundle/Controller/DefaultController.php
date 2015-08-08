<?php

namespace Main\NavbarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MainNavbarBundle:Default:index.html.twig', array('name' => $name));
    }
}
