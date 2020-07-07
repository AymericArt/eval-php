<?php

namespace App\Controller;

use App\form\LanguageForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as Request;



class CottageController extends AbstractController
{

    /**
     * @Route("/gite", name="home")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cottage(Request $request) {

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


        return $this->render('main/cottage.html.twig', [
            'local' => $local,
            'form'  => $form->createView()
        ]);
    }

}