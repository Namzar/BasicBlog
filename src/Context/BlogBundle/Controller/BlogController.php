<?php

namespace Context\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function articleAction()
    {
        return $this->render('ContextBlogBundle:Index:article.html.twig', array(
                // ...
            ));    }

}
