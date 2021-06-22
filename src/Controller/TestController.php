<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends  AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function m(): string
    {
        return 'Hello';
    }
    /**
     * @Route("/main", name="main", methods={"GET"})
     */
    public function main()
    {
        return $this->render('base.html.twig');
    }
}