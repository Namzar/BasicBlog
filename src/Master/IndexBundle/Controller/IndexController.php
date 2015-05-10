<?php

namespace Master\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('MasterIndexBundle:Index:index.html.twig', array(
            ));    
    }

}
