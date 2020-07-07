<?php

namespace App\Controller;

use App\form\LanguageForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as Request;



class HomeController extends AbstractController
{

    /**
     * @Route("/acceuil", name="home")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(Request $request) {

        $local = $request->getLocale();
        $form = $this->createFormBuilder()
        ->add('language', ChoiceType::class, [
            'choices' => [
                'EN' => 'en',
                'FR' => 'fr'
            ],
            'data' => $local,
            'label' => false
        ])
        ->getForm();

        return $this->render('main/home.html.twig', [
            'local' => $local,
            'form'  => $form->createView()
        ]);
    }

}