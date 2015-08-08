<?php

namespace Functionality\NavbarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Functionality\NavbarBundle\Entity\Navbar;
use Functionality\NavbarBundle\Entity\NavbarLink;
use Functionality\NavbarBundle\Entity\NavbarLinkRef;
use Functionality\NavbarBundle\Entity\NavbarLinkRefOption;

class NavbarController extends Controller
{
	public function indexAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$router = $this->get('router');
	    $navbar = $em->getRepository('FunctionalityNavbarBundle:Navbar')->find($id);

	    if (!$navbar) {
	        throw $this->createNotFoundException(
	            'No Navbar found with id: '.$id
	        );
	    }
	    //insérer le tri par poids
	    $links = $navbar->getNavbarLinks();

	    foreach ($links as $link) {
	    	if ($link->getParent() != null) {
	    		$navbar->removeNavbarLink($link);
		    	}
		    //initialise le routepath avec l'URL complète
	    	if ($link->getNavbarLinkRef() != null) {
				if ($link->getLinkEnable()) {
					if ($router->getRouteCollection()->get($link->getNavbarLinkRef()->getRoutePath())) {
					//à rajouter, gestion de plusieurs options	
					$options = array($link->getNavbarLinkRef()->getNavbarLinkRefOptions()[0]->getOptionKey() => $link->getNavbarLinkRef()->getNavbarLinkRefOptions()[0]->getOptionValue());
					$url = $router->generate($link->getNavbarLinkRef()->getRoutePath(),$options);
					$link->getNavbarLinkRef()->setRoutePath($url);
					}
				} else {
					$link->getNavbarLinkRef()->setRoutePath(NULL);
				}	
			}
        } 
		
		return $this->render('FunctionalityNavbarBundle:Navbar:navbar.html.twig', array(
            'navbar' => $navbar,
        ));
	}

	private function NavbarPersist($navbar)
	{
		$em = $this->getDoctrine()->getManager();
		$em->persist($navbar);

		$navbarLinks = $navbar->getNavbarLinks();
		foreach ($navbarLinks as $navbarLink) {
			$navbarLink->setNavbar($navbar);
			$this->NavbarLinkPersist($navbarLink);
		}

		$oldNavbarLinks = $em->getRepository('FunctionalityNavbarBundle:NavbarLink')->findByNavbar($navbar);
		foreach ($oldNavbarLinks as $oldNavbarLink) {
            if ($navbarLinks->contains($oldNavbarLink) == false) {
                $oldNavbarLink->setNavbar(NULL);
                $em->persist($oldNavbarLink);
            }
        }
	}

	private function NavbarLinkPersist($navbarLink)
	{
		$em = $this->getDoctrine()->getManager();
		$em->persist($navbarLink);

		$navbarLinkRef = $navbarLink->getNavbarLinkRef();
		if ($navbarLinkRef != null) {
			$this->NavbarLinkRefPersist($navbarLinkRef);
		}
		
		$childs = $navbarLink->getChilds();
		foreach ($childs as $child) {
			$child->setNavbar($navbarLink->getNavbar());
			$child->setParent($navbarLink);
			$this->NavbarLinkPersist($child);
		}

		$oldChilds = $em->getRepository('FunctionalityNavbarBundle:NavbarLink')->findByParent($navbarLink);
		foreach ($oldChilds as $oldChild) {
            if ($childs->contains($oldChild) == false) {
                $oldChild->setParent(NULL);
                $em->persist($oldChild);
            }
        }
	}


	private function NavbarLinkRefPersist($navbarLinkRef)
	{
		$em = $this->getDoctrine()->getManager();

		$em->persist($navbarLinkRef);

		$navbarLinkRefOptions = $navbarLinkRef->getNavbarLinkRefOptions();	
		foreach ($navbarLinkRefOptions as $navbarLinkRefOption) {
			$navbarLinkRefOption->setNavbarLinkRef($navbarLinkRef);
			$this->NavbarLinkRefOptionPersist($navbarLinkRefOption);
		}

		$oldNavbarLinkRefOptions = $em->getRepository('FunctionalityNavbarBundle:NavbarLinkRefOption')->findByNavbarLinkRef($navbarLinkRef);
		foreach ($oldNavbarLinkRefOptions as $oldNavbarLinkRefOption) {
            if ($navbarLinkRefOptions->contains($oldNavbarLinkRefOption) == false) {
                $oldNavbarLinkRefOption->setNavbarLinkRef(NULL);
                $em->persist($oldNavbarLinkRefOption);
            }
        }
	}

	private function NavbarLinkRefOptionPersist($navbarLinkRefOption)
	{
		$em = $this->getDoctrine()->getManager();

		$em->persist($navbarLinkRefOption);
	}

	public function NavbarCreateAction(Request $request)
	{
		$navbar = new Navbar();

		$form = $this->createForm('Navbar', $navbar);

        $form->handleRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
        	
			$this->NavbarPersist($navbar);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbar->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarShowAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    
	    $navbar = $em->getRepository('FunctionalityNavbarBundle:Navbar')->find($id);

	    if (!$navbar) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    // Remove the links that have parent because there are already display by his parent
     	$links = $navbar->getNavbarLinks();
	    foreach ($links as $link) {
	    	if ($link->getParent() != null) {
	    		$navbar->removeNavbarLink($link);
	    	}
        }	  

		$form = $this->createForm('Navbar', $navbar, array('read_only' => true));

		return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarUpdateAction($id, Request $request)
	{
	    $em = $this->getDoctrine()->getManager();
	    $navbar = $em->getRepository('FunctionalityNavbarBundle:Navbar')->find($id);

	    if (!$navbar) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    // Remove the links that have parent because there are already display by its parent
     	$links = $navbar->getNavbarLinks();
	    foreach ($links as $link) {
	    	if ($link->getParent() != null) {
	    		$navbar->removeNavbarLink($link);
	    	}
        }	  

		$form = $this->createForm('Navbar', $navbar);

        $form->handleRequest($request);

        if ($form->isValid()) {

			$this->NavbarPersist($navbar);

			$em->flush();

			return new Response('Nom de la Navbar mise à jour : '.$navbar->getName());
        }
        
        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $navbar = $em->getRepository('FunctionalityNavbarBundle:Navbar')->find($id);

	    if (!$navbar) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    $em->remove($navbar);

	    $navbarLinks = $navbar->getNavbarLinks();
			foreach ($navbarLinks as $navbarLink) {
                    $navbarLink->setNavbar(NULL);
                    $em->persist($navbarLink);
            }

		$em->flush();

	    return new Response('Nom de la Navbar supprimée : '.$navbar->getName());
	}

	public function NavbarLinkCreateAction(Request $request)
	{
		$navbarLink = new NavbarLink();

		$form = $this->createForm('NavbarLink', $navbarLink);

        $form->handleRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$this->NavbarLinkPersist($navbarLink);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLink->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkUpdateAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
	    $navbarLink = $em->getRepository('FunctionalityNavbarBundle:NavbarLink')->find($id);

	    if (!$navbarLink) {
	        throw $this->createNotFoundException(
	            'Aucune NavbarLink trouvée pour cet id : '.$id
	        );
	    }

		$form = $this->createForm('NavbarLink', $navbarLink);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	if(($navbarLink->getParent() != NULL)&&($navbarLink->getParent()->getNavbar() != $navbarLink->getNavbar()))
        	{
        		$navbarLink->setNavbar($navbarLink->getParent()->getNavbar());
        	}
        	
			$this->NavbarLinkPersist($navbarLink);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLink->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $navbarLink = $em->getRepository('FunctionalityNavbarBundle:NavbarLink')->find($id);

	    if (!$navbarLink) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    $em->remove($navbarLink);

	   	$childs = $navbarLink->getChilds();
		foreach ($childs as $child) {
			$child->setParent(NULL);
			$this->NavbarLinkPersist($child);
		}

		$em->flush();

	    return new Response('Nom de la Navbar supprimée : '.$navbarLink->getName());
	}

	public function NavbarLinkRefCreateAction(Request $request)
	{
		$navbarLinkRef = new NavbarLinkRef();

		$form = $this->createForm('NavbarLinkRef', $navbarLinkRef);

        $form->handleRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$navbarLinks = $navbarLinkRef->getNavbarLinks();
			foreach ($navbarLinks as $navbarLink) {
				$navbarLink->setNavbarLinkRef($navbarLinkRef);
				$em->persist($navbarLink);
			}
			

			$this->NavbarLinkRefPersist($navbarLinkRef);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLinkRef->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkRefUpdateAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
	    $navbarLinkRef = $em->getRepository('FunctionalityNavbarBundle:NavbarLinkRef')->find($id);

	    if (!$navbarLinkRef) {
	        throw $this->createNotFoundException(
	            'Aucune NavbarLink trouvée pour cet id : '.$id
	        );
	    }

		$form = $this->createForm('NavbarLinkRef', $navbarLinkRef);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	
			$navbarLinks = $navbarLinkRef->getNavbarLinks();
			foreach ($navbarLinks as $navbarLink) {
				$navbarLink->setNavbarLinkRef($navbarLinkRef);
				$em->persist($navbarLink);
			}

			$oldNavbarLinks = $em->getRepository('FunctionalityNavbarBundle:NavbarLink')->findByNavbarLinkRef($navbarLinkRef);
			foreach ($oldNavbarLinks as $oldNavbarLink) {
	            if ($navbarLinks->contains($oldNavbarLink) == false) {
	                $oldNavbarLink->setNavbarLinkRef(NULL);
	                $em->persist($oldNavbarLink);
            	}
        	}
			
			$this->NavbarLinkRefPersist($navbarLinkRef);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLinkRef->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkRefDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $navbarLinkRef = $em->getRepository('FunctionalityNavbarBundle:NavbarLinkRef')->find($id);

	    if (!$navbarLinkRef) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    $em->remove($navbarLinkRef);

	    $navbarLinks = $navbarLinkRef->getNavbarLinks();
			foreach ($navbarLinks as $navbarLink) {
                $navbarLink->setNavbarLinkRef(NULL);
                $em->persist($navbarLink);
            }

        $navbarLinkRefOptions = $navbarLinkRef->getNavbarLinkRefOptions();
        	foreach ($navbarLinkRefOptions as $navbarLinkRefOption) {
        		$navbarLinkRefOption->setNavbarLinkRef(NULL);
                $em->persist($navbarLinkRefOption);
        	}

		$em->flush();

	    return new Response('Nom de la Navbar supprimée : '.$navbarLinkRef->getId());
	}

	public function NavbarLinkRefOptionCreateAction(Request $request)
	{
		$navbarLinkRefOption = new NavbarLinkRefOption();

		$form = $this->createForm('NavbarLinkRefOption', $navbarLinkRefOption);

        $form->handleRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();


			$this->NavbarLinkRefOptionPersist($navbarLinkRefOption);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLinkRefOption->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkRefOptionUpdateAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
	    $navbarLinkRefOption = $em->getRepository('FunctionalityNavbarBundle:NavbarLinkRefOption')->find($id);

	    if (!$navbarLinkRefOption) {
	        throw $this->createNotFoundException(
	            'Aucune NavbarLink trouvée pour cet id : '.$id
	        );
	    }

		$form = $this->createForm('NavbarLinkRefOption', $navbarLinkRefOption);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	
			$this->NavbarLinkRefOptionPersist($navbarLinkRefOption);

			$em->flush();
			return new Response('Id de la Navbar créée : '.$navbarLinkRefOption->getId());
        }

        return $this->render('FunctionalityNavbarBundle:Navbar:form.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function NavbarLinkRefOptionDeleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $navbarLinkRefOption = $em->getRepository('FunctionalityNavbarBundle:NavbarLinkRefOption')->find($id);

	    if (!$navbarLinkRefOption) {
	        throw $this->createNotFoundException(
	            'Aucune Navbar trouvée pour cet id : '.$id
	        );
	    }

	    $em->remove($navbarLinkRefOption);

		$em->flush();

	    return new Response('Nom de la Navbar supprimée : '.$navbarLinkRefOption->getId());
	}
}