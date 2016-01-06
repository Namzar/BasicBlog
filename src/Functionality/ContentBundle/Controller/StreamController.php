<?php

namespace Functionality\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Functionality\ContentBundle\Entity\Stream;

class StreamController extends Controller
{
    public function StreamPersist($stream)
    {
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($stream);
    }

    public function StreamCreateAction(Request $request)
    {
        $stream = new Stream();

    	$form = $this->createForm('Stream', $stream);

    	$form->handleRequest($request);

    	if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

    		$this->StreamPersist($stream);

    		$em->flush();
    		return new Response('Created Stream Id: '.$stream->getId()); }

    	return $this->render('FunctionalityContentBundle:Stream:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

}
