<?php

namespace Context\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortalController extends Controller
{
    public function homeAction()
    {
        return $this->render('ContextPortalBundle:Index:home.html.twig');
    }

    public function atestAction()
    {
        return $this->render('ContextPortalBundle:Index:atest.html.twig');
    }
}
