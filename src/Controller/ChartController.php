<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as Request;

class ChartController extends AbstractController
{
    /**
     * @Route("/admin/chart", name="chart")
     *
     */
    public function login() {
        return $this->render('main/chart.html.twig');
    }
}