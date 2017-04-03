<?php

namespace Robert\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('RobertAppBundle:Default:index.html.twig');
    }
}
