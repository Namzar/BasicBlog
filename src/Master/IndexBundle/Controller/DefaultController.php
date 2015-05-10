<?php

namespace Master\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MasterIndexBundle:Default:index.html.twig', array('name' => $name));
    }
}
