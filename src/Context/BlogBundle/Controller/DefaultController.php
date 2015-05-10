<?php

namespace Context\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ContextBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
