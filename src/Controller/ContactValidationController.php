<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as Request;

class ContactValidationController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/contact-validation", name="contactValidation")
     *
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function contactValidation(Request $request) {

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


        return $this->render('main/contactValidate.html.twig', [
            'local'       => $local,
            'form'        => $form->createView(),
        ]);
    }

}