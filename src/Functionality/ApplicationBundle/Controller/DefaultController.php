<?php

namespace Functionality\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FunctionalityApplicationBundle:Default:index.html.twig', array('name' => $name));
    }
}
