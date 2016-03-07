<?php

namespace Functionality\ApplicationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApplicationController extends Controller
{
    public function indexAction()
    {
    }

    public function ApplicationCreateAction(Request $request)
    {
    	$application = new Application();

    	$form = $this->createForm('Application', $application);

    	$form->handleRequest($request);

    	if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

    		$this->ApplicationPersist($application);

    		$em->flush();
    		return new Response('Created Application Id: '.$application->getId()); }
    	return $this->render('FunctionalityApplicationBundle:Application:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

	public function ApplicationShowAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
	    
	    $application = $em->getRepository('FunctionalityApplicationApplication:Application')->find($id);

	    if (!$application) {
	        throw $this->createNotFoundException(
	            'No Application found with id : '.$id
	        );
	    }

		$form = $this->createForm('Application', $application, array('read_only' => true));

	    return $this->render('FunctionalityApplicationBundle:Application:form.html.twig', array(
    		'form' => $form->createView(),
		));
    }

    public function ApplicationUpdateAction($id, Request $request)
	{
	    $em = $this->getDoctrine()->getManager();
	    $application = $em->getRepository('FunctionalityApplicationBundle:Application')->find($id);

	    if (!$application) {
	        throw $this->createNotFoundException(
	            'No Application found with id : '.$id
	        );
	    }	 

		$form = $this->createForm('Application', $application);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	
			$this->ApplicationPersist($application);

			$em->flush();

			return new Response('Updated Application Id : '.$application->getId());
        }
        
        return $this->render('FunctionalityApplicationBundle:Application:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function ApplicationDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $application = $em->getRepository('FunctionalityApplicationBundle:Application')->find($id);

	    if (!$application) {
	        throw $this->createNotFoundException(
	            'No Application found with id : '.$id
	        );
	    }

	    $em->remove($application);

	    $id = $application->getId();

		$em->flush();

	    return new Response('Deleted Application Id : '.$id);
	}

}