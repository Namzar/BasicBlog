<?php

namespace Functionality\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FunctionalityArticleBundle:Default:index.html.twig', array('name' => $name));
    }
}
