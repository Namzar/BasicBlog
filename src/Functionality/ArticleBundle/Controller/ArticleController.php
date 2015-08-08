<?php

namespace Functionality\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Functionality\ArticleBundle\Entity\Article;

class ArticleController extends Controller
{
    public function indexAction($id)
    {

		$em = $this->getDoctrine()->getManager();
	    $article = $em->getRepository('FunctionalityArticleBundle:Article')->find($id);

		if (!$article) {
	        throw $this->createNotFoundException(
	            'No Article found with id : '.$id
	        );
	    }

        return $this->render('FunctionalityArticleBundle:Article:index.html.twig', array('article' => $article));
    }

    private function ArticlePersist($article)
    {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($article);
    }

    public function ArticleCreateAction(Request $request)
    {
    	$article = new Article();

    	$form = $this->createForm('Article', $article);

    	$form->handleRequest($request);

    	if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

    		$this->ArticlePersist($article);

    		$em->flush();
    		return new Response('Created Article Id: '.$article->getId());
    	}

    	return $this->render('FunctionalityArticleBundle:Article:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

    public function ArticleShowAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
	    
	    $article = $em->getRepository('FunctionalityArticleBundle:Article')->find($id);

	    if (!$article) {
	        throw $this->createNotFoundException(
	            'No Article found with id : '.$id
	        );
	    }

		$form = $this->createForm('Article', $article, array('read_only' => true));

	    return $this->render('FunctionalityArticleBundle:Article:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

    public function ArticleUpdateAction($id, Request $request)
	{
	    $em = $this->getDoctrine()->getManager();
	    $article = $em->getRepository('FunctionalityArticleBundle:Article')->find($id);

	    if (!$article) {
	        throw $this->createNotFoundException(
	            'No Article found with id : '.$id
	        );
	    }	 

		$form = $this->createForm('Article', $article);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	
			$this->ArticlePersist($article);

			$em->flush();

			return new Response('Updated Article Id : '.$article->getId());
        }
        
        return $this->render('FunctionalityArticleBundle:Article:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function ArticleDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $article = $em->getRepository('FunctionalityArticleBundle:Article')->find($id);

	    if (!$article) {
	        throw $this->createNotFoundException(
	            'No Article found with id : '.$id
	        );
	    }

	    $em->remove($article);

	    $id = $article->getId();

		$em->flush();

	    return new Response('Deleted Article Id : '.$id);
	}

}
