<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as Request;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     *
     */
    public function login() {
        return $this->render('security/login.html.twig');
    }


}