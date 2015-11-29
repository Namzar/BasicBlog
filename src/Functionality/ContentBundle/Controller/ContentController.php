<?php

namespace Functionality\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Functionality\ContentBundle\Entity\Content;

class ContentController extends Controller
{
    public function indexAction($id)
    {
		$content = $this->ContentRetrieve($id);
		return $this->ContentRender($content);
    }
    
    public function ContentRetrieve($id)
    {
    	$em = $this->getDoctrine()->getManager();
		$content = $em->getRepository('FunctionalityContentBundle:Content')->find($id);

		if (!$content) {
		throw $this->createNotFoundException(
            	'No Content found with id : '.$id
        	);
		}
		return $content;
    }
    
    public function ContentRetrieveBySlug($slug)
    {
    	$em = $this->getDoctrine()->getManager();
		$content = $em->getRepository('FunctionalityContentBundle:Content')->findOneBySlug($slug);

		if (!$content) {
		throw $this->createNotFoundException(
            	'No Content found with slug : '.$slug
        	);
		}
		return $content;
    }

    public function ContentRender($content)
    {
    	return $this->render('FunctionalityContentBundle:Content:index.html.twig', array('content' => $content));
    }
    
    private function ContentPersist($content)
    {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($content);
    }

    public function ContentCreateAction(Request $request)
    {
    	$content = new Content();

    	$form = $this->createForm('Content', $content);

    	$form->handleRequest($request);

    	if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

    		$this->ContentPersist($content);

    		$em->flush();
    		return new Response('Created Content Id: '.$content->getId()); }

    	return $this->render('FunctionalityContentBundle:Content:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

    public function ContentShowAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
	    
	    $content = $em->getRepository('FunctionalityContentBundle:Content')->find($id);

	    if (!$content) {
	        throw $this->createNotFoundException(
	            'No Content found with id : '.$id
	        );
	    }

		$form = $this->createForm('Content', $content, array('read_only' => true));

	    return $this->render('FunctionalityContentBundle:Content:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

    public function ContentUpdateAction($id, Request $request)
	{
	    $em = $this->getDoctrine()->getManager();
	    $content = $em->getRepository('FunctionalityContentBundle:Content')->find($id);

	    if (!$content) {
	        throw $this->createNotFoundException(
	            'No Content found with id : '.$id
	        );
	    }	 

		$form = $this->createForm('Content', $content);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	
			$this->ContentPersist($content);

			$em->flush();

			return new Response('Updated Content Id : '.$content->getId());
        }
        
        return $this->render('FunctionalityContentBundle:Content:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function ContentDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $content = $em->getRepository('FunctionalityContentBundle:Content')->find($id);

	    if (!$content) {
	        throw $this->createNotFoundException(
	            'No Content found with id : '.$id
	        );
	    }

	    $em->remove($content);

	    $id = $content->getId();

		$em->flush();

	    return new Response('Deleted Content Id : '.$id);
	}

}
