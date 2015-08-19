<?php

namespace Context\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Functionality\ArticleBundle\Entity\Article;

class PortalController extends Controller
{
    public function homeAction()
    {
        return $this->render('ContextPortalBundle:Index:home.html.twig');
    }

    public function articleAction($slug)
    {
    	$em = $this->getDoctrine()->getManager();
	    
	    $article = $em->getRepository('FunctionalityArticleBundle:Article')->findOneBySlug($slug);

        return $this->render('ContextPortalBundle:Index:article.html.twig', array(
        	'article' => $article
        ));
    }
}
