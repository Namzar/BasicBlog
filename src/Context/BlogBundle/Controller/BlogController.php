<?php

namespace Context\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
	    $contents = $em->getRepository('FunctionalityContentBundle:Content')->findAll();

	    if (!$contents) {
	        throw $this->createNotFoundException(
	            'No Content found'
	        );
	    }
        return $this->render('ContextBlogBundle:Index:index.html.twig', array(
            'contents' => $contents,
        ));
    }
}
