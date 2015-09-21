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
    	$articleController = $this->get('Functionality_article.controller');
        $article = $articleController->ArticleRetrieveBySlug($slug);
        if ($article.getPortal())
        {
            return $articleController->ArticleRender($article);
        }
        else
        {

        }
    }
}
