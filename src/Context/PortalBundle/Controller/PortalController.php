<?php

namespace Context\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortalController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $navbar = $em->getRepository('FunctionalityNavbarBundle:Navbar')->find(1);


        return $this->render('ContextPortalBundle:Index:home.html.twig', array(
            'navbar' => $navbar,
        ));
    }

    // public function articleAction($slug)
    // {
    // 	$articleController = $this->get('Functionality_article.controller');
    //     $article = $articleController->ArticleRetrieveBySlug($slug);
    //     return $articleController->ArticleRender($article);
    // }
}
