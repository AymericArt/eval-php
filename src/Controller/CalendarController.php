<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Price;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as Request;



class CalendarController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/calendrier", name="calendar")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function calendar(Request $request) {

        $local       = $request->getLocale();
        $priceRepo   = $this->em->getRepository(Price::class);

        $price       = ($local === 'fr') ? $priceRepo->findBy(['title' => 'Francais']) : $priceRepo->findBy(['title' => 'Anglais']);

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

        return $this->render('main/calendar.html.twig', [
            'local' => $local,
            'form'  => $form->createView(),
            'price' => $price
        ]);
    }

    /**
     * @Route("/api/booking", name="booking")
     *
     */
    public function booking(Request $request) {
        $bookingRepo = $this->em->getRepository(Booking::class);
        $bookingRaw  = $bookingRepo->findAll();

        return $this->json($bookingRaw);

    }

}